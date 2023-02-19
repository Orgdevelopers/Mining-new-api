<?php

class PasswordUtil {
    public static function EncryptPassword($password)
    {
        $privateKey 	= 'CAPITAL09KEYFORTESTING33HQ1HQ2HQ3L0L'; 
        $secretKey 		= '1j2gh28i3h9'; 
        $encryptMethod      = "AES-256-CBC";
        $string 		= $password; 

        $key = hash('sha256', $privateKey);
        $ivalue = substr(hash('sha256', $secretKey), 0, 16); // sha256 is hash_hmac_algo
        $result = openssl_encrypt($string, $encryptMethod, $key, 0, $ivalue);
        $output = base64_encode($result);  // output is a encripted value

        return $output;
    }

    public static function DecryptPassword($password_hash)
    {
        $privateKey 	= 'CAPITAL09KEYFORTESTING33HQ1HQ2HQ3L0L'; 
        $secretKey 		= '1j2gh28i3h9'; 
        $encryptMethod      = "AES-256-CBC";
        $stringEncrypt      = $password_hash; 

        $key    = hash('sha256', $privateKey);
        $ivalue = substr(hash('sha256', $secretKey), 0, 16); // sha256 is hash_hmac_algo

        $output = openssl_decrypt(base64_decode($stringEncrypt), $encryptMethod, $key, 0, $ivalue);

        return $output;
    }
}

?>