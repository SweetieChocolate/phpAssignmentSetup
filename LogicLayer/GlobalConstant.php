<?php

namespace GlobalConstant
{
    class ContactType
    {
        public static string $BUSINESS = "B";
        public static string $PERSONAL = "P";

        public static function GetContactTypeText(string $contactType) : string
        {
            switch ($contactType)
            {
                case ContactType::$BUSINESS:
                    return "Business";
                case ContactType::$PERSONAL:
                    return "Personal";
                default:
                    return "";
            }
        }

        public static function GetContactTypeDropDownList() : array
        {
            $resultList = array();
            $resultList[ContactType::$BUSINESS] = ContactType::GetContactTypeText(ContactType::$BUSINESS);
            $resultList[ContactType::$PERSONAL] = ContactType::GetContactTypeText(ContactType::$PERSONAL);
            return $resultList;
        }
    }
}

?>