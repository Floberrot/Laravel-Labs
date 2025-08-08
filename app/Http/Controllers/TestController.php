<?php

namespace App\Http\Controllers;

use App\Service\FakeRepository;
use App\Service\TestService;

class TestController extends Controller
{
    public function __construct(
        private readonly TestService $testService,
    )
    {
    }

    public function index(FakeRepository $fakeRepository)
    {
        dd($fakeRepository->test($this->testService));
    }
}
