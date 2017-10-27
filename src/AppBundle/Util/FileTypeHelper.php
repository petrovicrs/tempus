<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 01.09.17
 * Time: 21:59
 */

namespace AppBundle\Util;


use Exception;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileTypeHelper
{

    const ALLOWED_TYPES = [
        'pdf',
        'word',
        'xls',
        'jpg',
        'png'
    ];

    public static function isTypeAllowed(UploadedFile $file)
    {
        if(in_array($file->getClientOriginalExtension(), self::ALLOWED_TYPES)) {
            return true;
        }
        else {
            return false;
        }
    }
}