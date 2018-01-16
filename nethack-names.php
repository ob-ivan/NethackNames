<?php
require_once __DIR__ . '/vendor/autoload.php';

$generator = new Ob_Ivan\NethackNames\NameGenerator();
echo $generator->generate() . "\n";
