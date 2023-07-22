<?php

declare(strict_types=1);

namespace OpinionBox\Helpers;

class ContainerDI
{
    /**
     * @var array
     */
    private array $dependencies = [];

    /**
     * @param string $class
     * @param callable $callback
     * @return void
     */
    public function set(string $class, callable $callback): void
    {
        $this->dependencies[$class] = $callback;
    }

    /**
     * @param string $class
     * @return mixed
     * @throws \Exception
     */
    public function get(string $class)
    {
        if (! array_key_exists($class, $this->dependencies)) {
            throw new \Exception("Class {$class} not found");
        }

        $handler = $this->dependencies[$class];

        return $handler($this);
    }
}
