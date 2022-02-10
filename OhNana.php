<?php
declare(strict_types=1);

class Rule
{
    public function __construct(
        private string $substitute,
        private readonly Closure $comparator
    ) {
    }

    public function getSubstitute(): string
    {
        return $this->substitute;
    }

    public function getComparator(): Closure
    {
        return $this->comparator;
    }
}

class OhNana
{
    /** @var array|Rule[] */
    private array $rules = [];

    public function __construct(private string $name, private int $max = 20)
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param  Rule[]  $rules
     *
     * @return $this
     */
    public function addRules(Rule ...$rules): self
    {
        $this->rules += $rules;

        return $this;
    }

    public function execute(): string
    {
        $result = [];
        for ($i = 1; $i <= $this->max; $i++) {
            $intermediateResult = '';
            array_walk($this->rules, function (Rule $rule) use (
                &$intermediateResult,
                $i
            ) {
                if ($rule->getComparator()($i)) {
                    $intermediateResult .= $rule->getSubstitute();
                }
            });

            $result[] = $intermediateResult ?: (string)$i;
        }

        return implode('-', $result) . "\n";
    }
}

$fizzBuzz = (new OhNana('FizzBuzz'))->addRules(
    new Rule('Fizz', fn($number) => $number % 3 === 0),
    new Rule('Buzz', fn($number) => $number % 5 === 0),
);

$fooBar = (new OhNana('FooBar'))->addRules(
    new Rule('Foo', fn($number) => $number % 5 === 0),
    new Rule('Bar', fn($number) => $number % 7 === 0),
);

$banana = (new OhNana('Banana'))->addRules(
    new Rule('Banana', fn($number) => $number === 12),
    new Rule('Nana', fn($number) => $number > 10 && $number < 15),
);

// outputs
echo $fizzBuzz->execute();
echo $fooBar->execute();
echo $banana->execute();
