<?php

declare(strict_types=1);

namespace OpinionBox\Services;

abstract class Service
{
    /**
     * @param string $field
     * @return string
     */
    public function cleanFields(string $field): string
    {
        return strip_tags(trim($field));
    }
}
