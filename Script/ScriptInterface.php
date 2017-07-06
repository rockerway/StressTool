<?php

interface ScriptInterface{
    public function run();

    public function setDuring($during);

    public function allowRandomEnd($allow);
}
