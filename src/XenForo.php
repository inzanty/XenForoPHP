<?php

/*
 * This file is a part of the XenForoPHP project.
 *
 * Copyright (c) 2021-present Nazar Nosko <nosko.nazar@gmail.com>
 *
 * This file is subject to the MIT license that is bundled
 * with this source code in the LICENSE.md file.
 */

namespace XenForo;

use LogicException;
use XenForo\Parts\Auth;
use XenForo\Parts\Index;
use XenForo\Parts\User;

class XenForo
{
	/** @var string */
	protected static string $apiKey;

	/** @var string */
	protected static string $domain;

	/** @var int|null */
	protected static ?int $userId;

	/** @var bool */
	protected static bool $bypass;

	/**
	 * @param string   $apiKey
	 * @param string   $domain
	 * @param int|null $userId
	 * @param bool     $bypass
	 */
	public function __construct(string $apiKey, string $domain, ?int $userId = null, bool $bypass = false)
	{
		if (empty($apiKey) && empty($domain))
		{
			throw new LogicException("API key and domain provided in argument was empty");
		}

		if (!parse_url($domain, PHP_URL_SCHEME))
		{
			$domain = sprintf("http://%s", $domain);
		}

		self::$apiKey = $apiKey;
		self::$domain = $domain;
		self::$userId = $userId;
		self::$bypass = $bypass;
	}

	/**
	 * @return string
	 */
	public static function getApiKey(): string
	{
		return self::$apiKey;
	}

	/**
	 * @return string
	 */
	public static function getDomain(): string
	{
		return self::$domain;
	}

	/**
	 * @return int|null
	 */
	public static function getUserId()
	{
		return self::$userId;
	}

	/**
	 * @return bool
	 */
	public static function isBypass(): bool
	{
		return self::$bypass;
	}

	/**
	 * @return Auth
	 */
	public function auth(): Auth
	{
		return new Auth();
	}

	/**
	 * @return Index
	 */
	public function index(): Index
	{
		return new Index();
	}

	/**
	 * @return User
	 */
	public function user(): User
	{
		return new User();
	}
}