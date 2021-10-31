# PHP Timeunit

---

A library for better reading Time definitions 

## Examples
better readable code

__Plain PHP__
```php
sleep(60*60*3); // 3 Hours
sleep(60*45); // 45 Minutes

$time = \time(); - (60*60*3);
```

__PHP Timeunit__
```php
TimeUnit::ofHours(3)->sleep();
TimeUnit::ofMinutes(45)->sleep();

TimeUnit::now()->minus(TimeUnit::ofMinutes(3));
```
---

Type usage

__Plain PHP__
```php
function a(int $seconds) {
    //whatever doing with the seconds
}

a(-123455);
a(1234);
```

__PHP Timeunit__
```php
function a(TimeUnit $time) {
    //whatever doing with the seconds
}
a(TimeUnit::ofSeconds(12));
a(TimeUnit::ofSeconds(-12)); throws a InvalidArgumentException
```

## Running tests
```shell
composer verify
```

```shell
docker-compose up
```