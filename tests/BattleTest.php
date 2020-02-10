<?php

/**
 *
 * Created by PhpStorm.
 * User: Zota Cosmin
 * Date: 2/9/2020
 * Time: 6:52 PM
 */

namespace Hero;

use App\Battle;
use App\Classes\Hero;
use App\Classes\Monster;
use PHPUnit\Framework\TestCase;

class BattleTest extends TestCase
{
    /**
     * @dataProvider providerForWarriors
     */
    public function testCanFight($hero, $monster)
    {

        $battle = $this->getMockBuilder (Battle::class)
            ->setConstructorArgs ([$hero, $monster, 20])
            ->getMock ();

        $battle->expects ($this->once ())
            ->method ('startFight');

        $battle->startFight ();
    }

    /**
     * @dataProvider providerForWin
     */
    public function testCanWin($w1, $w2)
    {
        $battle = new Battle($w1, $w2, 20);

        $this->assertTrue ($w1->getHealth () > 0);
        $this->assertTrue ($w2->getHealth () > 0);

        $battle->startFight ();

        $this->assertThat ($w1->getHealth (), $this->logicalAnd (
            $this->isType ('int'),
            $this->greaterThan (0)
        ));

        $this->assertThat ($w2->getHealth (), $this->logicalAnd (
            $this->isType ('int'),
            $this->lessThanOrEqual (0)
        ));

    }

    /**
     * @dataProvider providerForLose
     */
    public function testCanLose($w1, $w2)
    {
        $battle = new Battle($w1, $w2, 20);

        $this->assertTrue ($w1->getHealth () > 0);
        $this->assertTrue ($w2->getHealth () > 0);

        $battle->startFight ();


        $this->assertThat ($w2->getHealth (), $this->logicalAnd (
            $this->isType ('int'),
            $this->greaterThan (0)
        ));

        $this->assertThat ($w1->getHealth (), $this->logicalAnd (
            $this->isType ('int'),
            $this->lessThanOrEqual (0)
        ));

    }


    public function providerForWin()
    {
        return [
            [
                new Hero([
                    'name' => 'Orderus',
                    'health' => [100, 100],
                    'strength' => [100, 100],
                    'speed' => [100, 100],
                    'defence' => [100, 100],
                    'luck' => [100, 100]
                ]),
                new Monster([
                    'name' => 'Beasts',
                    'health' => [60, 90],
                    'strength' => [60, 90],
                    'speed' => [40, 60],
                    'defence' => [40, 60],
                    'luck' => [25, 40]
                ])
            ],
            [
                new Hero([
                    'name' => 'Orderus',
                    'health' => [100, 100],
                    'strength' => [100, 100],
                    'speed' => [100, 100],
                    'defence' => [100, 100],
                    'luck' => [100, 100]
                ]),
                new Monster([
                    'name' => 'Beasts',
                    'health' => [60, 90],
                    'strength' => [60, 90],
                    'speed' => [40, 60],
                    'defence' => [40, 60],
                    'luck' => [25, 40]
                ])
            ],
            [
                new Hero([
                    'name' => 'Orderus',
                    'health' => [100, 100],
                    'strength' => [100, 100],
                    'speed' => [100, 100],
                    'defence' => [100, 100],
                    'luck' => [100, 100]
                ]),
                new Monster([
                    'name' => 'Beasts',
                    'health' => [60, 90],
                    'strength' => [60, 90],
                    'speed' => [40, 60],
                    'defence' => [40, 60],
                    'luck' => [25, 40]
                ])
            ]
        ];
    }


    public function providerForLose()
    {
        return [
            [
                new Hero([
                    'name' => 'Orderus',
                    'health' => [70, 100],
                    'strength' => [70, 80],
                    'speed' => [40, 50],
                    'defence' => [45, 55],
                    'luck' => [10, 30]
                ]),
                new Monster([
                    'name' => 'Beasts',
                    'health' => [100, 100],
                    'strength' => [100, 100],
                    'speed' => [100, 100],
                    'defence' => [100, 100],
                    'luck' => [100, 100]
                ])
            ],
            [
                new Hero([
                    'name' => 'Orderus',
                    'health' => [70, 100],
                    'strength' => [70, 80],
                    'speed' => [40, 50],
                    'defence' => [45, 55],
                    'luck' => [10, 30]
                ]),
                new Monster([
                    'name' => 'Beasts',
                    'health' => [100, 100],
                    'strength' => [100, 100],
                    'speed' => [100, 100],
                    'defence' => [100, 100],
                    'luck' => [100, 100]
                ])
            ],
            [
                new Hero([
                    'name' => 'Orderus',
                    'health' => [70, 100],
                    'strength' => [70, 80],
                    'speed' => [40, 50],
                    'defence' => [45, 55],
                    'luck' => [10, 30]
                ]),
                new Monster([
                    'name' => 'Beasts',
                    'health' => [100, 100],
                    'strength' => [100, 100],
                    'speed' => [100, 100],
                    'defence' => [100, 100],
                    'luck' => [100, 100]
                ])
            ],
        ];
    }

    public function providerForWarriors()
    {
        return [
            [
                new Hero(
                    [
                        'name' => 'Orderus',
                        'health' => [70, 100],
                        'strength' => [70, 80],
                        'speed' => [40, 50],
                        'defence' => [45, 55],
                        'luck' => [10, 30]
                    ]
                ),
                new Monster(
                    [
                        'name' => 'Beasts',
                        'health' => [60, 90],
                        'strength' => [60, 90],
                        'speed' => [40, 60],
                        'defence' => [40, 60],
                        'luck' => [25, 40]
                    ]
                )
            ],
            [
                new Hero(
                    [
                        'name' => 'Orderus',
                        'health' => [70, 100],
                        'strength' => [70, 80],
                        'speed' => [40, 50],
                        'defence' => [45, 55],
                        'luck' => [10, 30]
                    ]
                ),
                new Monster(
                    [
                        'name' => 'Beasts',
                        'health' => [60, 90],
                        'strength' => [60, 90],
                        'speed' => [40, 60],
                        'defence' => [40, 60],
                        'luck' => [25, 40]
                    ]
                )
            ]
        ];
    }
}
