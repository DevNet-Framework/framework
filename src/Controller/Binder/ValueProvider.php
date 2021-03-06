<?php

/**
 * @author      Mohammed Moussaoui
 * @copyright   Copyright (c) Mohammed Moussaoui. All rights reserved.
 * @license     MIT License. For full license information see LICENSE file in the project root.
 * @link        https://github.com/DevNet-Framework
 */

namespace DevNet\Core\Controller\Binder;

/**
 * Describes the interface of a container that exposes methods to read its entries.
 */
class ValueProvider implements IValueProvider
{
    protected $Values = [];

    public function __construct(array $values = [])
    {
        $this->Values = $values;
    }

    /**
     * @return mixed Finds an entry of the container by its identifier and returns it.
     */
    public function getValue(string $key)
    {
        if (isset($this->Values[$key])) {
            return $this->Values[$key];
        }

        throw new \Exception("No entry was found");
    }

    /**
     * Check if the container can return an entry for the given identifier.
     * Returns true, otherwise Returns false.
     */
    public function contains(string $key): bool
    {
        return isset($this->Values[$key]);
    }
}
