<?php declare(strict_types=1);

namespace LinkedList;

use InvalidArgumentException;

abstract class AbstractLinkedList implements LinkedListInterface
{
    /**
     * @var \LinkedList\Node|null
     */
    protected ?Node $head;

    /**
     * @param int|string $value
     *
     * @return void
     */
    public function addNode(int|string $value): void
    {
        if ($this->head !== null && gettype($this->head->getValue()) !== gettype($value)) {
            throw new InvalidArgumentException('It\'s not allowed to add nodes of different types');
        }

        if ($this->isHead($value)) {
            $this->addHead($value);
            return;
        }

        $nodeBeforeNewNode = $this->getNodeBeforeNewValue($value);
        $nodeAfterNewNode = $nodeBeforeNewNode->getNextNode();

        $newNode = $this->createNode($value);
        $nodeBeforeNewNode->setNextNode($newNode);
        $newNode->setNextNode($nodeAfterNewNode);
    }

    /**
     * @param iterable $values
     *
     * @return void
     */
    public function addNodes(iterable $values): void
    {
        foreach ($values as $value) {
            $this->addNode($value);
        }
    }

    /**
     * @param int|string $value
     *
     * @return void
     */
    public function removeNodes(int|string $value): void
    {
        if ($this->head === null) {
            return;
        }

        $previousNode = null;
        $currentNode = $this->head;
        do {
            if ($currentNode->getValue() === $value) {
                $this->removeNode($currentNode, $previousNode);
            }

            $previousNode = $currentNode;
            $currentNode = $currentNode->getNextNode();
        } while ($currentNode !== null && $this->mayExistsInCurrentOrNextNodes($value, $currentNode));
    }

    /**
     * @return array<int|string>
     */
    public function toArray(): array
    {
        if ($this->head === null) {
            return [];
        }

        $currentNode = $this->head;
        $values = [];
        do {
            $values[] = $currentNode->getValue();
            $currentNode = $currentNode->getNextNode();
        } while ($currentNode !== null);

        return $values;
    }

    /**
     * @param int|string $value
     *
     * @return bool
     */
    public function existsNode(int|string $value): bool
    {
        if ($this->head === null) {
            return false;
        }

        $currentNode = $this->head;
        do {
            if ($currentNode->getValue() === $value) {
                return true;
            }
            $currentNode = $currentNode->getNextNode();
        } while ($currentNode !== null && $this->mayExistsInCurrentOrNextNodes($value, $currentNode));

        return false;
    }

    /**
     * @param int|string $value
     *
     * @return bool
     */
    abstract protected function isHead(int|string $value): bool;

    /**
     * @param int|string $value
     *
     * @return \LinkedList\Node
     */
    abstract protected function getNodeBeforeNewValue(int|string $value): Node;

    /**
     * @param int|string $value
     * @param \LinkedList\Node $currentNode
     *
     * @return bool
     */
    abstract protected function mayExistsInCurrentOrNextNodes(int|string $value, Node $currentNode): bool;

    /**
     * @param int|string $value
     *
     * @return void
     */
    private function addHead(int|string $value): void
    {
        $newHead = $this->createNode($value);
        $newHead->setNextNode($this->head);

        $this->head = $newHead;
    }

    /**
     * @param int|string $value
     *
     * @return \LinkedList\Node
     */
    private function createNode(int|string $value): Node
    {
        return new Node($value);
    }

    /**
     * @param \LinkedList\Node $node
     * @param \LinkedList\Node|null $previousNode
     *
     * @return void
     */
    private function removeNode(Node $node, ?Node $previousNode): void
    {
        if ($previousNode === null) {
            $this->head = $node->getNextNode();
            return;
        }

        $previousNode->setNextNode($node->getNextNode());
    }
}
