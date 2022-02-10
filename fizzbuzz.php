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

(function (int $max): void {
    $result = [];
    for ($i = 1; $i <= $max; $i++) {
        $result[] = fizzBuzz($i);
    }

    echo implode('-', $result);
})(max: 20);
