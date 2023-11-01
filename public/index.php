<?php
require_once __DIR__ . '/../vendor/autoload.php';

use MuslimahGuide\app\router;
use MuslimahGuide\controller\homeController;
use MuslimahGuide\controller\userController;

//require __DIR__ . '/../src/view/login.php';

//website
router::add("web", "GET", "/", homeController::class, 'landingPage', []);
router::add("web", "POST", "/", homeController::class, 'PostLandingPage', []);

router::add("web", "GET", "/login", userController::class, 'login', []);
router::add("web", "POST", "/login", userController::class, 'postLogin', []);

router::add("web", "GET", "/dashboard", userController::class, 'dashboard', []);

//API
router::add("API", "GET", '/loginAPI', userController::class, 'loginAPI');

router::run();