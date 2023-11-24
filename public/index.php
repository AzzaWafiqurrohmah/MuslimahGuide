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
use MuslimahGuide\controller\verificationController;
use MuslimahGuide\Middleware\mustLoginMiddleware;
use MuslimahGuide\Middleware\mustNotLoginMiddleware;

session_start();

//website
router::add("web", "GET", "/", homeController::class, 'landingPage', [mustNotLoginMiddleware::class]);
router::add("web", "POST", "/", homeController::class, 'PostLandingPage', []);

router::add("web", "GET", "/login", adminController::class, 'login', [mustNotLoginMiddleware::class]);
router::add("web", "POST", "/login", adminController::class, 'postLogin', []);

router::add("web", "GET", "/dashboard", dashboardController::class, 'dashboard', [mustLoginMiddleware::class]);
router::add("web", "POST", "/dashboard", dashboardController::class, 'postDashboard', []);
router::add("web", "GET", "/userTable", userTableController::class, 'userTable', [mustLoginMiddleware::class]);
router::add("web", "POST", "/userTable", userTableController::class, 'userTable', []);
router::add("WEB", "GET", "/profile", profileController::class, 'profile', [mustLoginMiddleware::class]);
router::add("WEB", "POST", "/profile", profileController::class, 'postProfile', []);
router::add("WEB", "GET", "/uploadArticle", uploadController::class, 'upload', [mustLoginMiddleware::class]);
router::add("WEB", "POST", "/uploadArticle", uploadController::class, 'postUpload', []);
router::add("WEB", "GET", "/article", articleController::class, 'article', [mustLoginMiddleware::class]);
router::add("WEB", "POST", "/article", articleController::class, 'postArticle', []);
router::add("WEB", "GET", "/editArticle", editArticleController::class, 'editArticle', [mustLoginMiddleware::class]);
router::add("WEB", "POST", "/editArticle", editArticleController::class, 'postEditArticle', []);

router::add("WEB", "GET", "/verificationEmail", verificationController::class, 'email', []);
router::add("WEB", "POST", "/verificationEmail", verificationController::class, 'postEmail', []);
router::add("WEB", "GET", "/verificationCode", verificationController::class, 'code', []);
router::add("WEB", "POST", "/verificationCode", verificationController::class, 'postCode', []);
router::add("WEB", "GET", "/verificationNewPassword", verificationController::class, 'newPassword', []);
router::add("WEB", "POST", "/verificationNewPassword", verificationController::class, 'postNewPassword', []);

//API
router::add("API", "GET", '/loginAPI', adminController::class, 'loginAPI');
router::add("API", "GET", '/registerAPI', adminController::class, 'registerAPI');
router::add("API", "GET", '/profileAPI', profile::class, 'get_profile');
router::add("API", "PUT", '/profileAPI', profile::class, 'put_profile');



router::run();