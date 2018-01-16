<?php
require_once __DIR__ . '/vendor/autoload.php';

use Ob_Ivan\NethackNames\GenerateNameCommand;
use Symfony\Component\Console\Application;

$command = new GenerateNameCommand();
$application = new Application();
$application->add($command);
$application->setDefaultCommand($command->getName(), true);
$application->run();
