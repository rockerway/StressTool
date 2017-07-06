<?php

class FileController{
    private $file;
    private $path;

    public function __construct($filePath){
        $this->path = $filePath;
        $this->file = fopen($filePath, "rw");
    }

    public function getContents(){
        $contents = fread($this->file, filesize($this->path));
        return $contents;
    }

    public function close(){
        fclose($this->file);
    }
}

