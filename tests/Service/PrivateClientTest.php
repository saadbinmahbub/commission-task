<?php


declare(strict_types=1);

namespace Acme\CommissionTask\Tests\Service;

use Acme\CommissionTask\App;
use Acme\CommissionTask\Service\ClientFactory;
use PHPUnit\Framework\TestCase;

class PrivateClientTest extends TestCase
{
    private $client;
    private $amount;
    private $depositCommissionFeeRate;

    public function setUp()
    {
        App::bind('config', require 'config.php');
        $this->client = (new ClientFactory())->getClient('private');
        $this->amount = 100.00;
        $this->depositCommissionFeeRate = App::get('config')['private']['deposit_rate'];
    }

    public function testCalculateDepositCommissionFee()
    {
        $commissionFee = $this->client->calculateDepositCommissionFee($this->amount);
        $this->assertSame(
            $this->amount * $this->depositCommissionFeeRate / 100,
            $commissionFee
        );
    }

}