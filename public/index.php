<?php
require_once __DIR__ . '/../vendor/autoload.php';

use MuslimahGuide\app\router;
use MuslimahGuide\controller\homeController;


router::add("web",'GET', '/', homeController::class, 'landingPage', []);

Router::run();