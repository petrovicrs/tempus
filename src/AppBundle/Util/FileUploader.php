<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 31.08.17
 * Time: 21:59
 */

namespace AppBundle\Util;


use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    private $targetDir;

    public function __construct($targetDir)
    {
        $this->targetDir = $targetDir;
    }

    public function upload(UploadedFile $file)
    {
        $fileName = md5(uniqid()).'.'.$file->guessExtension();

        $file  = $file->move($this->getTargetDir(), $fileName);

        return $file;
    }

    public function getTargetDir()
    {
        return $this->targetDir;
    }
}