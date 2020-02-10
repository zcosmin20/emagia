<?php
/**
 *
 * Created by PhpStorm.
 * User: Zota Cosmin
 * Date: 10.02.2020
 * Time: 08:48
 */

use App\Interfaces\Skills\InterfaceDefenseSkill;
use App\Logger;

class MagicShield implements InterfaceDefenseSkill
{

    public function defense($defender, $attacker, $chance)
    {
        if ($chance == mt_rand (1, 100)) {
            $damage = ($attacker->getStrength () - $defender->getDefence ()) / 2;
            Logger::output(sprintf ("%s has been used %s.<br>", $defender->getName (), 'MagicShield'));
        }

        $damage = $defender->getDefence ();

        return $damage;
    }
}