<?php

declare(strict_types=1);

namespace BZRK\TimeUnit;

class TimeUnits
{
    protected function __construct(public int $val)
    {
    }

    public static function seconds(): TimeUnits
    {
        return new TimeUnits(1);
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
}
