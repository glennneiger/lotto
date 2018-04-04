<?php

namespace tests;

use Lotto\Lottery;

class LotteryTaskTests extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider testLotteryPoolSizeProvider
     */
    public function testLotteryPoolSize($lo, $hi, $expect)
    {

        $lottery = new Lottery();

        $lottery->setLowestNumber($lo);
        $lottery->setHighestNumber($hi);

        $lottery->generateLotteryPool();

        $this->assertEquals($expect, count($lottery->getLotteryPool()));

    }

    public static function testLotteryPoolSizeProvider()
    {

        return[
            [1, 59, 59],
            [20, 34, 15],
            [5, 54, 50],
            [5, 65, false],
            [0, 30, false]
        ];

    }

    /**
     * @dataProvider testLotteryPoolDrawProvider
     */
    public function testLotteryDraw($pool)
    {

        $lottery = new Lottery();

        $lottery->setLotteryPool($pool);

        for($i = 0; $i < count($pool);$i++)
        {
            $lottery->drawFromLotteryPool();
            $winningPool = $lottery->getWinningPool();

            $this->assertNotContains($winningPool[$i], $lottery->getLotteryPool());
        }

    }

    public static function testLotteryPoolDrawProvider()
    {

        $testPool = [];

        for($i = 0;$i < 25; $i++)
            $testPool[] = [[mt_rand(1, 9), mt_rand(10, 19), mt_rand(20, 29), mt_rand(30, 39), mt_rand(40, 49),
                mt_rand(50, 59)]];

        return $testPool;

    }


}