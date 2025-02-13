<?php

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    #[CoversNothing]
    public function testExample()
    {
        $this->assertTrue(true);
    }
}
