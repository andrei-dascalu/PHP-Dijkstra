<?php
/**
 * Created by PhpStorm.
 * User: adascalu
 * Date: 22/09/2018
 * Time: 15:41
 */

namespace Comparator;

use InterfaceComparator;
use Node\Node;

class WeightComparator implements InterfaceComparator
{
    /**
     * @param Node $a
     * @param Node $b
     * @return int
     */
    public function compare(Node $a, Node $b)
    {
        return ($a->data[0] - $b->data[0]);
    }
}