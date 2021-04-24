<?php

namespace App\Utils;

/**
 * Class FileUploader
 * @package App\Utils
 */
class FileUploader
{
    private const DEFAULT_FOLDER = 'uploads';

    /**
     * @var array
     */
    private $file;
    /**
     * @var string
     */
    private $uploadPathFolder;
    /**
     * @var string
     */
    private $fileName;

    /**
     * FileUploader constructor.
     * @param array $file
     * @param string $uploadPathFolder
     * @param string $fileName
     */
    public function __construct(array $file, string $uploadPathFolder, string $fileName)
    {
        $this->file = $file;
        $this->fileName = $fileName;
        $this->uploadPathFolder = $uploadPathFolder;
    }

    /**
     * @param $file
     * @param string $uploadFolderPath
     * @return string
     * @throws \Exception
     */
    public static function upload($file, string $uploadFolderPath = self::DEFAULT_FOLDER): string
    {
        $fileUploader = new self($file, $uploadFolderPath, uniqid());
        return $fileUploader->uploadFile();
    }

    /**
     * @param string $filePath
     * @return bool
     */
    public static function remove(string $filePath)
    {
        $fullPath = PATH_TO_PUBLIC . DIRECTORY_SEPARATOR . $filePath;
        if (file_exists($fullPath)) {
            unlink($fullPath);
            return true;
        }
        return false;
    }

    public function removeFile(string $filePath)
    {
        return self::remove($filePath);
    }

    /**
     * @return string
     * @throws \Exception
     */
    private function uploadFile(): string
    {
        $uploadFolder = $this->getUploadPathFolder();
        $ext = pathinfo($this->file['name'], PATHINFO_EXTENSION);
        $fileName = $this->fileName . '.' . $ext;
        $fullPathToFile = $uploadFolder . DIRECTORY_SEPARATOR . $fileName;
        $pathToFile = $this->uploadPathFolder . DIRECTORY_SEPARATOR . $fileName;

        if (!move_uploaded_file($this->file['tmp_name'], $fullPathToFile)) {
            throw new \Exception('An unknown error occurred while uploading the file.');
        };

        return $pathToFile;
    }


    /**
     * @return string
     */
    private function getUploadPathFolder(): string
    {
        $fillPath = PATH_TO_PUBLIC . DIRECTORY_SEPARATOR . $this->uploadPathFolder;
        if (!is_dir($fillPath)) {
            mkdir($fillPath, 0777);
        }
        return $fillPath;
    }
}