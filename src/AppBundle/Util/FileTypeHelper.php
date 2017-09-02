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

class FileTypeHelper
{
    const PDF = 'pdf';
    const WORD = 'word document';
    const EXCEL = 'excel document';
    const IMAGE = 'image';

    public static function getFileType(File $file)
    {
        if(is_file($file->getFileName())) {
            throw new Exception('No File is not uploaded!');
        }

        if(self::isImage($file)) {
            return self::IMAGE;
        }
        else if(self::isPdf($file)) {
            return self::PDF;
        }
        else if(self::isWord($file)) {
            return self::WORD;
        }
        else if(self::isExcel($file)) {
            return self::EXCEL;
        }
        else {
            throw new Exception('File not allowed!');
        }
    }

    public static function isImage($file)
    {
        return strpos($file->getMimeType(), 'image') !== false;
    }

    public static function isPdf($file)
    {
        return strpos($file->getMimeType(), 'pdf') !== false;
    }

    public static function isWord($file)
    {
        return strpos($file->getMimeType(), 'msword') !== false;
    }

    public static function isExcel($file)
    {
        return strpos($file->getMimeType(), 'xls') !== false;
    }
}