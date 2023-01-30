<?php

require_once 'config.php';

class core
{
    protected $timestamp;

    /*
    * @module File Type Verification
    * @desc This Module check if a file is with the correct type (like png or zip). This option can be edit in config file
    */
    public function FileTypeVerification($file)
    {
        $filetype_list = [];
        $type = explode(',', FILELIST);
        foreach ($type as $filetype) {
            array_push($filetype_list, $filetype);
        }
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        if (in_array($ext, $filetype_list)) {
            return true;
        } else {
            return false;
        }
    }

    /*
    * @module File Size Verification
    * @desc This Module check if the file size is correct or if is too high. This option can be disabled in config file
    */
    public function FileSizeVerification($file)
    {
        if (size_verification == true) {
            if ($file['size'] < max_size && $file['size'] > min_size) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    /*
    * @module File Name Convertor
    * @desc This Module convert file name into a encrypted name. This option can be disabled in config file
    */
    public function FileNameConvertor($file)
    {
        $TransformFileName = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIKLMNOPQRSTUVWXYZ123456789'), 0, 15);
        $filename = $TransformFileName.'-'.basename($_FILES['fileToUpload']['name']);

        return $filename;
    }

    public function UploadFile($file, $target)
    {
        $newtarget = file_destination.'/'.$target;
        if (move_uploaded_file($file['tmp_name'], $newtarget)) {
            return true;
        } else {
            return false;
        }
    }
}
