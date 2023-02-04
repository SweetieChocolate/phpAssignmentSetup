<?php

function StringEncryption(string $string, string $password) : string
{
    $ciphering = "AES-128-CTR";
    $encryption_iv = '1234567891011121';
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;
    return openssl_encrypt($string, $ciphering, $password, $options, $encryption_iv);
}

function StringDecryption(string $string, string $password) : string
{
    $ciphering = "AES-128-CTR";
    $encryption_iv = '1234567891011121';
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;
    return openssl_decrypt($string, $ciphering, $password, $options, $encryption_iv);
}
  
?>