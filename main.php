<?php

include("StressToolController.php");

$stressToolController = new StressToolController("Script/Edusoho/EdusohoScript.php", "EdusohoScript", "http://127.0.0.1");
$stressToolController->setDuring(60);
$stressToolController->run(true);
$stressToolController->close();
