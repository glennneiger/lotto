#!/usr/bin/env php
<?php

    require('vendor/autoload.php');

    use Symfony\Component\Console\Application;

    $application = new Application();

    $application->add(new \Lotto\Command\CreateLottoCommand());

    $application->run();
