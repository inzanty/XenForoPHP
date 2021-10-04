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

class User extends AbstractEndpoint
{
	/**
	 * @param null $page
	 *
	 * @return StreamInterface|string
	 * @throws GuzzleException
	 */
	public function getUsers($page = null)
	{
		try
		{
			$request = $this->client->get('api/users', ['query' => ['page' => $page ?? 1]]);
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
	public function createUser(array $params)
	{
		try
		{
			$request = $this->client->post('api/users', ['form_params' => $params]);
			return $request->getBody();
		}
		catch (RequestException $e)
		{
			return $e->getResponse()->getBody()->getContents();
		}
	}

	/**
	 * @param string $email
	 *
	 * @return StreamInterface|string
	 * @throws GuzzleException
	 */
	public function findUserByEmail(string $email)
	{
		try
		{
			$request = $this->client->get('api/users/find-email', ['query' => ['email' => $email]]);
			return $request->getBody();
		}
		catch (RequestException $e)
		{
			return $e->getResponse()->getBody()->getContents();
		}
	}

	/**
	 * @param string $username
	 *
	 * @return StreamInterface|string
	 * @throws GuzzleException
	 */
	public function findUserByName(string $username)
	{
		try
		{
			$request = $this->client->get('api/users/find-name', ['query' => ['username' => $username]]);
			return $request->getBody();
		}
		catch (RequestException $e)
		{
			return $e->getResponse()->getBody()->getContents();
		}
	}

	/**
	 * @param int   $userId
	 * @param array $params
	 *
	 * @return StreamInterface|string
	 * @throws GuzzleException
	 */
	public function updateUserById(int $userId, array $params)
	{
		try
		{
			$request = $this->client->post('api/users/' . $userId, ['form_params' => $params]);
			return $request->getBody();
		}
		catch (RequestException $e)
		{
			return $e->getResponse()->getBody()->getContents();
		}
	}

	/**
	 * @param int    $userId
	 * @param string $renameTo
	 *
	 * @return StreamInterface|string
	 * @throws GuzzleException
	 */
	public function deleteUserById(int $userId, string $renameTo = '')
	{
		try
		{
			$request = $this->client->delete('api/users/' . $userId, ['form_params' => ['rename_to' => $renameTo]]);
			return $request->getBody();
		}
		catch (RequestException $e)
		{
			return $e->getResponse()->getBody()->getContents();
		}
	}

	/**
	 * @param int    $userId
	 * @param string $filePath
	 *
	 * @return StreamInterface|string
	 * @throws GuzzleException
	 */
	public function updateUserAvatarById(int $userId, string $filePath)
	{
		try
		{
			$request = $this->client->post('api/users/' . $userId . '/avatar', [
				'multipart' => [
					[
						'name'     => 'avatar',
						'contents' => fopen($filePath, 'r'),
					],
				],
			]);
			return $request->getBody();
		}
		catch (RequestException $e)
		{
			return $e->getResponse()->getBody()->getContents();
		}
	}

	/**
	 * @param int $userId
	 *
	 * @return StreamInterface|string
	 * @throws GuzzleException
	 */
	public function deleteUserAvatarById(int $userId)
	{
		try
		{
			$request = $this->client->delete('api/users/' . $userId . '/avatar');
			return $request->getBody();
		}
		catch (RequestException $e)
		{
			return $e->getResponse()->getBody()->getContents();
		}
	}

	/**
	 * @param int  $userId
	 * @param null $page
	 *
	 * @return StreamInterface|string
	 * @throws GuzzleException
	 */
	public function getUserProfilePostsById(int $userId, $page = null)
	{
		try
		{
			$request = $this->client->get('api/users/' . $userId . '/profile-posts', ['query' => ['page' => $page ?? 1]]);
			echo $request->getBody();
		}
		catch (RequestException $e)
		{
			echo $e->getResponse()->getBody()->getContents();
		}
	}
}