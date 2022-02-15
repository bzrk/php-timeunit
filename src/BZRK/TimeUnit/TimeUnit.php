<?php

declare(strict_types=1);

namespace BZRK\TimeUnit;

use InvalidArgumentException;

use function sleep;

class TimeUnit
{
    private int $milliSeconds;

    public function __construct(int $milliSeconds)
    {
        $this->milliSeconds = $milliSeconds;
    }

    public static function now(): self
    {
        return new TimeUnit((int) (new \DateTimeImmutable())->format('Uv'));
    }

    private static function create(TimeUnits $timeUnits, int $val): self
    {
        if ($val < 0) {
            throw new InvalidArgumentException("val must greater than 0");
        }
        return new TimeUnit($val * $timeUnits->val());
    }

    public static function ofMilliSeconds(int $val): self
    {
        return self::create(TimeUnits::milliSeconds(), $val);
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
        return (int) $this->milliSeconds / 1000;
    }

    public function millis(): int
    {
        return $this->milliSeconds;
    }

    public function sleep(): void
    {
        sleep($this->seconds());
    }

    public function minus(TimeUnit $timeUnit): self
    {
        return new TimeUnit($this->milliSeconds - $timeUnit->millis());
    }

    public function plus(TimeUnit $timeUnit): self
    {
        return new TimeUnit($this->milliSeconds + $timeUnit->millis());
    }
}
