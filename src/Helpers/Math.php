<?php

declare(strict_types=1);

namespace Acme\CommissionTask\Helpers;

class Math
{
    public static function roundUp($value, $precision = 2): float
    {
        $pow = pow(10, $precision);
        $value = (ceil($pow * $value) + ceil($pow * $value - ceil($pow * $value))) / $pow;
        return (float) number_format($value, $precision);
    }
}
