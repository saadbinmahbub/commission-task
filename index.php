<?php

use Carbon\Carbon;

require 'vendor/autoload.php';
require 'src/bootstrap.php';

if (defined('PHPUNIT_COMMISSION_TESTSUITE') && PHPUNIT_COMMISSION_TESTSUITE)
{
    return 'hello';
} else {
    echo Carbon::parse('2016-01-05')
        ->startOfWeek();
}