<?php
/**
 *
 * Created by PhpStorm.
 * User: Zota Cosmin
 * Date: 2/9/2020
 * Time: 6:57 PM
 */

namespace App\Interfaces\Skills;

interface InterfaceAtackSkill
{

    public function strikeAttack($attacker, $defender, $chance);

}