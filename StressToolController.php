<?php

class StressToolController{
    private $during;
    private $script;
    private $actionArray;
    private $startTime;

    public function __construct($scriptPath, $scriptName, $baseUrl){
        $this->during = 0;
        include($scriptPath);
        $this->script = new $scriptName();
        $this->script->setBaseUrl($baseUrl);
        $this->actionArray = $this->getScriptAction();
    }

    private function getScriptAction(){
        $actionArray = get_class_methods($this->script);
        $newActionArray = array();

        unset($actionArray[array_search("__construct", $actionArray)]);
        unset($actionArray[array_search("setBaseUrl", $actionArray)]);
        unset($actionArray[array_search("close", $actionArray)]);

        foreach($actionArray as $action){
            $newActionArray[] = $action;
        }

        return $newActionArray;
    }

    public function setDuring($during){
        $this->during = $during;
    }

    public function run($allowRandomEnd){
        $this->startTime = microtime(true);
        $this->script->login();
        while(!$this->isEnd()){
            $this->checkTime(); 
        }
    }

    private function checkTime(){
        if($this->isEnd()){
            $this->close();
            die();
        }
    }

    private function isEnd(){
        $now = microtime(true);
        $time = $now - $this->startTime;
        $state = $time >= $this->during ? true : false;

        return $state;
    }

    public function close(){
        $this->script->close();
    }
}

