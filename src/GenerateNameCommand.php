<?php
namespace Ob_Ivan\NethackNames;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateNameCommand extends Command {
    const OPTION_GENDER = 'gender';

    protected function configure()
    {
        $this
            ->setName('generate-name')
            ->addOption(self::OPTION_GENDER, 'g', InputOption::VALUE_REQUIRED)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $generator = $this->getNameGenerator();
        if ($generator instanceof GenderAwareInterface) {
            $gender = $input->getOption(self::OPTION_GENDER);
            if ($gender) {
                $generator->setGender($gender);
            }
        }
        $output->writeln(ucfirst($generator->generate()));
    }

    private function getNameGenerator(): NameGeneratorInterface {
        $factories = [
            function () { return new UnutterableNameGenerator(); },
            function () { return new SlavicNameGenerator(); },
        ];
        $factory = $factories[array_rand($factories)];
        return $factory();
    }
}
