<?php


namespace Acme\CommissionTask\Tests;


use Acme\CommissionTask\App;
use PHPUnit\Framework\TestCase;

class AppTest extends TestCase
{
    private $dummyConfig;

    public function testBindAndGetAKeyToApplication()
    {
        App::bind('config', $this->dummyConfig);
        $config = App::get('config');
        $this->assertEquals($this->dummyConfig, $config);
    }

    protected function setUp()
    {
        $this->dummyConfig = [
            'dummy_config' => 'This is a dummy configuration file'
        ];
    }
}