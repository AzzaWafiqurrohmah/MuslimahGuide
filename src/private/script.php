<?php

require_once __DIR__ . "/../Service/scriptService.php";
use MuslimahGuide\Service\scriptService;

$coba = new scriptService();

$coba->update("contoh1" , "contoh2@gmail.com");

