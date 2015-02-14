<?php

namespace Zoddo\gitlab\webhook\EventListener;

/**
 * Interface onIssueInterface
 * @package Zoddo\gitlab\webhook
 */
interface onIssueInterface extends EventListenerInterface
{
	/**
	 * @param array $data
	 */
	public function onIssue(array $data);
}