<?php
/**
 *
 * Created by PhpStorm.
 * User: Zota Cosmin
 * Date: 2/9/2020
 * Time: 7:23 PM
 */

namespace App;

use App\Classes\BaseClasses;
use App\Classes\Hero;
use App\Classes\Monster;
use App\Interfaces\Skills\InterfaceAtackSkill;
use App\Interfaces\Skills\InterfaceDefenseSkill;
use App\Logger;
class Battle
{
    private $hero;
    private $monster;

    public function __construct(Hero $hero, Monster $monster, $rounds)
    {
        $this->hero = $hero;
        $this->monster = $monster;
        $this->rounds = $rounds;
    }

    public function startFight()
    {
        list($hero, $monster) = $this->fistBattle ($this->hero, $this->monster);

        for ($round = 1; $round <= $this->rounds; $round++) {
            $this->currentRound = $round;

            if ($this->endOfBattle() === true) {
                break;
            }

            $this->attack ($hero, $monster);

            if ($this->endOfBattle() === true) {
                break;
            }

            $this->attack ($monster, $hero);
        }

        if ($this->hero->getHealth () > 0 && $this->monster->getHealth () > 0) {
            Logger::output("Draw!");
        } elseif ($this->hero->getHealth () > 0) {
            Logger::output(sprintf ("%s won!", $this->hero->getName ()));
        } else {
            Logger::output(sprintf ("%s won!", $this->monster->getName ()));
        }
    }

    protected function fistBattle()
    {
        $ret = [$this->hero, $this->monster];
        if ($this->hero->getSpeed () > $this->monster->getSpeed ()) {
            $this->attack ($this->hero, $this->monster);
            $ret = [$this->monster, $this->hero];
        } elseif ($this->hero->getSpeed () == $this->monster->getSpeed ()) {
            if ($this->hero->getLuck() > $this->monster->getLuck()) {
                $this->attack ($this->hero, $this->monster);
                $ret = [$this->monster, $this->hero];
            } else {
                $this->attack ($this->monster, $this->hero);
            }
        } else {
            $this->attack ($this->monster, $this->hero);
        }

        return $ret;
    }

    private function attack(BaseClasses $attacker, BaseClasses $defender)
    {
        $this->rounds--;
        $damage = 0;
        if (count ($attacker->getSkills ()) > 0) {
            foreach ($attacker->getSkills () as $skill) {
                if ($skill instanceof InterfaceAtackSkill) {
                    $damage += $skill->strikeAttack ($attacker, $defender, 10);
                }
            }
        }
        $damage = $attacker->getStrength () - $defender->getDefence ();
        $this->defender ($defender, $attacker, $damage);
    }

    private function defender(BaseClasses $defender, BaseClasses $attacker, $damage)
    {

        if ($this->defendersHasLuck ($defender)) {
            Logger::output(sprintf ('%s attack %s -> defenders have luck<br>', $attacker->getName (), $defender->getName ()));
            return;
        }
        Logger::output(sprintf ('%s attack %s ->', $attacker->getName (), $defender->getName ()));
        if (count ($defender->getSkills ()) > 0) {
            foreach ($defender->getSkills () as $skill) {
                if ($skill instanceof InterfaceDefenseSkill) {
                    $damage += $skill->defense ($defender, $attacker, 20);
                }
            }
        }

        Logger::output(sprintf ('give %s damage, have %s hp<br>', $damage, $defender->getHealth () - $damage));
        if ($damage > 0) {
            $defender->setHealth ($defender->getHealth () - $damage);
        }

        $this->determineWhoIsAttacker ($attacker, $defender);
    }

    private function defendersHasLuck(BaseClasses $defenders)
    {
        return $defenders->getLuck() == mt_rand (1, 100);
    }

    private function determineWhoIsAttacker(BaseClasses $attacker, BaseClasses $defenders)
    {
        if ($attacker instanceof Hero) {
            $this->hero = $attacker;
        } else {
            $this->monster = $attacker;
        }

        if ($defenders instanceof Monster) {
            $this->monster = $defenders;
        } else {
            $this->hero = $defenders;
        }
    }

    private function endOfBattle()
    {
        if (($this->hero->getHealth () <= 0) || ($this->monster->getHealth () <= 0) || $this->rounds == 0) {
            return true;
        }
        return false;
    }

}