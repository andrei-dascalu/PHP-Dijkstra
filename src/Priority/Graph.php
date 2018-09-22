<?php
/**
 * Created by PhpStorm.
 * User: adascalu
 * Date: 22/09/2018
 * Time: 15:52
 */

namespace Priority;


use Comparator\WeightComparator;

/**
 * Class Graph
 * @package Priority
 */
class Graph {

    public $nodes = array();

    public function addEdge($start, $end, $weight = 0) {
        if (!isset($this->nodes[$start])) {
            $this->nodes[$start] = array();
        }
        array_push($this->nodes[$start], new Edge($start, $end, $weight));
    }

    public function removeNode($index) {
        array_splice($this->nodes, $index, 1);
    }


    /**
     * @param $from
     * @return array
     */
    public function pathsFrom($from) {
        $dist = array();
        $dist[$from] = 0;
        $visited = array();
        $previous = array();

        $queue = new PriorityQueue(new WeightComparator());
        $queue->add(array($dist[$from], $from));

        $nodes = $this->nodes;

        while($queue->size() > 0) {
            list($distance, $u) = $queue->remove();

            if (isset($visited[$u])) {
                continue;
            }
            $visited[$u] = True;

            if (!isset($nodes[$u])) {
                print "WARNING: '$u' is not found in the node list\n";
            }

            foreach($nodes[$u] as $edge) {

                $alt = $dist[$u] + $edge->weight;
                $end = $edge->end;
                if (!isset($dist[$end]) || $alt < $dist[$end]) {
                    $previous[$end] = $u;
                    $dist[$end] = $alt;
                    $queue->add(array($dist[$end], $end));
                }
            }
        }
        return array($dist, $previous);
    }

    public function pathsTo($node_dsts, $tonode) {
        // unwind the previous nodes for the specific destination node

        $current = $tonode;
        $path = array();

        if (isset($node_dsts[$current])) { // only add if there is a path to node
            array_push($path, $tonode);
        }
        while(isset($node_dsts[$current])) {
            $nextnode = $node_dsts[$current];

            array_push($path, $nextnode);

            $current = $nextnode;
        }

        return array_reverse($path);

    }

    public function getpath($from, $to) {
        list($distances, $prev) = $this->pathsFrom($from);
        return $this->pathsTo($prev, $to);
    }
}