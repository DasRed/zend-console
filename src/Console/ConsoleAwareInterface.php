<?php
namespace DasRed\Zend\Console;

use Zend\Console\Adapter\AdapterInterface;

interface ConsoleAwareInterface
{

	/**
	 * @return AdapterInterface
	 */
	public function getConsole();

	/**
	 *
	 * @param AdapterInterface $console
	 * @return self
	 */
	public function setConsole(AdapterInterface $console);
}