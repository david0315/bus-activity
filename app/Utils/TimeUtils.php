<?php
declare(strict_types=1);

namespace App\Utils;

use Carbon\Carbon;

class TimeUtils
{

    public static function dayRange($day, $sub = 7){
        $obj = new Carbon($day);
        $end = $obj->toDateString();
        $start = $obj->subDays($sub)->toDateString();
        return [$start, $end];
    }

    public static function tomorrow(){
        return Carbon::tomorrow();
    }
    public static function yesterday(){
        return Carbon::yesterday();
    }

    public static function addDateDay($startDate, $day){
        $obj = new Carbon($startDate);
        return $obj->addDays($day)->toDateString();
    }

    public static function birthdayToAge($birthday){
        $obj = new Carbon($birthday);
        return $obj->age;
    }
    public static function diffDayForHumans($startDay, $endDay){
        $obj = new Carbon($startDay);
        return $obj->diffInDays($endDay);
    }
    public static function diffMonthForHumans($startDay, $endDay){
        $obj = new Carbon($startDay);
        return $obj->diffInMonths($endDay);
    }

    public static function weekFirstDay($day){
        $obj = new Carbon($day);
        return $obj->startOfWeek()->toDateString();
    }

    public static function weekRange($day){
        $obj = new Carbon($day);
        $start = $obj->startOfWeek()->toDateTimeString();
        $end = $obj->endOfWeek()->toDateTimeString();
        return [$start, $end];
    }

    public static function monthRange($day){
        $obj = new Carbon($day);
        $start = $obj->startOfMonth()->toDateTimeString();
        $end = $obj->endOfMonth()->toDateTimeString();
        return [$start, $end];
    }

    public static function isBirthday($day){
        $obj = new Carbon();
        $born = new Carbon($day);
        return $obj->isBirthday($born);
    }
    /**
     * 今日开始结束时间
     */
    public static function currentDayRange(){
        $obj = new Carbon();
        return [$obj->startOfDay()->toDateTimeString(), $obj->endOfDay()->toDateTimeString()];
    }
    public static function yesterdayDayRange(){
        $obj = Carbon::yesterday();
        return [$obj->startOfDay()->toDateTimeString(), $obj->endOfDay()->toDateTimeString()];
    }
    /**
     * 当前周开始结束时间
     */
    public static function currentWeekRange(){
        $obj = new Carbon();
        return [$obj->startOfWeek()->toDateTimeString(), $obj->endOfWeek()->toDateTimeString()];
    }
    public static function lastWeekRange(){
        $obj = new Carbon();
        $obj = $obj->subDays(7);
        return [$obj->startOfWeek()->toDateTimeString(), $obj->endOfWeek()->toDateTimeString()];
    }
    /**
     * 当前月开始结束时间
     */
    public static function currentMonthRange(){
        $obj = new Carbon();
        return [$obj->startOfMonth()->toDateTimeString(), $obj->endOfMonth()->toDateTimeString()];
    }
    public static function lastMonthRange(){
        $obj = new Carbon();
        return [$obj->lastOfMonth()->startOfMonth()->toDateTimeString(), $obj->lastOfMonth()->endOfMonth()->toDateTimeString()];
    }

    /**
     * @param $month
     * @return array
     */
    public static function getMonthRange($month){
        $obj = Carbon::createFromDate(null, $month);
        $obj->month($month);
        return [$obj->startOfMonth()->toDateTimeString(), $obj->endOfMonth()->toDateTimeString(), "{$obj->year}-$month"];
    }

    /**
     * 当月第一天
     * @return string
     * @throws \Exception
     */
    public static function currentMonthFirstDay(){
        $obj = new Carbon();
        return $obj->startOfMonth()->toDateTimeString();
    }

    /**
     * @param $year
     * @param $month
     * @return array
     */
    public static function getYearMonthRange($year, $month){
        $obj = Carbon::createFromDate($year, $month);
        $obj->year($year);
        $obj->month($month);
        return [$obj->startOfMonth()->toDateTimeString(), $obj->endOfMonth()->toDateTimeString(), "$year-$month"];
    }

