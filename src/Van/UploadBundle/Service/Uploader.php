<?php

namespace Van\UploadBundle\Service;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Van\ResourceBundle\Entity\Blueprint;
use Van\ResourceBundle\Model\Uploadable;

class Uploader
{
    /**
     * @var string
     */
    private $directory;

    /**
     * Construct
     */
    public function __construct()
    {
    }

    /**
     * Upload an uploadable object
     *
     * @param Uploadable $uploadable
     * @param bool $randomize
     *
     * @throws \InvalidArgumentException
     */
    public function upload(Uploadable $uploadable, $randomize = true)
    {
        $file = $uploadable->getFile();
        if (!$file instanceof UploadedFile) {
            throw new \InvalidArgumentException('There is no file to upload!');
        }
        $fileName = $this->generateFilename($file, $randomize);

        $file->move($this->directory . '/' . $uploadable->getUploadDir(), $fileName);
        $uploadable->setPath($fileName);
    }

    /**
     * Generates file name, randomly or not
     *
     * @param File $file
     * @param bool $randomize
     *
     * @return string
     */
    private function generateFilename(File $file, $randomize = true)
    {
        if ($randomize) {
            $filename = sprintf('%s.%s', md5(uniqid($file, true)), $file->guessExtension());

        } else {
            $filename = sprintf('%s.%s', $file->getBasename(), $file->guessExtension());
        }

        return $filename;
    }
}