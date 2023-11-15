<?php
require_once __DIR__ . '/../vendor/autoload.php';

use MuslimahGuide\app\router;
use MuslimahGuide\controller\homeController;
use MuslimahGuide\controller\adminController;
use MuslimahGuide\controller\dashboardController;
use MuslimahGuide\controller\userTableController;
use MuslimahGuide\controller\profileController;
use MuslimahGuide\controller\uploadController;
use MuslimahGuide\controller\articleController;
use MuslimahGuide\controller\editArticleController;
use MuslimahGuide\controller\api\profile;

//require __DIR__ . '/../src/view/login.php';

//website
router::add("web", "GET", "/", homeController::class, 'landingPage', []);
router::add("web", "POST", "/", homeController::class, 'PostLandingPage', []);

router::add("web", "GET", "/login", adminController::class, 'login', []);
router::add("web", "POST", "/login", adminController::class, 'postLogin', []);

router::add("web", "GET", "/dashboard", dashboardController::class, 'dashboard', []);
router::add("web", "POST", "/dashboard", dashboardController::class, 'postDashboard', []);
router::add("web", "GET", "/userTable", userTableController::class, 'userTable', []);
router::add("web", "POST", "/userTable", userTableController::class, 'userTable', []);
router::add("WEB", "GET", "/profile", profileController::class, 'profile', []);
router::add("WEB", "POST", "/profile", profileController::class, 'postProfile', []);
router::add("WEB", "GET", "/uploadArticle", uploadController::class, 'upload', []);
router::add("WEB", "POST", "/uploadArticle", uploadController::class, 'postUpload', []);
router::add("WEB", "GET", "/article", articleController::class, 'article', []);
router::add("WEB", "POST", "/article", articleController::class, 'postArticle', []);
router::add("WEB", "GET", "/editArticle", editArticleController::class, 'editArticle', []);
router::add("WEB", "POST", "/editArticle", editArticleController::class, 'postEditArticle', []);

//API
router::add("API", "GET", '/loginAPI', adminController::class, 'loginAPI');
router::add("API", "GET", '/registerAPI', adminController::class, 'registerAPI');
router::add("API", "GET", '/profileAPI', profile::class, 'get_profile');
router::add("API", "PUT", '/profileAPI', profile::class, 'put_profile');



router::run();