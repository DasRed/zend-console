<?php
namespace DasRed\Zend\Console;

use Zend\Console\Adapter\AdapterInterface;
use Zend\Console\Console;

trait ConsoleAwareTrait
{

	/**
	 *
	 * @var AdapterInterface
	 */
	protected $console;

	/**
	 * @return AdapterInterface
	 */
	public function getConsole()
	{
		if ($this->console === null)
		{
			$this->console = Console::getInstance();
		}

		return $this->console;
	}

	/**
	 *
	 * @param AdapterInterface $console
	 * @return self
	 */
	public function setConsole(AdapterInterface $console)
	{
		$this->console = $console;

		return $this;
	}
}