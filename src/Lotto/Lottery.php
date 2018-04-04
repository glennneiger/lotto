<?php

namespace Lotto;

class Lottery extends Shuffle {

    protected $lowestNumber;
    protected $highestNumber;
    protected $lotteryPool = [];
    protected $winningPool = [];

    public function setLowestNumber($number)
    {

        $this->lowestNumber = (int)$number;

        return $this;

    }

    public function setHighestNumber($number)
    {

        $this->highestNumber = (int)$number;

        return $this;

    }

    public function setLotteryPool($pool)
    {

        $this->lotteryPool = $pool;

        return $this;

    }

    public function getLotteryPool()
    {

        return $this->lotteryPool;

    }

    public function getWinningPool()
    {

        return $this->winningPool;

    }

    /**
     * Generate number pool from integers provided or false when passed invalid data
     *
     * @return $this|bool
     */
    public function generateLotteryPool()
    {

        if($this->lowestNumber < 1 || $this->highestNumber > 59)
            return false;

        for($i = $this->lowestNumber;$i <= $this->highestNumber;$i++)
        {

            $this->lotteryPool[] = $i;

        }

        return $this;

    }

    /**
     * random entry picked from the pool and added to winning pool
     * entry then removed from std pool to stop dupes
     *
     * @return $this
     */
    public function drawFromLotteryPool()
    {

        //selected a random number from the pool by its key
        $selectedKey = array_rand($this->lotteryPool);

        $this->winningPool[] = $this->lotteryPool[$selectedKey];

        //remove so it cannot be reselected
        unset($this->lotteryPool[$selectedKey]);

        return $this;

    }

}