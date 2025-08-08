<?php

namespace App\Service;

class FakeRepository
{
    public function test(TestService $testService): string
    {
        return $testService->getString();
    }

}
