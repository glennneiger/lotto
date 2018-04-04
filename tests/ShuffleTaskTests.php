<?php

namespace tests;

use Lotto\Shuffle;

class ShuffleTaskTests extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider testDurationProvider
     */
    public function testShuffleDuration($seconds, $expect)
    {

        $shuffle = new Shuffle();

        $shuffle->setShuffleTime($seconds);
        $shuffle->setShuffleElements([5, 10, 15, 20, 25, 30]);

        //change to microtime if more precision needed
        $start = time();
        $shuffle->shuffleOverTime();
        $end = time();

        $this->assertEquals($expect, $end - $start);

    }

    public static function testDurationProvider()
    {

        return[
            [1, 1],
            [2, 2],
            ['3', 3],
            ['test', false]
        ];

    }

    /**
     * @dataProvider testShuffleElementsProvider
     */
    public function testShuffleElements($elements)
    {

        $shuffle = new Shuffle();

        $shuffle->setShuffleElements($elements);
        $shuffle->shuffleElements();
        $shuffledElements = $shuffle->getShuffleElements();

        $this->assertNotEquals($elements, $shuffledElements);

    }

    public static function testShuffleElementsProvider()
    {

        $testElements = [];

        for($i = 0;$i < 10; $i++)
            $testElements[] = [[mt_rand(1, 9), mt_rand(10, 19), mt_rand(20, 29), mt_rand(30, 39), mt_rand(40, 49),
                mt_rand(50, 59)]];

        return $testElements;

    }

}