<?php
require_once __DIR__ . '/../vendor/autoload.php';

use MuslimahGuide\app\router;
use MuslimahGuide\controller\homeController;
use MuslimahGuide\controller\adminController;
use MuslimahGuide\controller\dashboardController;

//require __DIR__ . '/../src/view/login.php';

//website
router::add("web", "GET", "/", homeController::class, 'landingPage', []);
router::add("web", "POST", "/", homeController::class, 'PostLandingPage', []);

router::add("web", "GET", "/login", adminController::class, 'login', []);
router::add("web", "POST", "/login", adminController::class, 'postLogin', []);

router::add("web", "GET", "/dashboard", dashboardController::class, 'dashboard', []);

//API
router::add("API", "GET", '/loginAPI', adminController::class, 'loginAPI');
router::add("API", "GET", '/registerAPI', adminController::class, 'registerAPI');

router::run();