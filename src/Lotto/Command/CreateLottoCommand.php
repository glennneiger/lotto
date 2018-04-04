<?php

namespace Lotto\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

use Lotto\Lottery;

class CreateLottoCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('lotto:numbers')
            ->setDescription('Generate lottery numbers.')
            ->addArgument('lowNumb', InputArgument::REQUIRED, 'low number')
            ->addArgument('highNumb', InputArgument::REQUIRED, 'high number')
            ->addArgument('initialShuffle', InputArgument::REQUIRED, 'initial shuffle')
            ->addArgument('shuffle', InputArgument::REQUIRED, 'default shuffle');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(['Generating lottery numbers...', '']);

        $lowNumb = $input->getArgument('lowNumb');
        $highNumb = $input->getArgument('highNumb');
        $initialShuffle = $input->getArgument('initialShuffle');
        $shuffle = $input->getArgument('shuffle');

        $lottery = new Lottery();

        $lottery->setLowestNumber($lowNumb);
        $lottery->setHighestNumber($highNumb);

        $lottery->generateLotteryPool();

        $lottery->setShuffleElements($lottery->getLotteryPool());

        //Initial shuffle with first number retrieval
        $lottery->setShuffleTime($initialShuffle);
        $lottery->shuffleOverTime();
        $lottery->drawFromLotteryPool();

        //get remaining 5 lotto numbers
        $lottery->setShuffleTime($shuffle);

        for($i = 0; $i <= 4;$i++)
        {
            $lottery->shuffleOverTime();
            $lottery->drawFromLotteryPool();
        }

        $winningNumbers = $lottery->getWinningPool();

        $output->writeln(implode(',',$winningNumbers));

    }
}