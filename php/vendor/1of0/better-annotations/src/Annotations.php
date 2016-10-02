<?php

/**
 * Copyright (c) 2015 Bernardo van der Wal
 * MIT License
 *
 * Refer to the LICENSE file for the full copyright notice.
 */

namespace OneOfZero\BetterAnnotations;

use Doctrine\Common\Annotations\Annotation;
use Doctrine\Common\Annotations\Reader;
use Interop\Container\ContainerInterface;
use InvalidArgumentException;
use ReflectionClass;
use ReflectionMethod;
use ReflectionProperty;
use Reflector;

/**
 * Class Annotations
 *
 * Provides less verbose API around the Doctrine Annotations library.
 *
 * @package OneOfZero\BetterAnnotations
 */
class Annotations
{
	/**
	 * @var Reader $annotationReader
	 */
	private $annotationReader;

	/**
	 * @var ContainerInterface $container
	 */
	private $container;

	/**
	 * Initializes an instance of the Annotations class providing an AnnotationReader instance, and optionally providing
	 * a container instance.
	 *
	 * If the container is provided, container keys may be used as a source with the get() and has() methods.
	 *
	 * @param Reader $annotationReader
	 * @param ContainerInterface $container
	 */
	public function __construct(Reader $annotationReader, ContainerInterface $container = null)
	{
		$this->annotationReader = $annotationReader;
		$this->container = $container;
	}

	/**
	 * If the annotation name is provided, this method returns the annotation with that name from the provided source
	 * (or null if the annotation does not exist for the given source). If no name is specified, all annotations from
	 * the provided source are returned.
	 *
	 * This method will return class annotations if the provided source is a string with a fully qualified class name,
	 * or if the source is an object that is not an instance of ReflectionMethod or ReflectionProperty.
	 *
	 * If the provided source is an array, it will be interpreted as a pointer to a method or property, where the first
	 * array item is a fully qualified class name, instance, or a container key, and the second array item is the name
	 * of the method or property.
	 *
	 * If an annotation name is provided and the parameter multiple is set to true, this method will return all the
	 * annotations found with the provided name on the provided source.
	 *
	 * @param ReflectionClass|ReflectionMethod|ReflectionProperty|object|array|callable|string $source
	 * @param string|null $annotationName
	 * @param bool $multiple
	 *
	 * @return Annotation|Annotation[]|object|object[]|null|array
	 */
	public function get($source, $annotationName = null, $multiple = false)
	{
		if (is_string($source))
		{
			if (class_exists($source))
			{
				// Source is a fully qualified class name
				$source = new ReflectionClass($source);
			}
			elseif ($this->container && $this->container->has($source))
			{
				// Source is a container key
				$source = $this->container->get($source);
			}
		}

		if (is_array($source))
		{
			// If the source is an array, it is interpreted as a pointer to a method or property

			if (is_array($source[0]))
			{
				throw new InvalidArgumentException('Invalid callable provided as $source');
			}

			if (is_string($source[0]) && !class_exists($source[0]))
			{
				if ($this->container && $this->container->has($source[0]))
				{
					// $source[0] is a container key
					$source[0] = get_class($this->container->get($source[0]));
				}
				else
				{
					throw new InvalidArgumentException('Cannot resolve the callable provided as $source');
				}
			}

			if (method_exists($source[0], $source[1]))
			{
				$source = new ReflectionMethod($source[0], $source[1]);
			}
			elseif (property_exists($source[0], $source[1]))
			{
				$source = new ReflectionProperty($source[0], $source[1]);
			}
		}

		if (is_object($source))
		{
			if (!($source instanceof Reflector))
			{
				$source = new ReflectionClass($source);
			}

			if (!$annotationName)
			{
				return $this->getAnnotations($source);
			}

			return $multiple
				? $this->getAnnotations($source, $annotationName)
				: $this->getAnnotation($source, $annotationName)
			;
		}

		throw new InvalidArgumentException('Cannot resolve the reference provided as $source');
	}

	/**
	 * If the annotation name is provided, this method returns whether or not the provided source has an annotation with
	 * that name. If no name is specified, this method returns whether the provided source has any annotations at all.
	 *
	 * @see Annotations::get() for details on the source parameter.
	 *
	 * @param ReflectionClass|ReflectionMethod|ReflectionProperty|object|array|callable|string $source
	 * @param string|null $annotationName
	 *
	 * @return bool
	 *
	 * @throws InvalidArgumentException Thrown if the source is invalid.
	 */
	public function has($source, $annotationName = null)
	{
		if ($annotationName !== null)
		{
			return $this->get($source, $annotationName) !== null;
		}
		else
		{
			return count($this->get($source, $annotationName)) > 0;
		}
	}

	/**
	 * Returns an annotation using the provided reflector and annotation name.
	 *
	 * @param ReflectionClass|ReflectionMethod|ReflectionProperty $reflector
	 * @param string $annotationName
	 *
	 * @return Annotation|object|null
	 */
	private function getAnnotation($reflector, $annotationName)
	{
		if ($reflector instanceof ReflectionClass)
		{
			return $this->annotationReader->getClassAnnotation($reflector, $annotationName);
		}
		elseif ($reflector instanceof ReflectionMethod)
		{
			return $this->annotationReader->getMethodAnnotation($reflector, $annotationName);
		}
		elseif ($reflector instanceof ReflectionProperty)
		{
			return $this->annotationReader->getPropertyAnnotation($reflector, $annotationName);
		}

		return null;
	}

	/**
	 * Returns all relevant annotations using the provided reflector and optionally provided annotation name.
	 *
	 * @param ReflectionClass|ReflectionMethod|ReflectionProperty $reflector
	 * @param string|null $annotationName
	 *
	 * @return Annotation[]|object[]|array
	 */
	private function getAnnotations($reflector, $annotationName = null)
	{
		$results = [];

		if ($reflector instanceof ReflectionClass)
		{
			$results = $this->annotationReader->getClassAnnotations($reflector);
		}
		elseif ($reflector instanceof ReflectionMethod)
		{
			$results = $this->annotationReader->getMethodAnnotations($reflector);
		}
		elseif ($reflector instanceof ReflectionProperty)
		{
			$results = $this->annotationReader->getPropertyAnnotations($reflector);
		}

		if ($annotationName !== null)
		{
			$results = array_filter($results, function($item) use ($annotationName) {
				return get_class($item) === $annotationName
				||     in_array($annotationName, class_parents($item));
			});
		}

		return $results;
	}
}