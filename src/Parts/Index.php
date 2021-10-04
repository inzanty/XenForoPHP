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

class Index extends AbstractEndpoint
{
	/**
	 * @return StreamInterface|string
	 * @throws GuzzleException
	 */
	public function getIndex()
	{
		try
		{
			$request = $this->client->get('api/index');
			return $request->getBody();
		}
		catch (RequestException $e)
		{
			return $e->getResponse()->getBody()->getContents();
		}
	}
}