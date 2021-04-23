<?php

declare(strict_types=1);

namespace Acme\CommissionTask\Tests\Service;

use Acme\CommissionTask\Service\BusinessClient;
use Acme\CommissionTask\Service\ClientFactory;
use Acme\CommissionTask\Service\PrivateClient;
use PHPUnit\Framework\TestCase;

class ClientFactoryTest extends TestCase
{
    private $clientFactory;

    public function setUp()
    {
        $this->clientFactory = new ClientFactory();
    }

    public function testFactoryReturnsBusinessClient()
    {
        $businessClient = $this->clientFactory->getClient('business');
        $this->assertInstanceOf(BusinessClient::class, $businessClient);
    }

    public function testFactoryReturnsPrivateClient()
    {
        $businessClient = $this->clientFactory->getClient('private');
        $this->assertInstanceOf(PrivateClient::class, $businessClient);
    }

}