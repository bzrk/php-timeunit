<?php

declare(strict_types=1);

namespace IntegrationTest;

use BZRK\TimeUnit\TimeUnit;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class BasicTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testCreateFromSeconds(int $val): void
    {
        self::assertThat(TimeUnit::ofSeconds($val)->seconds(), self::equalTo($val));
    }

    public function testCreateFromSecondsWithInvalidArgument(): void
    {
        self::expectException(InvalidArgumentException::class);
        TimeUnit::ofSeconds(-1);
    }

    /**
     * @dataProvider dataProvider
     */
    public function testCreateFromMinutes(int $val): void
    {
        self::assertThat(TimeUnit::ofMinutes($val)->seconds(), self::equalTo($val * 60));
    }

    public function testCreateFromMinutesWithInvalidArgument(): void
    {
        self::expectException(InvalidArgumentException::class);
        TimeUnit::ofMinutes(-1);
    }

    /**
     * @dataProvider dataProvider
     */
    public function testCreateFromHours(int $val): void
    {
        self::assertThat(TimeUnit::ofHours($val)->seconds(), self::equalTo($val * 3600));
    }

    public function testCreateFromHoursWithInvalidArgument(): void
    {
        self::expectException(InvalidArgumentException::class);
        TimeUnit::ofHours(-1);
    }

    /**
     * @dataProvider dataProvider
     */
    public function testCreateFromDays(int $val): void
    {
        self::assertThat(TimeUnit::ofDays($val)->seconds(), self::equalTo($val * 86400));
    }

    public function testCreateFromDaysWithInvalidArgument(): void
    {
        self::expectException(InvalidArgumentException::class);
        TimeUnit::ofDays(-1);
    }

    /**
     * @dataProvider dataProvider
     */
    public function testMillisFromMilliSeconds(int $val): void
    {
        self::assertThat(TimeUnit::ofMilliSeconds($val)->millis(), self::equalTo($val));
    }

    /**
     * @dataProvider dataProvider
     */
    public function testMillisFromSeconds(int $val): void
    {
        self::assertThat(TimeUnit::ofSeconds($val)->millis(), self::equalTo($val * 1000));
    }

    public function testPlus(): void
    {
        $timeUnit = TimeUnit::ofSeconds(2000);
        self::assertThat($timeUnit->plus(TimeUnit::ofMinutes(2))->seconds(), self::equalTo(2120));
    }

    public function testMinus(): void
    {
        $timeUnit = TimeUnit::ofSeconds(2000);
        self::assertThat($timeUnit->minus(TimeUnit::ofMinutes(2))->seconds(), self::equalTo(1880));
    }

    public function testNow(): void
    {
        $now = (int) (new \DateTime())->format('Uv');
        $timeUnit = TimeUnit::now();

        self::assertThat($timeUnit->millis(), self::greaterThanOrEqual($now));
        self::assertThat($timeUnit->millis(), self::lessThanOrEqual($now + 500));
    }

    /** @return array<array<int>> */
    public static function dataProvider(): array
    {
        return [[1], [12], [2000]];
    }
}
