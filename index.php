<?php

use Acme\CommissionTask\Main;

require 'vendor/autoload.php';
require 'src/bootstrap.php';
$commissions = (new Main())->main();
if (defined('PHPUNIT_COMMISSION_TESTSUITE') && PHPUNIT_COMMISSION_TESTSUITE) {
    return $commissions;
} else {
    foreach ($commissions as $commission) {
        echo $commission . "\n";
    }
}