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
        return $dateTime->format("Y/m/d H:i:s");
    }
    public static function FromString(string $dateTime) : DateTime
    {
        return (new DateTime($dateTime));
    }
}

?>