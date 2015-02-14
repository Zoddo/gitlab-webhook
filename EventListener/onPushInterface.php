<?php

namespace Zoddo\gitlab\webhook\EventListener;

/**
 * Interface onPushInterface
 * @package Zoddo\gitlab\webhook
 */
interface onPushInterface extends EventListenerInterface
{
	/**
	 * @param array $data
	 */
	public function onPush(array $data);
}