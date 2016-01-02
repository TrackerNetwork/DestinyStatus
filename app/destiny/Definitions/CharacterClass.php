<?php namespace Destiny\Definitions;

/**
 * @property string $classHash
 * @property string $className
 * @property string $classNameMale
 * @property string $classNameFemale
 * @property string $classIdentifier
 * @property string $mentorVendorIdentifier
 */
class CharacterClass extends Definition
{
	protected function gClassHash($value)
	{
		return (string) $value;
	}
}
