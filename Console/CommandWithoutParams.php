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

class CommandWithoutParams extends Command
{
	protected function configure(){
		$this->setName('magehelper:datetime')
			->setDescription('Console Command Example Without Passing Extra Params.');
		parent::configure();
	}

	protected function execute(InputInterface $input, OutputInterface $output){
		$output->writeln(date("d-m-Y H:i:s"));
		return $this;
	}
}