<?php


declare(strict_types=1);

namespace Acme\CommissionTask\Tests\Service;

use Acme\CommissionTask\App;
use Acme\CommissionTask\Service\ClientFactory;
use Acme\CommissionTask\Service\Transaction;
use PHPUnit\Framework\TestCase;

class BusinessClientTest extends TestCase
{
    private $client;
    private $depositCommissionFeeRate;
    private $withdrawalCommissionFeeRate;

    public function setUp()
    {
        App::bind('config', require './src/config.php');
        $this->client = (new ClientFactory())->getClient('business');
        $this->depositCommissionFeeRate = App::get('config')['business']['deposit_rate'];
        $this->withdrawalCommissionFeeRate = App::get('config')['business']['withdrawal_rate'];
    }

    public function testCalculateDepositCommissionFee()
    {
        $transaction = new Transaction(['2014-12-31', 4, 'private', 'deposit', 1200.00, 'EUR'], 0);
        $commissionFee = $this->client->calculateDepositCommissionFee($transaction);
        $this->assertSame(
            $transaction->getAmount() * $this->depositCommissionFeeRate / 100,
            $commissionFee
        );
    }

    public function testCalculateWithdrawalCommissionFee()
    {
        $transaction = new Transaction(['2014-12-31', 4, 'private', 'withdrawal', 1200.00, 'EUR'], 0);
        $commissionFee = $this->client->calculateWithdrawalCommissionFee($transaction);
        $this->assertSame(
            $transaction->getAmount() * $this->withdrawalCommissionFeeRate / 100,
            $commissionFee
        );
    }

}