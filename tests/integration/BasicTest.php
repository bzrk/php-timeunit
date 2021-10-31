<?php

declare(strict_types=1);

namespace IntegrationTest;

use BZRK\TimeUnit\TimeUnit;
use BZRK\TimeUnit\TimeUnits;
use PHPUnit\Framework\TestCase;

class BasicsTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testCreateFromSeconds(int $val): void
    {
        self::assertThat(TimeUnit::ofSeconds($val)->seconds(), self::equalTo($val));
    }

    /**
     * @dataProvider dataProvider
     */
    public function testCreateFromMinutes(int $val): void
    {
        self::assertThat(TimeUnit::ofMinutes($val)->seconds(), self::equalTo($val * 60));
    }

    /**
     * @dataProvider dataProvider
     */
    public function testCreateFromHours(int $val): void
    {
        self::assertThat(TimeUnit::ofHours($val)->seconds(), self::equalTo($val * 3600));
    }

    /**
     * @dataProvider dataProvider
     */
    public function testCreateFromDays(int $val): void
    {
        self::assertThat(TimeUnit::ofDays($val)->seconds(), self::equalTo($val * 86400));
    }

    /**
     * @dataProvider dataProvider
     */
    public function testMillis(int $val): void
    {
        self::assertThat(TimeUnit::ofSeconds($val)->millis(), self::equalTo($val * 1000));
    }

    public function testPlus(): void
    {
        $timeUnit = TimeUnit::ofSeconds(2000);
        self::assertThat($timeUnit->plus(2, TimeUnits::minutes())->seconds(), self::equalTo(2120));
    }

    public function testMinus(): void
    {
        $timeUnit = TimeUnit::ofSeconds(2000);
        self::assertThat($timeUnit->minus(2, TimeUnits::minutes())->seconds(), self::equalTo(1880));
    }

    /** @return array<array<int>> */
    public static function dataProvider(): array
    {
        return [[1], [12], [2000]];
    }
}
