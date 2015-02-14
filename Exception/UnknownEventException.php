<?php

namespace Zoddo\gitlab\webhook\Exception;

/**
 * Class UnknownEventException
 * @package Zoddo\gitlab\webhook
 */
class UnknownEventException extends \RuntimeException
{
	/**
	 * @param string $message
	 * @param \Exception $previous
	 */
	public function __construct($message = null, \Exception $previous = null)
	{
		if (empty($message))
		{
			$message = 'Unable to trigger the event: event is unknown';
		}
		parent::__construct($message, 500, $previous);
	}
}