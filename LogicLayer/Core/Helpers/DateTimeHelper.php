<?php

date_default_timezone_set('Asia/Bangkok');

class DateTimeHelper
{
    public static function Now() : DateTime
    {
        return (new DateTime());
    }
    public static function ConvertToString(DateTime $dateTime) : string
    {
        return $dateTime->format("Y/m/d H:i:s.u");
    }
    public static function ConvertToStringDate(DateTime $dateTime) : string
    {
        return $dateTime->format("Y/m/d");
    }
    public static function ConvertToStringDateTime(DateTime $dateTime) : string
    {
        return $dateTime->format("Y/m/d H:i:s");
    }
    public static function FromString(string $dateTime) : DateTime
    {
        return (new DateTime($dateTime));
    }
    public static function ConvertForFormDateTime(DateTime $dateTime) : string
    {
        return $dateTime->format('Y-m-d\TH:i:s');
    }
    public static function ConvertForFormDate(DateTime $dateTime) : string
    {
        return $dateTime->format('Y-m-d');
    }
    public static function AddDays(DateTime $dateTime, int $day) : DateTime
    {
        if ($day < 0)
            return DateTimeHelper::SubDays($dateTime, $day);
        $result = DateTimeHelper::FromString(DateTimeHelper::ConvertToString($dateTime));
        $interval = new DateInterval("P".$day."D");
        $result->add($interval);
        return $result;
    }
    private static function SubDays(DateTime $dateTime, int $day) : DateTime
    {
        $day = abs($day);
        $result = DateTimeHelper::FromString(DateTimeHelper::ConvertToString($dateTime));
        $interval = new DateInterval("P".$day."D");
        $result->sub($interval);
        return $result;
    }
}

?>