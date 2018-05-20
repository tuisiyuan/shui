<?php

namespace Controller;

use Qe\Core\Mvc\BaseController;

class UploaderController extends BaseController
{
    public function upload()
    {
        /*
          This is a ***DEMO*** , the backend / PHP provided is very basic. You can use it as a starting point maybe, but ***do not use this on production***. It doesn't preform any server-side validation, checks, authentication, etc.

          For more read the README.md file on this folder.

          Based on the examples provided on:
          - http://php.net/manual/en/features.file-upload.php
        */

        header('Content-type:application/json;charset=utf-8');

        try {
            if (!isset($_FILES['file']['error']) || is_array($_FILES['file']['error'])) {
                throw new \RuntimeException('Invalid parameters.');
            }

            switch ($_FILES['file']['error']) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    throw new \RuntimeException('No file sent.');
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    throw new \RuntimeException('Exceeded filesize limit.');
                default:
                    throw new \RuntimeException('Unknown errors.');
            }

            $ymd = date('Ymd');

            $fileBasePath = '/opt/upload/' . $ymd;
            if (!is_dir($fileBasePath)) {
                mkdir($fileBasePath, 0755);
            }

            $houZhui = substr(strrchr($_FILES['file']['name'], '.'), 1);
            $fileName = uniqid() . '.' . $houZhui;
            $filePath = $fileBasePath . '/' . $fileName;

            if (!move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
                throw new \RuntimeException('Failed to move uploaded file.');
            }

            // All good, send the response
            echo json_encode([
                'status' => 'ok',
                'url' => $ymd . '/' . $fileName
            ]);

        } catch (\RuntimeException $e) {
            // Something went wrong, send the err message as JSON
            http_response_code(400);

            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}
