<?php
require_once __DIR__ . '/src/NameGenerator.php';

$generator = new Ob_Ivan\NethackNames\NameGenerator();
echo $generator->generate() . "\n";
