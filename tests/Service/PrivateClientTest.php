<?php


declare(strict_types=1);

namespace Acme\CommissionTask\Tests\Service;

use Acme\CommissionTask\App;
use Acme\CommissionTask\Helpers\APIExchangeRate;
use Acme\CommissionTask\Service\ClientFactory;
use Acme\CommissionTask\Service\Transaction;
use Acme\CommissionTask\Tests\Bootstrap;
use PHPUnit\Framework\TestCase;

class PrivateClientTest extends TestCase
{
    private $client;
    private $depositCommissionFeeRate;

    public function setUp()
    {
        $bootstrap = new Bootstrap();
        $bootstrap->bindConfig();
        $bootstrap->bindTransactions();
        $api = new APIExchangeRate();
        $json = '{"success":true,"timestamp":1619277243,"base":"EUR","date":"2021-04-24","rates":{"EUR":1,"JPY":130.534345,"USD":1.209715}}';
        $api->setRates(json_decode($json, true));
        App::bind('exchange_rates', $api);
        $this->client = (new ClientFactory())->getClient('private');
        $this->depositCommissionFeeRate = App::get('config')['private']['deposit_rate'];
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

    public function testCalculateWithdrawalCommissionFeeIfTransactionCountIsMoreThanTheLimit()
    {
        $commission = $this->client->calculateWithdrawalCommissionFee(
            new Transaction(['2016-03-01', 1, 'private', 'withdraw', 100.00, 'USD'], 16)
        );
        $this->assertEquals('0.3', $commission);
    }

    public function testCalculateWithdrawalCommissionFeeMoreThanMaxLimitAndMoreThanMaxAmount()
    {
        $commission = $this->client->calculateWithdrawalCommissionFee(
            new Transaction(['2016-03-01', 1, 'private', 'withdraw', 800.00, 'USD'], 17)
        );
        $this->assertEquals('2.4', $commission);
    }

    public function testCalculateWithdrawalCommissionFeeForFirstWithdrawalAmountMoreThanMaxWithdrawalAmount()
    {
        $commission = $this->client->calculateWithdrawalCommissionFee(
            new Transaction(['2014-12-31', 4, 'private', 'withdraw', 1200.00, 'EUR'], 0)
        );
        $this->assertEquals('0.6', $commission);
    }

    public function testCalculateWithdrawalCommissionFeeForFirstWithdrawalAmountMoreThanMaxWithdrawalInDifferentCurrency(
    )
    {
        $commission = $this->client->calculateWithdrawalCommissionFee(
            new Transaction(['2016-02-19', 5, 'private', 'withdraw', 3000000, 'JPY'], 12)
        );
        $this->assertEquals('8608.4', $commission);
    }

    public function testCalculateWithdrawalCommissionFeeIfClientHasPreviousTransactions()
    {
        $commission = $this->client->calculateWithdrawalCommissionFee(
            new Transaction(['2015-01-01', 4, 'private', 'withdraw', 1000.00, 'EUR'], 1)
        );
        $this->assertEquals('3', $commission);
    }

    public function testCalculateWithdrawalCommissionFeeZeroIfTransactionsAreLessThanOrEqualMaxWithdrawalAmount()
    {
        $commission = $this->client->calculateWithdrawalCommissionFee(
            new Transaction(['2016-01-05', 4, 'private', 'withdraw', 1000.00, 'EUR'], 2)
        );
        $this->assertEquals('0', $commission);
    }

    public function testCalculateWithdrawalCommissionFeeIfClientsCurrencyIsNotBaseAndDidNotExceedMaxWithdrawalAmount()
    {
        $commission = $this->client->calculateWithdrawalCommissionFee(
            new Transaction(['2016-01-06', 1, 'private', 'withdraw', 30000, 'JPY'], 5)
        );
        $this->assertEquals('0', $commission);
    }

    public function testCalculateWithdrawalCommissionFeeInAWeekInDifferentCurrencies()
    {
        $commission = $this->client->calculateWithdrawalCommissionFee(
            new Transaction(['2016-01-07', 1, 'private', 'withdraw', 100.00, 'USD'], 7)
        );
        $this->assertEquals('0.3', $commission);
    }

}