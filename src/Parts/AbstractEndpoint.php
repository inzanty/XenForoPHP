<?php

/*
 * This file is a part of the XenForoPHP project.
 *
 * Copyright (c) 2021-present Nazar Nosko <nosko.nazar@gmail.com>
 *
 * This file is subject to the MIT license that is bundled
 * with this source code in the LICENSE.md file.
 */

namespace XenForo\Parts;

use GuzzleHttp\Client;
use XenForo\XenForo;

abstract class AbstractEndpoint
{
	/** @var string */
	protected string $apiKey;

	/** @var string */
	protected string $domain;

	/** @var int|null */
	protected ?int $userId;

	/** @var bool */
	protected bool $bypass;

	/** @var Client */
	protected Client $client;

	public function __construct()
	{
		$this->apiKey = XenForo::getApiKey();
		$this->domain = XenForo::getDomain();
		$this->userId = XenForo::getUserId();
		$this->bypass = XenForo::isBypass();
		$this->client = $this->setClient();
	}

	/**
	 * @return Client
	 */
	protected function setClient(): Client
	{
		return new Client([
			'base_uri' => $this->domain,
			'headers'  => [
				'XF-Api-Key'  => $this->apiKey,
				'XF-Api-User' => $this->userId
			]
		]);
	}
}