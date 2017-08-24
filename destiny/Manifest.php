<?php

namespace Destiny;

use Destiny\Definitions\Manifest as ManifestDefinition;

/**
 * Class Manifest
 * @package Destiny
 */
class Manifest extends ManifestDefinition
{
    /**
     * Manifest constructor.
     * @param array|null $definition
     */
    public function __construct(array $definition = null)
    {
        parent::__construct($definition);
    }
}