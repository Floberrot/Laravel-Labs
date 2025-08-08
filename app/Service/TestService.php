<?php

namespace App\Service;

class TestService
{

    public function __construct(
        private string $testString = 'default'
    )
    {
    }

    public function getString(): string
    {
        return $this->testString;
    }

    public function setString(string $testString): self
    {
        $this->testString = $testString;

        return $this;
    }
}
