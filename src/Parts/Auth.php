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

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\StreamInterface;

class Auth extends AbstractEndpoint
{
	/**
	 * @param string $login
	 * @param string $password
	 * @param string $limitIp
	 *
	 * @return StreamInterface|string
	 * @throws GuzzleException
	 */
	public function auth(string $login, string $password, string $limitIp = '')
	{
		try
		{
			$request = $this->client->post('api/auth', [
				'form_params' => [
					'login' => $login,
					'password' => $password,
					'limit_ip' => $limitIp
				]
			]);
			return $request->getBody();
		}
		catch (RequestException $e)
		{
			return $e->getResponse()->getBody()->getContents();
		}
	}

	/**
	 * @param string $sessionId
	 * @param string $rememberCookie
	 *
	 * @return StreamInterface|string
	 * @throws GuzzleException
	 */
	public function authFromSession(string $sessionId = '', string $rememberCookie = '')
	{
		try
		{
			$request = $this->client->post('api/auth/from-session', [
				'form_params' => [
					'session_id' => $sessionId,
					'remember_cookie' => $rememberCookie
				]
			]);
			return $request->getBody();
		}
		catch (RequestException $e)
		{
			return $e->getResponse()->getBody()->getContents();
		}
	}

	/**
	 * @param array $params
	 *
	 * @return StreamInterface|string
	 * @throws GuzzleException
	 */
	public function authLoginToken(array $params)
	{
		try
		{
			$request = $this->client->post('api/auth/login-token', ['form_params' => $params]);
			return $request->getBody();
		}
		catch (RequestException $e)
		{
			return $e->getResponse()->getBody()->getContents();
		}
	}
}