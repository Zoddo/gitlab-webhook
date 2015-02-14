<?php

namespace Zoddo\gitlab\webhook\Exception;

/**
 * Class InvalidArgumentException
 * @package Zoddo\gitlab\webhook
 */
class InvalidArgumentException extends \InvalidArgumentException
{
	/**
	 * @param string $message
	 * @param \Exception $previous
	 */
	public function __construct($message, \Exception $previous = null)
	{
		parent::__construct($message, 500, $previous);
	}
}