<?php

namespace EventCentric\DomainEvents;

use Countable;
use Iterator;

interface DomainEvents extends Countable, Iterator
{
    /**
     * @param callable $callback
     *
     * @return \Iterator
     */
    public function map(callable $callback);

    /**
     * @param DomainEvents $other
     *
     * @return DomainEvents
     */
    public function append(DomainEvents $other);

    /**
     * @return array
     */
    public function toArray();
}
