<?php

declare(strict_types=1);

namespace App\Constants;

use Hyperf\Constants\AbstractConstants;
use Hyperf\Constants\Annotation\Constants;

/**
 * 定义枚举类 [https://www.bookstack.cn/read/Hyperf-1.1.1/constants.md]
 * @Constants
 */
class ErrorCode extends AbstractConstants
{

    const ILLEGAL_AES_KEY = -41001;

    const ILLEGAL_IV = -41002;
    const ILLEGAL_BUFFER = -41003;
    const DECODE_BASE64_ERROR = -41004;

    /**
     * @Message("Continue")
     */
    const CONTINUE = 100;

    /**
     * @Message("Switching Protocols")
     */
    const SWITCHING_PROTOCOLS = 101;

    /**
     * @Message("OK")
     */
    const OK = 200;

    /**
     * @Message("Created")
     */
    const CREATED = 201;

    /**
     * @Message("Accepted")
     */
    const ACCEPTED = 202;

    /**
     * @Message("Non-Authoritative Information")
     */
    const NON_AUTHOR_INFO = 203;

    /**
     * @Message("No Content")
     */
    const NO_CONTENT = 204;

    /**
     * @Message("Reset Content")
     */
    const RESET_CONTENT = 205;

    /**
     * @Message("Partial Content")
     */
    const PARTIAL_CONTENT = 206;

    /**
     * @Message("Multiple Choices")
     */
    const MULTI_CHOICES = 300;

    /**
     * @Message("Moved Permanently")
     */
    const MOVED_PERMANENTLY = 301;

    /**
     * @Message("Found")
     */
    const FOUND = 302;

    /**
     * @Message("See Other")
     */
    const SEE_OTHER = 303;

    /**
     * @Message("not modified")
     */
    const NOT_MODIFIED = 304;

    /**
     * @Message("use proxy")
     */
    const USE_PROXY = 305;

    /**
     * @Message("unused")
     */
    const UNUSED = 306;

    /**
     * @Message("Temporary Redirect")
     */
    const TEMP_REDIRECT = 307;

    /**
     * @Message("Bad Request")
     */
    const BAD_REQUEST = 400;

    /**
     * @Message("Unauthorized")
     */
    const UNAUTHORIZED = 401;

    /**
     * @Message("Payment Required")
     */
    const PAYMENT_REQUIRED = 402;

    /**
     * @Message("Forbidden")
     */
    const FORBIDDEN = 403;

    /**
     * @Message("Not Found")
     */
    const HTTP_NOT_FOUND = 404;

    /**
     * @Message("Method Not Allowed")
     */
    const METHOD_NOT_ALLOWED = 405;

    /**
     * @Message("Not Acceptable")
     */
    const NOT_ACCEPTABLE = 406;

    /**
     * @Message("Proxy Authentication Required")
     */
    const PROXY_AUTH_REQUIRED = 407;

    /**
     * @Message("Request Time-out")
     */
    const REQUEST_TIMEOUT = 408;

    /**
     * @Message("Conflict")
     */
    const CONFLICT = 409;

    /**
     * @Message("Gone")
     */
    const GONE = 410;

    /**
     * @Message("Length Required")
     */
    const LENGTH_REQUIRED = 411;

    /**
     * @Message("Precondition Failed")
     */
    const PRECONDITION_FAILED = 412;

    /**
     * @Message("Request Entity Too Large")
     */
    const REQUEST_ENTITY_TOO_LARGE = 413;

    /**
     * @Message("Request-URI Too Large")
     */
    const REQUEST_URI_TOO_LARGE = 414;

    /**
     * @Message("Unsupported Media Type")
     */
    const UNSUPPORTED_MEDIA_TYPE = 415;

    /**
     * @Message("Requested range not satisfiable")
     */
    const REQUEST_RANGE_NOT_SATISFIABLE = 416;

    /**
     * @Message("Expectation Failed	")
     */
    const EXPECTATION_FAILED = 417;

    /**
     * @Message("Internal Server Error")
     */
    const SERVER_ERROR = 500;

    /**
     * @Message("Not Implemented")
     */
    const NOT_IMPLEMENTED = 501;

    /**
     * @Message("Bad Gateway")
     */
    const BAD_GATEWAY = 502;

    /**
     * @Message("Service Unavailable")
     */
    const SERVICE_UNAVAILABLE = 503;

    /**
     * @Message("Gateway Time-out")
     */
    const GATEWAY_TIMEOUT = 504;

    /**
     * @Message("HTTP Version not supported")
     */
    const HTTP_VERSION_NOT_SUPPORTED = 505;


    /**
     * @HttpCode("404")
     * @Message("Not Found")
     */
    const NOT_FOUND = 404;


    /**
     * @HttpCode("422")
     * @Message("Un Processable Entity")
     */
    const UN_PROCESSABLE_ENTITY = 422;


    /**
     * @HttpCode("400")
     * @Message("Incorrect password")
     */
    const INCORRECT_PASSWORD = 10001;

    /**
     * @HttpCode("400")
     * @Message("Token is required")
     */
    const EMPTY_TOKEN = 10002;

    /**
     * @HttpCode("400")
     * @Message("User not Found")
     */
    const ACCOUNT_NOT_FOUND = 10003;

    /**
     * @HttpCode("401")
     * @Message("Incorrect token")
     */
    const INCORRECT_TOKEN = 10004;

    /**
     * @HttpCode("401")
     * @Message("Api key is required")
     */
    const EMPTY_API_KEY = 10005;

    /**
     * @HttpCode("401")
     * @Message("Signature is required")
     */
    const EMPTY_SIGNATURE = 10006;

    /**
     * @HttpCode("401")
     * @Message("Timestamp is required")
     */
    const EMPTY_TIMESTAMP = 10007;

    /**
     * @HttpCode("401")
     * @Message("Incorrect api key")
     */
    const INCORRECT_API_KEY = 10008;

    /**
     * @HttpCode("401")
     * @Message("Incorrect signature")
     */
    const INCORRECT_SIGNATURE = 10009;

    /**
     * @HttpCode("400")
     * @Message("Request is expired")
     */
    const REQUEST_EXPIRED = 10010;

    /**
     * @HttpCode("500")
     * @Message("生成访问Token失败")
     */
    const GENERATE_TOKEN = 10011;

    /**
     * @HttpCode("500")
     * @Message("redis 缓存操作异常-参数错误")
     */
    const CACHE_INVALID_ARGUMENT = 10012;

    /**
     * @HttpCode("500")
     * @Message("请求参数错误")
     */
    const PARAM_ERROR = 4002;

    /**
     * @HttpCode("500")
     * @Message("添加数据缺失")
     */
    const CREATE_OBJECT_EMPTY = 1000001;
    /**
     * @HttpCode("500")
     * @Message("缺少请求参数")
     */
    const MISS_POST_DATA = 1000010;
    /**
     * @HttpCode("500")
     * @Message("创建失败")
     */
    const CREATE_FAILED = 1000011;
    /**
     * @HttpCode("500")
     * @Message("请求参数错误")
     */
    const QUERY_DATA_NOT_FOUND = 1000013;
    /**
     * @HttpCode("500")
     * @Message("请求参数错误")
     */
    const PROCESS_FAILED = 100014;
    /**
     * @HttpCode("500")
     * @Message("请求参数错误")
     */
    const MISS_PRIMARY_KEY_VALUE = 100015;

}
