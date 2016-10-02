<?php
/**
 * Copyright (c) 2016 Bernardo van der Wal
 * MIT License
 *
 * Refer to the LICENSE file for the full copyright notice.
 */

namespace OneOfZero\Json\Mappers;

/**
 * Defines a mapper that maps the serialization metadata for a property or method.
 */
interface MemberMapperInterface extends MapperInterface
{
	/**
	 * Should return the name for the deserialized property or method.
	 *
	 * @return string
	 */
	public function getDeserializedName();

	/**
	 * Should return the name that will be used for the JSON property.
	 *
	 * @return string
	 */
	public function getSerializedName();

	/**
	 * Should return the type of the field as a fully qualified class name.
	 *
	 * @return string|null
	 */
	public function getType();

	/**
	 * Should return a boolean value indicating whether or not the field is included in serialization and
	 * deserialization.
	 *
	 * @return bool
	 */
	public function isIncluded();

	/**
	 * Should return a boolean value indicating whether or not the field is an array.
	 *
	 * @return bool
	 */
	public function isArray();

	/**
	 * Should return a boolean value indicating whether or not the mapped field is a getter.
	 *
	 * @return bool
	 */
	public function isGetter();

	/**
	 * Should return a boolean value indicating whether or not the mapped field is a setter.
	 *
	 * @return bool
	 */
	public function isSetter();

	/**
	 * Should return a boolean value indicating whether or not the field is a reference.
	 *
	 * @return bool
	 */
	public function isReference();

	/**
	 * Should return a boolean value indicating whether or not the field should be initialized lazily when deserialized.
	 *
	 * @return bool
	 */
	public function isReferenceLazy();

	/**
	 * Should return a boolean value indicating whether or not the field is configured to be serialized.
	 *
	 * @return bool
	 */
	public function isSerializable();

	/**
	 * Should return a boolean value indicating whether or not the field is configured to be deserialized.
	 *
	 * @return bool
	 */
	public function isDeserializable();
}
