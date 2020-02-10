<?php

namespace App\Classes;

use MagicShield;
use RapidStrike;

/**
 *
 * Created by PhpStorm.
 * User: Zota Cosmin
 * Date: 2/9/2020
 * Time: 6:52 PM
 */
class Hero extends BaseClasses
{
    public function __construct($atributes = [])
    {
        parent::__construct ($atributes);

        $this->setSkills ([
            new RapidStrike(),
            new MagicShield()
        ]);
    }
}