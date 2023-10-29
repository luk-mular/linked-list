<?php declare(strict_types=1);

namespace LinkedList;

class SortedLinkedList extends AbstractLinkedList
{
    /**
     * @param int|string $value
     *
     * @return bool
     */
    protected function isHead(int|string $value): bool
    {
        return $this->head === null || $value <= $this->head->getValue();
    }

    /**
     * @param int|string $value
     *
     * @return \LinkedList\Node
     */
    protected function getNodeBeforeNewValue(int|string $value): Node
    {
        $currentNode = $this->head;
        while ($currentNode->getNextNode() !== null && $value > $currentNode->getNextNode()) {
            $currentNode = $currentNode->getNextNode();
        }

        return $currentNode;
    }

    /**
     * @param int|string $value
     * @param \LinkedList\Node $currentNode
     *
     * @return bool
     */
    protected function mayExistsInCurrentOrNextNodes(int|string $value, Node $currentNode): bool
    {
        return $value >= $currentNode->getValue();
    }
}
