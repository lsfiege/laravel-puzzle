<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestResponse;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->addTestResponseMacros();
    }

    protected function addTestResponseMacros()
    {
        TestResponse::macro('viewData', function ($key) {
            $this->ensureResponseHasView();
            $this->assertViewHas($key);

            return $this->original->$key;
        });

        TestResponse::macro('assertViewCollection', function ($var) {
            return new TestCollectionData($this->viewData($var));
        });
    }
}
