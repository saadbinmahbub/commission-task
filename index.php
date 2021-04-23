<?php

require 'vendor/autoload.php';
require 'src/bootstrap.php';

if (defined('PHPUNIT_COMMISSION_TESTSUITE') && PHPUNIT_COMMISSION_TESTSUITE)
{
    return 'hello';
} else {
    echo 'hello';
}