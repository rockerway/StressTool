<?php

class CurlController{
    private $ch;
    private $cookiePath;

    public function __construct(){
        $this->cookiePath = dirname(__FILE__) . "/cookie";
	$this->init();
    }

    private function init(){
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_COOKIEJAR, $this->cookiePath);
        curl_setopt($this->ch, CURLOPT_COOKIEFILE, $this->cookiePath);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
    }

    public function get($url){
        curl_setopt($this->ch, CURLOPT_URL, $url);
        return $this->request();
    }


    public function openPost(){
        curl_setopt($this->ch, CURLOPT_POST, true);
    }

    public function closePost(){
        curl_setopt($this->ch, CURLOPT_POST, false);
    }

    public function post($url, $postInfo){
        curl_setopt($this->ch, CURLOPT_URL, $url);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $postInfo);
        return $this->request();
    }

    private function request(){
        $result = new stdClass();
        $result->response = curl_exec($this->ch);
        $result->status = curl_getinfo($this->ch);
        return $result;
    }

    public function close(){
        curl_close($this->ch);
    }
}

