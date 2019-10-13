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