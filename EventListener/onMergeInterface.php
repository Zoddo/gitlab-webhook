<?php

namespace Zoddo\gitlab\webhook\EventListener;

/**
 * Interface onMergeInterface
 * @package Zoddo\gitlab\webhook
 */
interface onMergeInterface extends EventListenerInterface
{
	/**
	 * @param array $data
	 */
	public function onMerge(array $data);
}