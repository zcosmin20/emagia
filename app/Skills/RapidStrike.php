<?php
/**
 *
 * Created by PhpStorm.
 * User: Zota Cosmin
 * Date: 10.02.2020
 * Time: 08:48
 */

use App\Interfaces\Skills\InterfaceAtackSkill;
use App\Logger;

class RapidStrike implements InterfaceAtackSkill
{
    public $name = 'Rapid strike skill';

    public function strikeAttack($attacker, $defender, $chance)
    {
        $damage = 0;
        if ($chance == mt_rand (1, 100)) {
            $damage = ($attacker->getStrength () * 2) - $defender->getDefence ();
            Logger::output(sprintf ("%s has been used %s.<br>", $attacker->getName (), $this->name));
        }
        return $damage;
    }
}