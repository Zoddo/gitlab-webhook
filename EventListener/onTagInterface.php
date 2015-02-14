<?php

namespace Zoddo\gitlab\webhook\EventListener;

/**
 * Interface onTagInterface
 * @package Zoddo\gitlab\webhook
 */
interface onTagInterface extends EventListenerInterface
{
	/**
	 * @param array $data
	 */
	public function onTag(array $data);
}