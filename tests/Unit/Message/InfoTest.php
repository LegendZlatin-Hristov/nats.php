<?php

declare(strict_types=1);

namespace Tests\Unit\Message;

use Basis\Nats\Message\Info;
use Tests\TestCase;

class InfoTest extends TestCase
{
    public function testKnownApiLevelDoesNotThrow()
    {
        $info = new Info(['api_lvl' => 2, 'host' => 'x']);
        $this->assertSame(2, $info->api_lvl);
        $this->assertSame('x', $info->host);
    }

    public function testUnknownPropertiesAreIgnored()
    {
        $info = new Info(['some_future_field' => 1, 'host' => 'x']);
        $this->assertSame('x', $info->host);
        $this->assertFalse(property_exists($info, 'some_future_field'));
    }
}