    /**
     * 计算相差月份
     * @param $startDate
     * @param $endDate
     * @return float|int|string
     * @throws \Exception
     */
    public static function diffMonth($startDate, $endDate){
        $start = new \DateTime($startDate);
        $end =  new \DateTime($endDate);
        $diff = $start->diff($end);
        return $diff->format('%y')*12+$diff->format('%m');
    }

    /**
     * @param string $format
     * @param float|null $uTimestamp
     * @return null|string
     */
    static function uDate(string $format = 'Y-m-d H:i:s.u', ?float $uTimestamp = null): ?string
    {
        if (is_null($uTimestamp)) {
            $uTimestamp = microtime(true);
        }
        $timestamp = floor($uTimestamp);
        $milliseconds = round(($uTimestamp - $timestamp) * 1000000);
        $res = date(preg_replace('`(?<!\\\\)u`', $milliseconds, $format), $timestamp);
        return $res ? $res : null;
    }
    /**
     * 根据生日算年龄
     * @param string $birthday
     * @return int|null
     */
//    static function birthdayToAge(string $birthday): ?int
//    {
//        $age = strtotime($birthday);
//        if ($age === false) {
//            return null;
//        }
//        list($y1, $m1, $d1) = explode('-', date('Y-m-d', $age));
//        $now = strtotime('now');
//        list($y2, $m2, $d2) = explode('-', date('Y-m-d', $now));
//        $age = $y2 - $y1;
//        if ((int)($m2 . $d2) < (int)($m1 . $d1)) {
//            $age -= 1;
//        }
//        return $age;
//    }

    /**
     * 获取服务端响应客户端的时间戳
     * @return int
     */
    public static function currentTimestamp()
    {
        return defined('CURRENT_TIMESTAMP') ? CURRENT_TIMESTAMP : time();
    }

    /**
     * 获取服务端响应客户端的时间戳
     * @param bool $float
     * @return float|string
     */
    public static function currentMicroTimestamp($float = true)
    {
        return microtime($float);
    }

    /**
     * 获取当前时间.
     * @param string $format
     * @return false|string
     */
    public static function currentDateTime(string $format = 'Y-m-d H:i:s')
    {
        return date($format, self::currentTimestamp());
    }

    public static function currentDate(string $format = 'Y-m-d'){
        return date($format, self::currentTimestamp());
    }



    /**
     * 返回相对时间（如：20分钟前，3天前）.
     *
     * @param $date
     *
     * @return string
     */
    public static function formatDate($date): string
    {
        $t = time() - (!is_integer($date) ? strtotime($date) : $date) ;
        $f = array(
            '31536000' => '年',
            '2592000' => '个月',
            '604800' => '星期',
            '86400' => '天',
            '3600' => '小时',
            '60' => '分钟',
            '1' => '秒',
        );
        foreach ($f as $k => $v) {
            if (0 != $c = floor($t / (int) $k)) {
                return $c.$v.'前';
            }
        }
    }

    /**
     * 当周开始和结束日期
     * @param int $len
     * @return array
     */
    public static function currentWeek($len = 4){
        $currentTime = self::currentTimestamp();
        $week        = date('w', $currentTime) - 1;
        $startTime   = strtotime("-{$week}Day", $currentTime);
        $weekStart   = date('Y-m-d', $startTime);
        $weekEnd     = date('Y-m-d', strtotime("+{$len}Day", $startTime));
        return ['start' => $weekStart, 'end' => $weekEnd];
    }

    /**
     * 当月开始和结束日期
     * @return array
     */
    public static function currentMonth(){
        $currentTime = self::currentTimestamp();
        $month = date('m', $currentTime);
        $year = date('Y', $currentTime);
        $day = self::getMonthLastDay($month, $year);
        $begin = date("$year-$month-01", self::currentTimestamp());
        $end = date("$year-$month-$day 23:59:59", self::currentTimestamp());
        return ['start' => $begin, 'end' => $end];
    }
}