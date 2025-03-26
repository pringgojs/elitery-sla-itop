<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Crypt;

class EncryptService
{
    public static function encrypt($data)
    {
        try {
            return Crypt::encryptString($data);
        } catch (Exception $e) {
            return null;
        }
    }

    public static function decrypt($encryptedData)
    {
        try {
            return Crypt::decryptString($encryptedData);
        } catch (Exception $e) {
            return null;
        }
    }
}
