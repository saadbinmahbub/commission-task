<?php

declare(strict_types=1);

namespace Acme\CommissionTask\Tests\Service;

use Acme\CommissionTask\App;
use Acme\CommissionTask\Helpers\APIExchangeRate;
use Acme\CommissionTask\Service\BusinessClient;
use Acme\CommissionTask\Service\ClientFactory;
use Acme\CommissionTask\Service\PrivateClient;
use Exception;
use PHPUnit\Framework\TestCase;

class ClientFactoryTest extends TestCase
{
    private $clientFactory;

    public function setUp()
    {
        $this->clientFactory = new ClientFactory();
        $api = new APIExchangeRate();
        $json = '{"success":true,"timestamp":1619277243,"base":"EUR","date":"2021-04-24","rates":{"EUR":1,"JPY":130.534345,"USD":1.209715}}';
        $api->setRates(json_decode($json, true));
        App::bind('exchange_rates', $api);
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

    public function testFactoryThrowsErrorIfUnavailableClientTypeIsRequested()
    {
        $this->expectException(Exception::class);
        $this->clientFactory->getClient('ClientTypeNotFound');
    }

}