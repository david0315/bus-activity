<?php
declare(strict_types=1);

namespace App\Utils;


use App\Constants\ConstData;

class CommonUtils
{
    /**
     * @param array $params
     * @param bool $isEnCode
     * @return string
     */
    public static function getSignContent( array $params, $isEnCode = false ) : string
    {
        $stringToBeSigned = "";
        $i                = 0;
        foreach( $params as $k => $v ){
            if( $k == 'sign' ){
                continue;
            }
            if( false === self::checkEmpty( $v ) && "@" != substr( $v, 0, 1 ) ){
                if($isEnCode){
                    $v = urlencode($v);
                }
                if( $i == 0 ){
                    $stringToBeSigned .= "$k"."="."$v";
                } else{
                    $stringToBeSigned .= "&"."$k"."="."$v";
                }
                $i ++;
            }
        }
        return $stringToBeSigned;
    }

    public  static  function checkEmpty( $value )
    {
        if( !isset( $value ) )
            return true;
        if( $value === null )
            return true;
        if( trim( $value ) === "" )
            return true;
        return false;
    }

    /**
     * 拓课云 - 加密密码
     * 加密数据
     * @param $input
     * @param $encryptKey
     * @return string
     */
    public static function encrypt($input, $encryptKey){//数据加密
        if (strlen($input) % 16 === 0) {
            $input = 4567;
        }else{
            $pad = 16 - (strlen($input) % 16);
            $input = $input . str_repeat(chr(0), $pad);
        }
        $input = openssl_encrypt($input, 'AES-128-ECB', $encryptKey, OPENSSL_RAW_DATA | OPENSSL_NO_PADDING);
        return bin2hex($input);
    }

    public static function makeRangeDate($begin, $end){
        $result = [];
        $begin = strtotime($begin);
        $end = strtotime($end);
        for ($i = $begin; $i <=$end; $i += 86400){
            $result[date('Y-m-d', $i)] = ['week' => date('N', $i)];
        }
        return $result;
    }

    public static function mergeArray($data, $key){
        $result = [];
        foreach ($data as $item) {
            $result[$item[$key]][] = $item;
        }
        return $result;
    }

    /**
     * 生成学生编号
     * @param $studentId
     * @return string
     */
    public static function makeStudentNO(string $studentId){
        return ConstData::STUDENT_NO_PREFIX . str_pad($studentId, ConstData::STUDENT_NO_LENGTH, '0', STR_PAD_LEFT);
    }

    /**
     * 生成短信验证码
     * @param int $len
     * @return bool|string
     */
    public static function makeSmsCode($len = 4){
        $char = [1,2,3,4,5,6,7,8,9,1,2,3,4,5,6,7,8,9,1,2,3,4,5,6,7,8,9,1,2,3,4,5,6,7,8,9,1,2,3,4,5,6,7,8,9];
        $range = count($char) - 1;
        $res = [];
        for ($i = 0 ; $i < $len ; $i++){
            # 100 W次， mt_rand 比 rand 快了 0.5 秒
            array_push($res, $char[mt_rand(0, $range)]);
        }
        return str_shuffle(implode('', $res));
    }

    /**
     * 默认值
     * @param $options
     * @param $key
     * @param string $default
     * @return string
     */
    public static function arrayGet(&$options, $key, $default = ''){
        return ($options[$key] ?? $default) ?: $default;
    }

}