<?php
/**
 * MageHelper Custom Console(CLI) Command Magento 2
 *
 * @package      MageHelper_ConsoleCommand
 * @author       Kishan Savaliya <kishansavaliyakb@gmail.com>
 */

namespace MageHelper\ConsoleCommand\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;

class CommandWithParams extends Command
{
	const NUMBER = 'number';

	protected function configure(){
		$options = [
			new InputOption(
				self::NUMBER,
				null,
				InputOption::VALUE_REQUIRED,
				'Value'
			)
		];

		$this->setName('magehelper:multiplication:table')
			->setDescription('Console Command Example With Params (Print multiplication table).')
			->setDefinition($options);
		parent::configure();
	}

	protected function execute(InputInterface $input, OutputInterface $output){
		$number = $input->getOption(self::NUMBER);
		if(is_numeric($number)){
			$output->writeln("<comment>Multiplication Table of ".$number." is..</comment>");
			for ($i=1; $i <= 10; $i++) {
				$output->writeln("<comment>".$number." * ".$i." = <info>".($number*$i)."</info></comment>");
			}
		}else{
			$output->writeln("<comment>Please pass int number as an argument with command. Valid command is given below.</comment>");
			$output->writeln("<info>php bin/magento magehelper:multiplication:table --number=10</info>");
		}		
		return $this;
	}
}