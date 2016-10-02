<?php
/**
 * Copyright (c) 2016 Bernardo van der Wal
 * MIT License
 *
 * Refer to the LICENSE file for the full copyright notice.
 */

namespace OneOfZero\Json\Mappers\Anonymous;

use OneOfZero\Json\Mappers\MapperChainInterface;
use OneOfZero\Json\Mappers\MapperInterface;

class AnonymousMapperChain implements MapperChainInterface
{
	/**
	 * @var AnonymousObjectMapper|AnonymousMemberMapper $mapper
	 */
	private $mapper;

	/**
	 * @param AnonymousObjectMapper|AnonymousMemberMapper $mapper
	 */
	public function __construct($mapper)
	{
		$this->mapper = $mapper;
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function getConfiguration()
	{
		return null;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getTarget()
	{
		return null;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getFactoryChain()
	{
		return null;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getTop($noCache = false)
	{
		return $this->mapper;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getNext(MapperInterface $caller)
	{
		return $this->mapper;
	}
}
