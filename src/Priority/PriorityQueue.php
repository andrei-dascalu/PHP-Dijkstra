<?php
/**
 * Created by PhpStorm.
 * User: adascalu
 * Date: 22/09/2018
 * Time: 15:33
 */

namespace Priority;

use InterfaceComparator;
use Node\Node;

class PriorityQueue {

    /**
     * @var int
     */
    private $size;

    /**
     * @var Node
     */
    private $listStart;

    /**
     * @var InterfaceComparator
     */
    private $comparator;

    function __construct(InterfaceComparator $comparator) {
        $this->size = 0;
        $this->listStart = null;
        $this->comparator = $comparator;
    }

    function add($x) {
        $this->size = $this->size + 1;
        $newNode = new Node($x);

        if($this->listStart == null) {
            $this->listStart = $newNode;
        } else {
            $node = $this->listStart;
            $comparator = $this->comparator;
            $lastNode = null;
            $added = false;
            while($node) {
                if ($comparator->compare($newNode, $node) < 0) {
                    // newnode has higher priority
                    $newNode->next = $node;
                    if ($lastNode == null) {
                        //print "last node is null\n";
                        $this->listStart = $newNode;
                    } else {
                        //print "Debug: " . $newnode->data . " has lower priority than " . $lastnode->data . "\n";
                        $lastNode->next = $newNode;
                    }
                    $added = true;
                    break;
                }
                $lastNode = $node;
                $node = $node->next;
            }
            if (!$added) {
                // Lowest priority - add to the very end
                $lastNode->next = $newNode;
            }
        }
        //print "Debug: Appended node. New size=" . $this->size . "\n";
        //$this->debug();
    }

    function debug() {
        $node = $this->listStart;
        $i = 0;
        if (!$node) {
            print "<< No nodes >>\n";
            return;
        }

        while($node) {
            print "[$i]=" . $node->data[1] . " (" . $node->data[0] . ")\n";
            $node = $node->next;
            $i++;
        }
    }

    function size() {
        return $this->size;
    }

    function peak() {
        return $this->listStart->data;
    }

    function remove() {
        $x = $this->peak();
        $this->size = $this->size - 1;
        $this->listStart = $this->listStart->next;
        //print "Debug: Removed node. New size=" . $this->size . "\n";
        //$this->debug();
        return $x;
    }
}
