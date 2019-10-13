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

class SomethingInteresting extends Command
{
	protected function configure(){
		$this->setName('magehelper:dosomething:interesting')
			->setDescription('Console Command Example With Something Interesting.');
		parent::configure();
	}

	protected function execute(InputInterface $input, OutputInterface $output){
		$output->writeln("<info>Vendor name </info>  : <comment> MageHelper </comment>");
		$output->writeln("<info>Module name </info>  : <comment> ConsoleCommand </comment>");
		$output->writeln("<info>Package name </info> : <comment> MageHelper_ConsoleCommand </comment>");
		$output->writeln("<info>Author name </info>  : <comment> Kishan Savaliya </comment>");
		$output->writeln("<info>Author email </info> : <comment> kishansavaliyakb@gmail.com </comment>");
		$output->writeln("<info>Contact </info>      : <comment> +91 8401270422 </comment>");
		return $this;
	}
}