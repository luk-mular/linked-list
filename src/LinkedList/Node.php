<?php declare(strict_types=1);

namespace LinkedList;
class Node
{
    /**
     * @var \LinkedList\Node|null
     */
    private self|null $nextNode;

    /**
     * @param int|string $value
     */
    public function __construct(
        private int|string $value,
    ) {
    }

    /**
     * @return \Node|null
     */
    public function getNextNode(): ?Node
    {
        return $this->nextNode;
    }

    /**
     * @param \LinkedList\Node|null $nextNode
     */
    public function setNextNode(?Node $nextNode): void
    {
        $this->nextNode = $nextNode;
    }

    /**
     * @return int|string
     */
    public function getValue(): int|string
    {
        return $this->value;
    }
}
