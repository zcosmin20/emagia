<?php
/**
 *
 * Created by PhpStorm.
 * User: Zota Cosmin
 * Date: 2/9/2020
 * Time: 7:01 PM
 */

namespace App\Interfaces\Skills;

interface InterfaceDefenseSkill
{
    public function defense($defender, $attacker, $chance);

}