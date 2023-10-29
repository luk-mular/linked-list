<?php declare(strict_types=1);

namespace LinkedList;

interface LinkedListInterface
{
    /**
     * @param int|string $value
     *
     * @return void
     */
    public function addNode(int|string $value): void;

    /**
     * @param iterable<int|string> $values
     *
     * @return void
     */
    public function addNodes(iterable $values): void;

    /**
     * @param int|string $value
     *
     * @return void
     */
    public function removeNodes(int|string $value): void;

    /**
     * @return array<int|string>
     */
    public function toArray(): array;

    /**
     * @param int|string $value
     *
     * @return bool
     */
    public function existsNode(int|string $value): bool;
}
