<?php

namespace Van\ResourceBundle\Model;


interface Uploadable
{
    public function setPath($path);

    public function getFile();

    public function getWebPath();

    public function getAbsolutePath();

    public function removeUpload();
} 