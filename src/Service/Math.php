<?php

declare(strict_types=1);

namespace Acme\CommissionTask\Service;

class Math
{
    public static function roundUp($value, $precision): string
    {
        $pow = pow(10, $precision);
        $value = (ceil($pow * $value) + ceil($pow * $value - ceil($pow * $value))) / $pow;
        return number_format($value, 2);
    }
}
