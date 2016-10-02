<?php
/**
 * Copyright (c) 2016 Bernardo van der Wal
 * MIT License
 *
 * Refer to the LICENSE file for the full copyright notice.
 */

namespace OneOfZero\Json\Mappers\Contract;

use OneOfZero\Json\Mappers\AbstractObjectMapper;

class ContractObjectMapper extends AbstractObjectMapper
{
	/**
	 * @var bool|null $isExplicitInclusionEnabled
	 */
	private $isExplicitInclusionEnabled;

	/**
	 * @var bool|null $isMetadataDisabled
	 */
	private $isMetadataDisabled;

	/**
	 * @var string|null $serializingConverter
	 */
	private $serializingConverter;

	/**
	 * @var string|null $deserializingConverter
	 */
	private $deserializingConverter;

	/**
	 * @param bool|null $isExplicitInclusionEnabled
	 * @param bool|null $isMetadataDisabled
	 * @param string|null $serializingConverter
	 * @param string|null $deserializingConverter
	 */
	public function __construct(
		$isExplicitInclusionEnabled = null,
		$isMetadataDisabled = null,
		$serializingConverter = null,
		$deserializingConverter = null
	) {
		parent::__construct();
		
		$this->isExplicitInclusionEnabled = $isExplicitInclusionEnabled;
		$this->isMetadataDisabled = $isMetadataDisabled;
		$this->serializingConverter = $serializingConverter;
		$this->deserializingConverter = $deserializingConverter;
	}
	
	#region // Getters
	
	/**
	 * {@inheritdoc}
	 */
	public function isExplicitInclusionEnabled()
	{
		return ($this->isExplicitInclusionEnabled !== null)
			? $this->isExplicitInclusionEnabled 
			: parent::isExplicitInclusionEnabled()
		;
	}

	/**
	 * {@inheritdoc}
	 */
	public function isMetadataDisabled()
	{
		return ($this->isMetadataDisabled !== null) 
			? $this->isMetadataDisabled 
			: parent::isMetadataDisabled()
		;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getSerializingConverterType()
	{
		return ($this->serializingConverter !== null) 
			? $this->serializingConverter 
			: parent::getSerializingConverterType()
		;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getDeserializingConverterType()
	{
		return ($this->deserializingConverter !== null) 
			? $this->deserializingConverter 
			: parent::getDeserializingConverterType()
		;
	}

	/**
	 * {@inheritdoc}
	 */
	public function hasSerializingConverter()
	{
		return ($this->serializingConverter !== null)
			? true 
			: parent::hasSerializingConverter()
		;
	}

	/**
	 * {@inheritdoc}
	 */
	public function hasDeserializingConverter()
	{
		return ($this->deserializingConverter !== null) 
			? true
			: parent::hasDeserializingConverter()
		;
	}
	
	#endregion
	
	#region // Setters
	
	/**
	 * @param bool|null $isExplicitInclusionEnabled
	 * @return self
	 */
	public function setIsExplicitInclusionEnabled($isExplicitInclusionEnabled)
	{
		$this->isExplicitInclusionEnabled = $isExplicitInclusionEnabled;
		return $this;
	}

	/**
	 * @param bool|null $isMetadataDisabled
	 * @return self
	 */
	public function setIsMetadataDisabled($isMetadataDisabled)
	{
		$this->isMetadataDisabled = $isMetadataDisabled;
		return $this;
	}

	/**
	 * @param null|string $serializingConverter
	 * @return self
	 */
	public function setSerializingConverter($serializingConverter)
	{
		$this->serializingConverter = $serializingConverter;
		return $this;
	}

	/**
	 * @param null|string $deserializingConverter
	 * @return self
	 */
	public function setDeserializingConverter($deserializingConverter)
	{
		$this->deserializingConverter = $deserializingConverter;
		return $this;
	}
	
	#endregion
}
