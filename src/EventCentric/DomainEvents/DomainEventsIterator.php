<?php

namespace EventCentric\DomainEvents;

use iter as _;

/**
 * Class DomainEventsIterator
 */
final class DomainEventsIterator implements DomainEvents
{
    /**
     * @var _\rewindable\_RewindableGenerator|\Iterator
     */
    private $events;

    /**
     * @param array $domainEvents
     */
    public function __construct(array $domainEvents)
    {
        $this->events = _\rewindable\map(
            function ($event) {
                if (!$event instanceof DomainEvent) {
                    throw new \InvalidArgumentException("DomainEvent expected");
                }

                return $event;
            },
            $domainEvents
        );
    }

    /**
     * @param DomainEvents $other
     * @return DomainEvents
     */
    public function append(DomainEvents $other)
    {
        return new DomainEventsIterator(
            _\toArray(_\chain($this->events, $other))
        );
    }

    /**
     * @return int
     */
    final public function count()
    {
        return _\count($this->events);
    }

    /**
     * @return DomainEvent
     */
    final public function current()
    {
        return $this->events->current();
    }

    /**
     * @return int
     */
    final public function key()
    {
        return $this->events->key();
    }

    /**
     * @return void
     */
    final public function next()
    {
        $this->events->next();
    }

    /**
     * @return void
     */
    final public function rewind()
    {
        $this->events->rewind();
    }

    /**
     * @return bool
     */
    final public function valid()
    {
        return $this->events->valid();
    }

    /**
     * @param callable $callback
     *
     * @return _\rewindable\_RewindableGenerator|\Iterator
     */
    public function map(Callable $callback)
    {
        return _\rewindable\map(
            $callback,
            $this->events
        );
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return _\toArray($this->events);
    }
}
