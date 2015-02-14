<?php

namespace Zoddo\gitlab\webhook\Exception;

/**
 * Class BadMethodCallException
 * @package Zoddo\gitlab\webhook
 */
class BadMethodCallException extends \BadMethodCallException
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