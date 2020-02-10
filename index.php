<?php
/**
 *
 * Created by PhpStorm.
 * User: Zota Cosmin
 * Date: 2/9/2020
 * Time: 6:45 PM
 */


require_once ('vendor/autoload.php');

use App\App;
use App\Battle;
use App\Classes\Hero;
use App\Classes\Monster;

//init the status

$hero = new Hero(App::HERO_STATUS);
$monster = new Monster(App::BEAST_STATUS);

$battle = new Battle($hero, $monster, App::ROUNDS);

$battle->startFight ();