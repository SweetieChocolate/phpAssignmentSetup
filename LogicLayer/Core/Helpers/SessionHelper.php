<?php

if (session_status() === PHP_SESSION_NONE) session_start();

function GetCurrentUser() : OUser | null
{
    if (!isset($_SESSION['USERID'])) return null;
    return User::Load(StringDecryption($_SESSION['USERID'], session_id()));
}

?>