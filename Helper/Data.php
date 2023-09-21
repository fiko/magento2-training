<?php

declare(strict_types=1);

namespace Fiko\Training\Helper;

class Data
{
    /** @var array */
    public $data;

    /**
     * Constructor
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /**
     * This method will return what's the bypassed parameter
     *
     * @param string $name
     * @return string
     */
    public function getName($name): string
    {
        return "{$this->data['prefix']} {$name}";
    }
}
