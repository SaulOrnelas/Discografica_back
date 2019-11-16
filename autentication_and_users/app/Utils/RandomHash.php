<?php

namespace App\Utils;


Class RandomHash{
    public static function randomKey($len)
    {
        $key = '';
        if (function_exists('random_bytes')) {
            $key .= (string) random_bytes($len);
        }
        if (strlen($key) < $len && function_exists('mcrypt_create_iv')) {
            $key .= (string) mcrypt_create_iv($len, MCRYPT_DEV_URANDOM);
        }
        if (strlen($key) < $len && function_exists('openssl_random_pseudo_bytes')) {
            $tmp = (string) openssl_random_pseudo_bytes($len, $strong);
            if ($strong) {
                $key .= $tmp;
            }
        }
        if (strlen($key) < $len) {
            throw new \RuntimeException('Could not gather sufficient random data');
        }
        return $key;
    }

    /**
     * Возвращает случайную строку заданной длины состоящую из цифр, латиницы,
     * знака минус и символа подчеркивания
     *
     * @param int $len
     *
     * @return string
     */
    public static function randomStr($len)
    {
        $key = RandomHash::randomKey($len);
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_';
        $result = '';
        for ($i = 0; $i < $len; ++$i) {
            $result .= substr($chars, (ord($key[$i]) % strlen($chars)), 1);
        }
        return $result;
    }
}