<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $sampleArray = [
            1 => 'Java',
            2 => 'PHP',
            3 => 'Python',
            4 => 'C#',
            5 => 'Ruby'
        ];
 
        $emptyArray = [];
        $this->assertCount(5, $sampleArray);
        $this->assertNotEmpty($sampleArray);
        $this->assertEmpty($emptyArray);
        $this->assertArraySubset([1 => 'Java', 3 => 'Python'], $sampleArray);
        $this->assertArrayHasKey(3, $sampleArray);
    }
}
