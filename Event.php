<?php

namespace Zoddo\gitlab\webhook;

use Zoddo\gitlab\webhook\EventListener\EventListenerInterface;
use Zoddo\gitlab\webhook\EventListener\onIssueInterface;
use Zoddo\gitlab\webhook\EventListener\onMergeInterface;
use Zoddo\gitlab\webhook\EventListener\onPushInterface;
use Zoddo\gitlab\webhook\EventListener\onTagInterface;
use Zoddo\gitlab\webhook\Exception\InvalidListenerException;
use Zoddo\gitlab\webhook\Exception\UnknownEventException;

/**
 * Class Event
 * @package Zoddo\gitlab\webhook
 */
class Event
{
	const PUSH = 1;
	const TAG = 2;
	const ISSUE = 3;
	const MERGE = 4;

	/**
	 * @var array
	 */
	protected $json = array();

	/**
	 * @var array
	 */
	protected $listeners = array();

	/**
	 * @param array $json
	 */
	public function __construct($json)
	{
		if (!is_array($json))
		{
			$json = json_decode($json);
		}

		$this->json = $json;
	}

	/**
	 * @param EventListenerInterface $listener
	 * @return $this
	 */
	public function addEventListener($listener)
	{
		if (is_array($listener))
		{
			foreach ($listener as $object)
			{
				$this->addEventListener($object);
			}

			return $this;
		}

		if ($listener instanceof EventListenerInterface)
		{
			$this->listeners[] = $listener;
		}
		else
		{
			throw new InvalidListenerException;
		}

		return $this;
	}

	/**
	 * @return $this
	 */
	public function execEvent()
	{
		switch ($this->gettype())
		{
			case EVENT::PUSH:
				foreach ($this->listeners as $listener)
				{
					if ($listener instanceof onPushInterface)
					{
						$listener->onPush($this->json);
					}
				}
				break;

			case EVENT::TAG:
				foreach ($this->listeners as $listener)
				{
					if ($listener instanceof onTagInterface)
					{
						$listener->onTag($this->json);
					}
				}
				break;

			case EVENT::ISSUE:
				foreach ($this->listeners as $listener)
				{
					if ($listener instanceof onIssueInterface)
					{
						$listener->onIssue($this->json);
					}
				}
				break;

			case EVENT::MERGE:
				foreach ($this->listeners as $listener)
				{
					if ($listener instanceof onMergeInterface)
					{
						$listener->onMerge($this->json);
					}
				}
				break;

			default:
				throw new UnknownEventException;
		}

		return $this;
	}

	/**
	 * @param array $json
	 * @return int|null
	 */
	public function gettype(array $json = null)
	{
		if (empty($json))
		{
			$json = $this->json;
		}

		if (array_key_exists('ref', $json))
		{
			if (strpos($json['ref'], 'refs/heads') === 0)
			{
				return EVENT::PUSH;
			}
			elseif (strpos($json['ref'], 'refs/tags') === 0)
			{
				return EVENT::TAG;
			}
		}
		elseif (array_key_exists('object_kind', $json))
		{
			if ($json['object_kind'] == 'issue')
			{
				return EVENT::ISSUE;
			}
			elseif ($json['object_kind'] == 'merge_request')
			{
				return EVENT::MERGE;
			}
		}

		return null;
	}
}