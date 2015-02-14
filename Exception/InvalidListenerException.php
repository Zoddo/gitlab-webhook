<?php

namespace Zoddo\gitlab\webhook\Exception;

/**
 * Class InvalidListenerException
 * @package Zoddo\gitlab\webhook
 */
class InvalidListenerException extends InvalidArgumentException
{
	/**
	 * @param string $message
	 * @param \Exception $previous
	 */
	public function __construct($message = null, \Exception $previous = null)
	{
		if (empty($message))
		{
			$message = 'Listeners must implements EventListenerInterface';
		}
		parent::__construct($message, $previous);
	}
}