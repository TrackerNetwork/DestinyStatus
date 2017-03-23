<?php

namespace Destiny;

class CurrencyCollection extends Collection
{
    public function __construct(array $items = [])
    {
        foreach ($items as $properties) {
            $currency = new Currency($properties);
            $this->put($currency->itemHash, $currency);
        }
    }
}
