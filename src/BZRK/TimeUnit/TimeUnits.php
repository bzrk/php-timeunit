<?php

declare(strict_types=1);

namespace BZRK\TimeUnit;

class TimeUnits
{
    private int $val;

    public function __construct(int $val)
    {
        $this->val = $val;
    }

    public static function milliSeconds(): TimeUnits
    {
        return new TimeUnits(1);
    }

    public static function seconds(): TimeUnits
    {
        return new TimeUnits(self::milliSeconds()->val * 1000);
    }

    public static function minutes(): TimeUnits
    {
        return new TimeUnits(self::seconds()->val * 60);
    }

    public static function hours(): TimeUnits
    {
        return new TimeUnits(self::minutes()->val * 60);
    }

    public static function days(): TimeUnits
    {
        return new TimeUnits(self::hours()->val * 24);
    }

    public function val(): int
    {
        return $this->val;
    }
}
