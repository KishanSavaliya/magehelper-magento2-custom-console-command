# MageHelper Custom Console(CLI) Command Magento 2

We will learn here, how to create new simple "Hello World" module in Magento 2 step by step.

We can create new module in `app/code/` directory, previously in Magento 1 there were three code pools which are local, community and core but that has been removed now.

In this blog post, we will see how to create a custom console(CLI) command in Magento 2 module. We will learn console command with passing arguments and without passing arguments with command. So let's start.

### Step - 1 - Create a directory for the module

- In Magento 2, module name divided into two parts i.e Vendor_Module (for e.g Magento_Theme, Magento_Catalog)
- We will create `MageHelper_ConsoleCommand` here, So `MageHelper` is vendor name and `ConsoleCommand` is name of this module.
- So first create your namespace directory (`MageHelper`) and move into that directory.
- Then create module name directory (`ConsoleCommand`)

Now Go to : `app/code/MageHelper/ConsoleCommand`

### Step - 2 - Create module.xml file to declare new module.

- Magento 2 looks for configuration information for each module in that module’s etc directory. so we need to add module.xml file here in our module `app/code/MageHelper/ConsoleCommand/etc/module.xml` and it's content for our module is :

~~~ xml
<?xml version="1.0"?>
<!--
/**
 * MageHelper Custom Console(CLI) Command Magento 2
 *
 * @package      MageHelper_ConsoleCommand
 * @author       Kishan Savaliya <kishansavaliyakb@gmail.com>
 */
-->
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:Module/etc/module.xsd">
	<module name="MageHelper_ConsoleCommand" setup_version="1.0.0" />
</config>
~~~

In this file, we register a module with name `MageHelper_ConsoleCommand` and the version is `1.0.0`.

### Step - 3 - create registration.php

- All Magento 2 module must be registered in the Magento system through the magento `ComponentRegistrar` class. This file will be placed in module's root directory.

In this step, we need to create this file:

~~~
app/code/MageHelper/ConsoleCommand/registration.php
~~~

And it’s content for our module is:

~~~ php
<?php
/**
 * MageHelper Custom Console(CLI) Command Magento 2
 *
 * @package      MageHelper_ConsoleCommand
 * @author       Kishan Savaliya <kishansavaliyakb@gmail.com>
 */
\Magento\Framework\Component\ComponentRegistrar::register(
    \Magento\Framework\Component\ComponentRegistrar::MODULE,
    'MageHelper_ConsoleCommand',
    __DIR__
);
~~~

### Step - 4 - Enable `MageHelper_ConsoleCommand` module.

- By finish above step, you have created an empty module. Now we will enable it in Magento environment.
- Before enable the module, we must check to make sure Magento has recognize our module or not by enter the following at the command line:

~~~ 
php bin/magento module:status
~~~

If you follow above step, you will see this in the result:

~~~
List of disabled modules:
MageHelper_ConsoleCommand
~~~

This means the module has recognized by the system but it is still disabled. Run this command to enable it:

~~~
php bin/magento module:enable MageHelper_ConsoleCommand
~~~

The module has enabled successfully if you saw this result:

~~~
The following modules has been enabled:
- MageHelper_ConsoleCommand
~~~

This’s the first time you enable this module so Magento require to check and upgrade module database. We need to run this command:

~~~
php bin/magento setup:upgrade
~~~

### Step - 5 - Create Command and add in Magento command list

- In this step, we will create `Console` directory into module's root directory here

~~~
app/code/MageHelper/ConsoleCommand/Console
~~~

- We will first create command without passing argument with command. So we will create this file

~~~
app/code/MageHelper/ConsoleCommand/Console/CommandWithoutParams.php
~~~

Content for this file is :

~~~ php
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
~~~

- Now we need to add this command in Magento 2 Command List, we can add that using `di.xml` file. We will create this file here.

~~~
app/code/MageHelper/ConsoleCommand/etc/di.xml
~~~

Content for this file :

