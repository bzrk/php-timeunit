<?php

declare(strict_types=1);

namespace BZRK\TimeUnit;

class TimeUnit
{
    private function __construct(private int $seconds)
    {
    }

    public static function now(): self
    {
        return new TimeUnit(time());
    }

    public static function create(TimeUnits $timeUnits, int $val): self
    {
        return new TimeUnit($val * $timeUnits->val);
    }

    public static function ofSeconds(int $val): self
    {
        return self::create(TimeUnits::seconds(), $val);
    }

    public static function ofMinutes(int $val): self
    {
        return self::create(TimeUnits::minutes(), $val);
    }

    public static function ofHours(int $val): self
    {
        return self::create(TimeUnits::hours(), $val);
    }

    public static function ofDays(int $val): self
    {
        return self::create(TimeUnits::days(), $val);
    }

    public function seconds(): int
    {
        return $this->seconds;
    }

    public function millis(): int
    {
        return $this->seconds * 1000;
    }

    public function minus(int $val, TimeUnits $timeUnits): self
    {
        return new TimeUnit($this->seconds - ($val * $timeUnits->val));
    }

    public function plus(int $val, TimeUnits $timeUnits): self
    {
        return new TimeUnit($this->seconds + ($val * $timeUnits->val));
    }
}
