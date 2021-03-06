<?php
/**
 * Copyright (c) 2016 Bernardo van der Wal
 * MIT License
 *
 * Refer to the LICENSE file for the full copyright notice.
 */

namespace OneOfZero\Json\Test\FixtureClasses\Converters;

use OneOfZero\Json\Converters\AbstractMemberConverter;
use OneOfZero\Json\Nodes\MemberNode;

class GlobalMemberTypeConverter extends AbstractMemberConverter
{
	/**
	 * {@inheritdoc}
	 */
	public function serialize(MemberNode $node, $typeHint = null)
	{
		return base64_encode(serialize($node->getValue()));
	}

	/**
	 * {@inheritdoc}
	 */
	public function deserialize(MemberNode $node, $typeHint = null)
	{
		return unserialize(base64_decode($node->getSerializedValue()));
	}
}