~~~ xml
<?xml version="1.0"?>
<!-- 
/**
 * MageHelper Custom Console(CLI) Command Magento 2
 *
 * @package      MageHelper_ConsoleCommand
 * @author       Kishan Savaliya <kishansavaliyakb@gmail.com>
 */
 -->
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="../../../../../lib/internal/Magento/Framework/ObjectManager/etc/config.xsd">
    <type name="Magento\Framework\Console\CommandList">
        <arguments>
            <argument name="commands" xsi:type="array">
                <item name="magehelper_custom_command_without_params" xsi:type="object">MageHelper\ConsoleCommand\Console\CommandWithoutParams</item>
            </argument>
        </arguments>
    </type>
</config>
~~~

- We can print current date and time using above command.

- We can run above command in CLI like `php bin/magento magehelper:datetime`.

**Output : Command - 1**

![MageHelper Custom Console(CLI) Command Magento 2 without passing any params output](https://github.com/KishanSavaliya/magento2-custom-console-command/blob/master/MageHelper/MageHelper-CustomConsoleCommand-Without-Passing-Params-Magento2-Output.png)


- Now we will do something interesting with Console Command output. So we will create another file for new command in `Console` directory.

~~~
app/code/MageHelper/ConsoleCommand/Console/SomethingInteresting.php
~~~

Content for this file is :

~~~ php
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
~~~

- Now we need to add this command in Magento 2 Command List using `di.xml` file. So we will update that file again here.

~~~
app/code/MageHelper/ConsoleCommand/etc/di.xml
~~~

Content for this file :

~~~ xml
<?xml version="1.0"?>
<!-- 
/**
 * MageHelper Custom Console(CLI) Command Magento 2
 *
 * @package      MageHelper_ConsoleCommand
 * @author       Kishan Savaliya <kishansavaliyakb@gmail.com>
 */
 -->
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="../../../../../lib/internal/Magento/Framework/ObjectManager/etc/config.xsd">
    <type name="Magento\Framework\Console\CommandList">
        <arguments>
            <argument name="commands" xsi:type="array">
                <item name="magehelper_custom_command_without_params" xsi:type="object">MageHelper\ConsoleCommand\Console\CommandWithoutParams</item>
                <item name="magehelper_custom_command_something_interesting" xsi:type="object">MageHelper\ConsoleCommand\Console\SomethingInteresting</item>
            </argument>
        </arguments>
    </type>
</config>
~~~

- We will print this module's information using this command.

- We can run above command in CLI like `php bin/magento magehelper:dosomething:interesting`. Output of this command will return some colourful text. Let's check it.

**Output : Command - 2**

![MageHelper Custom Console(CLI) Command Magento 2 with something interesting output](https://github.com/KishanSavaliya/magento2-custom-console-command/blob/master/MageHelper/MageHelper-CustomConsoleCommand-With-Something-Interesting-Magento2-Output.png)

- Now in last, we will create our last command with passing argument with command. We will print multiplication table for user given number.

- For that we need to create another command file in `Console` directory and add that in command list using `di.xml` file.

~~~
app/code/MageHelper/ConsoleCommand/Console/CommandWithParams.php
~~~

Content for this file is :

~~~ php
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
~~~

- Now we need to add this command in Magento 2 Command List using `di.xml` file. So we will update that file again here.

~~~
app/code/MageHelper/ConsoleCommand/etc/di.xml
~~~

Content for this file :

~~~ xml
<?xml version="1.0"?>
<!-- 
/**
 * MageHelper Custom Console(CLI) Command Magento 2
 *
 * @package      MageHelper_ConsoleCommand
 * @author       Kishan Savaliya <kishansavaliyakb@gmail.com>
 */
 -->
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="../../../../../lib/internal/Magento/Framework/ObjectManager/etc/config.xsd">
    <type name="Magento\Framework\Console\CommandList">
        <arguments>
            <argument name="commands" xsi:type="array">
                <item name="magehelper_custom_command_without_params" xsi:type="object">MageHelper\ConsoleCommand\Console\CommandWithoutParams</item>
                <item name="magehelper_custom_command_something_interesting" xsi:type="object">MageHelper\ConsoleCommand\Console\SomethingInteresting</item>
                <item name="magehelper_custom_command_with_params" xsi:type="object">MageHelper\ConsoleCommand\Console\CommandWithParams</item>
            </argument>
        </arguments>
    </type>
</config>
~~~

- We will print multiplication table using user input number, if we will not pass params value then we will return how to use this command information.

- We can run above command in CLI like `php bin/magento magehelper:multiplication:table --number=25`. Output of this command will return multiplication table of 25.

**Output : Command - 3**

![MageHelper Custom Console(CLI) Command Magento 2 with passing argument output](https://github.com/KishanSavaliya/magento2-custom-console-command/blob/master/MageHelper/MageHelper-CustomConsoleCommand-With-Passing-Argument-Magento2-Output.png)



## Run Default Magento Commands with shortcuts

- While working on Magento 2.x, you need to run several console commands which are actually very handy in terms of managing the things such as cache, upgrades, deploy modes, indexers etc. You can check the entire list of commands by running below command:

~~~
php bin/magento list
~~~

- You can use shortest unambiguous name instead of full name, e.g. s instead of setup. Magento is using `Symfony\Component\Console\Command` component to implement command line features. You can learn more in the documentation of Symphony framework. We can use below shortcuts instead full commands.

#### Setup Upgrade Command :

- We can use following command instead of using `php bin/magento setup:upgrade`

~~~
php bin/magento s:up
~~~

#### Module Management Commands

- We can use following command to check module's status instead of using this full command `php bin/magento module:status MageHelper_ConsoleCommand`

~~~
php bin/magento mo:s MageHelper_ConsoleCommand
~~~

- We can use following command to enable module instead of using this full command `php bin/magento module:enable MageHelper_ConsoleCommand`

~~~
php bin/magento mo:e MageHelper_ConsoleCommand
~~~

- We can use following command to disable module instead of using this full command `php bin/magento module:disable MageHelper_ConsoleCommand`

~~~
php bin/magento mo:d MageHelper_ConsoleCommand
~~~

- We can use following command to uninstall module instead of using this full command `php bin/magento module:uninstall MageHelper_ConsoleCommand`

~~~
php bin/magento m:u MageHelper_ConsoleCommand
~~~

#### Compile Command

- We can use following command instead of using `php bin/magento setup:di:compile`

~~~
php bin/magento s:d:c
~~~

#### Static Content Deploy Command

- We can use following command instead of using `php bin/magento setup:static-content:deploy`

~~~
php bin/magento s:s:d
~~~

#### Cache Commands

- To check status of Magneto cache, we can use following command instead of using this full command `php bin/magento cache:status`

~~~
php bin/magento c:s
~~~

- To Enable all Magento cache, we can use following command instead of using this full command `php bin/magento cache:enable`

~~~
php bin/magento c:e
~~~

- To Clear Magento cache, we can use following command instead of using this full command `php bin/magento cache:clean`

~~~
php bin/magento c:c
~~~

- To Flush Magento cache, we can use following command instead of using this full command `php bin/magento cache:flush`

~~~
php bin/magento c:f
~~~

- To Disable All Magento Cache, we can use following command instead of using this full command `php bin/magento cache:disable`

~~~
php bin/magento c:d
~~~

- We can use specific cache type to clear, flush, enable or disable particular cache like configuration, page_cache then we can use following command instead of using this full command `php bin/magento cache:enable page_cache`

~~~
php bin/magento c:e page_cache
~~~

#### Indexer Commands

- We can use following command to check indexer status instead of using this full command `php bin/magento indexer:status`

~~~
php bin/magento i:sta
~~~

- We can check indexer info using following command instead of using this command `php bin/magento indexer:info`

~~~
php bin/magento i:i
~~~

- We can use following command to check mode of indexer instead of using this command `php bin/magento indexer:show-mode`

~~~
php bin/magento i:sho
~~~

- We can reset indexer status using below command instead of using this command `php bin/magento indexer:reset`

~~~
php bin/magento i:res
~~~

- We can use following command to reindex indexer instead of using this full command `php bin/magento indexer:reindex`

~~~
php bin/magento i:rei
~~~

- We can use above all indexing command with specific key to index any particular key like customer_grid, catalogsearch_fulltext then we can use `php bin/magento i:rei customer_grid` instead of `php bin/magento indexer:reindex customer_grid`

**In Short, you can use all magento commands with shortcuts. You can use your custom console command with shortcuts also.**