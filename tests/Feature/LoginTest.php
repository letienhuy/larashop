<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    /**
     * A basic test example.
     * @return void
     */
    public function testExample()
    {
        $response = $this->call('POST', '/product/1/comments');
        $this->assertEquals('{}', $response->getContent());
    }
}
