<?php

namespace Lotto;

class Shuffle {

    protected $shuffleTime;
    protected $shuffleElements;

    public function setShuffleTime($time)
    {
        $this->shuffleTime = (int)$time;

        return $this;
    }

    public function setShuffleElements($elements)
    {
        $this->shuffleElements = $elements;

        return $this;
    }

    public function getShuffleElements()
    {

        return $this->shuffleElements;

    }

    public function shuffleElements()
    {

        return shuffle($this->shuffleElements);

    }

    /**
     * Shuffle passed array for amount of seconds passed
     * if non numeric time length passed value is 0 so return false
     *
     * @return $this|bool
     */
    public function shuffleOverTime()
    {

        if($this->shuffleTime === 0)
            return false;

        $now = time();

        while(time() < ($now + $this->shuffleTime));
        {
            $this->shuffleElements();
        }

        return $this;

    }

}