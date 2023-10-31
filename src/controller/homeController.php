<?php

namespace MuslimahGuide\controller;

use MuslimahGuide\app\view;

class homeController
{
    function landingPage(){
        view::render('landingPage', ["title" => "Landing page"]);
    }
}