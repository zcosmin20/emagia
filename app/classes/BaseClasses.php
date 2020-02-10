<?php

namespace App\Classes;
/**
 *
 * Created by PhpStorm.
 * User: Zota Cosmin
 * Date: 2/9/2020
 * Time: 6:54 PM
 */
class BaseClasses
{
    protected $skills = [];
    private $name;
    private $health;
    private $strength;
    private $defence;
    private $speed;
    private $luck;

    public function __construct($atributes = [])
    {
        foreach ($atributes as $key => $value) {
            $methodName = 'set' . ucfirst ($key);
            if (property_exists ($this, $key) && method_exists ($this, $methodName)) {
                if (is_array ($value)) {
                    $this->$methodName(mt_rand ($value[0], $value[1]));
                } else {
                    $this->$methodName($value);
                }
            }
        }
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getHealth()
    {
        return $this->health;
    }

    public function setHealth($health)
    {
        $this->health = $health;
    }

    public function getStrength()
    {
        return $this->strength;
    }

    public function setStrength($strength)
    {
        $this->strength = $strength;
    }

    public function getDefence()
    {
        return $this->defence;
    }

    public function setDefence($defence)
    {
        $this->defence = $defence;
    }

    public function getSpeed()
    {
        return $this->speed;
    }

    public function setSpeed($speed)
    {
        $this->speed = $speed;
    }

    public function getLuck()
    {
        return $this->luck;
    }

    public function setLuck($luck)
    {
        $this->luck = $luck;
    }

    public function getSkills()
    {
        return $this->skills;
    }

    public function setSkills($skills)
    {
        if (is_array ($skills)) {
            foreach ($skills as $skill) {
                $this->skills[] = $skill;
            }
        } else {
            $this->skills[] = $skills;
        }
    }


}