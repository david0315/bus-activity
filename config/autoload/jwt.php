<?php

declare(strict_types=1);

return [
    // 密钥
    'secret' => env('JWT_SECRET', 'secret'),

    // 加密算法
    'alg' => 'HS256',

    // 有效期，单位：微妙
    'ttl' => 864000000,

    // 是否开启黑名单，开启后可撤销Token（黑名单和白名单同时开启时自动关闭黑名单）
    'blacklist' => false,

    // 是否开启白名单，开启后可实现踢掉线
    'whitelist' => false,

    // 是否开启多平台支持，开启后可实现多平台在线
    'multiPlatform' => false,
];
