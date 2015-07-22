<?php
namespace DasRed\Zend\Console;

use Zend\Console\Console;
use Zend\Console\ColorInterface;

class Getopt extends \Zend\Console\Getopt
{
	/**
	 * (non-PHPdoc)
	 * @see \Zend\Console\Getopt::getUsageMessage()
	 * @param string $additional
	 */
	public function getUsageMessage($additional = '')
	{
		$console = Console::getInstance();

		$usage = $console->colorize('Usage:', ColorInterface::YELLOW) . PHP_EOL;
		$usage .= ' ' . basename($this->progname, '.php') . ' [options] ' . $additional . PHP_EOL;
		$usage .= PHP_EOL;
		$usage .= $console->colorize('Options:', ColorInterface::YELLOW) . PHP_EOL;

		$maxLen = 40;
		$lines = array();
		foreach ($this->rules as $rule)
		{
			if (isset($rule['isFreeformFlag']))
			{
				continue;
			}
			$flags = array();
			if (is_array($rule['alias']))
			{
				foreach ($rule['alias'] as $flag)
				{
					if (strlen($flag) == 1)
					{
						$flags[] = '(-' . $flag . ')';
					}
					else
					{
						$flags[] = $console->colorize('--' . $flag, ColorInterface::GREEN);
					}
				}
			}

			$linepart['name'] = implode(' ', $flags);
			if (isset($rule['param']) && $rule['param'] != 'none')
			{
				$linepart['name'] .= ' ';
				switch ($rule['param'])
				{
					case 'optional':
						$linepart['name'] .= "[ <{$rule['paramType']}> ]";
						break;
					case 'required':
						$linepart['name'] .= "<{$rule['paramType']}>";
						break;
				}
			}
			if (strlen($linepart['name']) > $maxLen)
			{
				$maxLen = strlen($linepart['name']);
			}
			$linepart['help'] = '';
			if (isset($rule['help']))
			{
				$linepart['help'] .= $rule['help'];
			}
			$lines[] = $linepart;
		}

		foreach ($lines as $linepart)
		{
			$usage .= sprintf(' %s  %s' . PHP_EOL, str_pad($linepart['name'], $maxLen), $linepart['help']);
		}

		return $usage;
	}
}