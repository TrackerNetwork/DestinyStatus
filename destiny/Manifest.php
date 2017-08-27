<?php

namespace Destiny;

use Destiny\Definitions\Manifest as ManifestDefinition;

/**
 * Class Manifest.
 */
class Manifest extends ManifestDefinition
{
    /**
     * Manifest constructor.
     *
     * @param array|null $definition
     */
    public function __construct(array $definition = null)
    {
        parent::__construct($definition);
    }
}
