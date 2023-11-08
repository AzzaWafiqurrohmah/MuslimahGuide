<?php

namespace MuslimahGuide\controller;

use MuslimahGuide\app\view;
use MuslimahGuide\service\adminService;
use MuslimahGuide\Service\sessionService;

class homeController
{
    function landingPage(){
        view::render('landingPage');
    }

    function postLandingPage(){
        view::redirect('login');
    }

}