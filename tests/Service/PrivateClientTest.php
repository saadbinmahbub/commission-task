<?php


declare(strict_types=1);

namespace Acme\CommissionTask\Tests\Service;

use Acme\CommissionTask\App;
use Acme\CommissionTask\Service\ClientFactory;
use Acme\CommissionTask\Service\Transaction;
use PHPUnit\Framework\TestCase;

class PrivateClientTest extends TestCase
{
    private $client;
    private $depositCommissionFeeRate;

    public function setUp()
    {
        App::bind('config', require './src/config.php');
        $this->client = (new ClientFactory())->getClient('private');
        $this->depositCommissionFeeRate = App::get('config')['private']['deposit_rate'];
    }

    public function testCalculateDepositCommissionFee()
    {
        $transaction = new Transaction(['2014-12-31', 4, 'private', 'deposit', 1200.00, 'EUR']);
        $commissionFee = $this->client->calculateDepositCommissionFee($transaction);
        $this->assertSame(
            $transaction->getAmount() * $this->depositCommissionFeeRate / 100,
            $commissionFee
        );
    }

}