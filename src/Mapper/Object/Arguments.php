<?php

declare(strict_types=1);

namespace CuyZ\Valinor\Mapper\Object;

use Countable;
use CuyZ\Valinor\Mapper\Object\Exception\InvalidArgumentIndex;
use IteratorAggregate;
use Traversable;

/**
 * @internal
 *
 * @implements IteratorAggregate<Argument>
 */
final class Arguments implements IteratorAggregate, Countable
{
    /** @var Argument[] */
    private array $arguments;

    public function __construct(Argument ...$arguments)
    {
        $this->arguments = $arguments;
    }

    public function at(int $index): Argument
    {
        if ($index >= count($this->arguments)) {
            throw new InvalidArgumentIndex($index, $this);
        }

        return $this->arguments[$index];
    }

    public function signature(): string
    {
        $parameters = array_map(
            fn (Argument $argument) => $argument->isRequired()
                ? "{$argument->name()}: {$argument->type()}"
                : "{$argument->name()}?: {$argument->type()}",
            $this->arguments
        );

        return 'array{' . implode(', ', $parameters) . '}';
    }

    public function count(): int
    {
        return count($this->arguments);
    }

    /**
     * @return Traversable<Argument>
     */
    public function getIterator(): Traversable
    {
        yield from $this->arguments;
    }
}