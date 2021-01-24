<?php
declare(strict_types=1);

namespace App\Utils;

use App\Constants\ErrorCode;
use App\Exception\BusinessException;
use App\Kernel\Http\Response;
use Firebase\JWT\JWT;
use Hyperf\Cache\Driver\RedisDriver;
use Hyperf\Contract\ConfigInterface;
use Hyperf\Utils\ApplicationContext;
use Psr\SimpleCache\CacheInterface;
use Ramsey\Uuid\Uuid;
use Redis;

class JWTUtils
{
    protected $response;

    protected $config;

    protected $cache;

    private $secret;

    private $alg;

    private $ttl;

    private $blacklist;

    private $whitelist;

    private $multiPlatform;

    public function __construct(ConfigInterface $config, CacheInterface $cache, Response $response)
    {
        $this->config = $config;
        $this->response = $response;
        $this->cache = $cache;

        $this->secret = $config->get('jwt.secret');
        $this->ttl = $config->get('jwt.ttl');
        $this->alg = $config->get('jwt.alg');
        $this->multiPlatform = $config->get('jwt.multiPlatform');
        $this->whitelist = $this->multiPlatform ?: $config->get('jwt.whitelist');
        $this->blacklist = $this->whitelist ? false : $config->get('jwt.blacklist');
    }

    /**
     * @param int $accountId
     * @param null $platform
     *
     * @throws \Exception
     * @return string
     */
    public function generate(int $accountId, $platform = null)
    {
        $now = time();
        $jti = Uuid::uuid4()->toString();
        $payload = [
            'sub' => $accountId,
            'iat' => $now,
            'exp' => $now + $this->ttl,
            'nbf' => $now,
            'jti' => $jti,
        ];

        if ($this->multiPlatform && $platform !== null) {
            $payload['plf'] = $platform;
        }
        try{
            if ($this->whitelist) {
                if ($this->multiPlatform && $platform !== null) {
                    $this->cache->set('token:w:p:' . $platform . ':' . $accountId, $jti, $this->ttl);
                } else {
                    $this->cache->set('token:w:' . $accountId, $jti, $this->ttl);
                }
            }
            return JWT::encode($payload, $this->secret, $this->alg);
        }catch (\Psr\SimpleCache\InvalidArgumentException $e) {
            var_export($e->getMessage());
            throw new BusinessException(ErrorCode::CACHE_INVALID_ARGUMENT, $e->getMessage());
        }catch (\Exception $e){
            var_export($e->getMessage());
            throw new BusinessException(ErrorCode::GENERATE_TOKEN, '错误的Token');
        }

    }

    /**
     * @param string $token
     *
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @return object
     */
    public function verify(string $token): ?object
    {
        try{
            $payload = JWT::decode($token, $this->secret, [$this->alg]);

            if ($this->blacklist) {
                if ($this->cache->get('token:b:' . $payload->jti)) {
                    throw new BusinessException(ErrorCode::INCORRECT_TOKEN);
                }
            }

            if ($this->whitelist) {
                if ($this->multiPlatform) {
                    $jti = $this->cache->get('token:w:p:' . $payload->plf . ':' . $payload->sub);
                } else {
                    $jti = $this->cache->get('token:w:' . $payload->sub);
                }
                if (! $jti || $jti !== $payload->jti) {
                    throw new BusinessException(ErrorCode::INCORRECT_TOKEN);
                }
            }

            return $payload;
        }catch (\Exception $e){
            var_export($e->getMessage());
            throw new BusinessException(ErrorCode::INCORRECT_TOKEN, '请求的Token错误或已过期');
        }
    }

    /**
     * @param object $token
     *
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function delete(object $token)
    {
        if ($this->blacklist) {
            $this->cache->set('token:b:' . $token->jti, true, $token->exp - time());
        }

        if ($this->whitelist) {
            if ($this->multiPlatform) {
                $this->cache->delete('token:w:p:' . $token->plf . ':' . $token->sub);
            } else {
                $this->cache->delete('token:w:' . $token->sub);
            }
        }
    }

    /**
     * @param object $token
     *
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @return string
     */
    public function refresh(object $token)
    {
        $this->delete($token);

        return $this->generate($token->sub, $token->plf);
    }

    public function clear()
    {
        if ($this->config->get('cache.default.driver') !== RedisDriver::class) {
            return;
        }

        $container = ApplicationContext::getContainer();
        $redis = $container->get(Redis::class);
        $redis->setOption(Redis::OPT_SCAN, Redis::SCAN_RETRY);
        $cursor = null;
        $pattern = $this->config->get('cache.default.prefix') . 'token:*';
        while ($keys = $redis->scan($cursor, $pattern)) {
            foreach ($keys as $key) {
                $redis->del($key);
            }
        }
    }
}