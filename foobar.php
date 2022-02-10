<?php
declare(strict_types=1);

function fizzBuzz(int $number): string
{
    $stringRepresentation = '';

    if ($number % 3 === 0) {
        $stringRepresentation .= 'Fizz';
    }
    if ($number % 5 === 0) {
        $stringRepresentation .= 'Buzz';
    }

    return $stringRepresentation ?: (string)$number;
}

function fooBar(int $number): string
{
    if ($number % 5 === 0) {
        return 'Foo';
    }
    if ($number % 7 === 0) {
        return 'Bar';
    }

    return (string)$number;
}

function generateResultString(callable $callback, int $max = 20)
{
    $result = [];
    for ($i = 1; $i <= $max; $i++) {
        $result[] = $callback($i);
    }
    echo implode('-', $result) . "\n";
}

generateResultString('fizzBuzz');
generateResultString('fooBar', 35);
