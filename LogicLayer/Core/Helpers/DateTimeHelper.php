<?php

date_default_timezone_set('Asia/Bangkok');

class DateTimeHelper
{
    public static function Now() : DateTime
    {
        return (new DateTime());
    }
    public static function ForQuery(DateTime $dateTime) : string
    {
        $str = DateTimeHelper::ConvertToString($dateTime);
        return "'$str'";
    }
    public static function ConvertToString(DateTime $dateTime) : string
    {
        return $dateTime->format("Y/m/d H:i:s.u");
    }
    public static function ConvertToStringMonth(DateTime $dateTime) : string
    {
        return $dateTime->format("Y-M");
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
    public static function ConvertForFormMonth(DateTime $dateTime) : string
    {
        return $dateTime->format('Y-m');
    }
    public static function GetDatePart(DateTime $dateTime) : DateTime
    {
        return (new DateTime($dateTime->format("Y/m/d")));
    }
    public static function GetMonthStart(DateTime $dateTime) : DateTime
    {
        return (new DateTime($dateTime->format("Y/m/")."1"));
    }
    public static function GetMonthEnd(DateTIme $dateTime) : DateTime
    {
        $nextMonth = DateTimeHelper::AddMonths($dateTime, 1);
        return DateTimeHelper::AddDays($nextMonth, -1);
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
    public static function AddMonths(DateTime $dateTime, int $month) : DateTime
    {
        if ($month < 0)
            return DateTimeHelper::SubMonths($dateTime, $month);
        $result = DateTimeHelper::FromString(DateTimeHelper::ConvertToString($dateTime));
        $interval = new DateInterval("P".$month."M");
        $result->add($interval);
        return $result;
    }
    private static function SubMonths(DateTime $dateTime, int $month) : DateTime
    {
        $month = abs($month);
        $result = DateTimeHelper::FromString(DateTimeHelper::ConvertToString($dateTime));
        $interval = new DateInterval("P".$month."M");
        $result->sub($interval);
        return $result;
    }
    public static function DayDiff(DateTime $fromDate, DateTime $toDate) : int
    {
        return DateTimeHelper::GetDatePart($fromDate)->diff(
            DateTimeHelper::GetDatePart($toDate))->d;
    }
}

?>