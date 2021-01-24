<?php
declare(strict_types=1);
namespace App\Utils;
/**
 * Class PasswordHelper
 * @package App\Widgets
 * Date: 3/12/19
 * Time: 16:18
 * Author: david.li
 */
class PasswordUtils
{
    public static $salt = 'bus-activity';

    /**
     * 自定义
     * @param $password
     * @param $salt
     * @return string
     */
    public static function hash($password, $salt = '')
    {
        if(!$salt){
            self::$salt = $salt;
        }
        return hash('sha512', self::$salt . $password);
    }

    /**
     * @param $password
     * @param $hash
     * @param $salt
     * @return bool
     */
    public static function verify($password, $hash, $salt)
    {
        return ($hash == self::hash($password, $salt));
    }

    /**
     * @param $password
     * @return bool|string
     */
    public static function passwordHash($password){
        return password_hash($password, PASSWORD_DEFAULT, ['cost' => 4]);
    }

    /**
     * @param $password
     * @param $hash
     * @return bool
     */
    public static function passwordVerify($password, $hash):bool {
        return password_verify($password, $hash);
    }

}