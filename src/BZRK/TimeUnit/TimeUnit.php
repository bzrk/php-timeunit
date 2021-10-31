<?php

declare(strict_types=1);

namespace BZRK\TimeUnit;

use InvalidArgumentException;

use function sleep;

class TimeUnit
{
    private function __construct(private int $seconds)
    {
    }

    public static function now(): self
    {
        return new TimeUnit(time());
    }

    private static function create(TimeUnits $timeUnits, int $val): self
    {
        if ($val < 0) {
            throw new InvalidArgumentException("val must greater than 0");
        }
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

    public function sleep(): void
    {
        sleep($this->seconds);
    }

    public function minus(TimeUnit $timeUnit): self
    {
        return new TimeUnit($this->seconds - $timeUnit->seconds());
    }

    public function plus(TimeUnit $timeUnit): self
    {
        return new TimeUnit($this->seconds + $timeUnit->seconds());
    }
}
