<?php

use Node\Node;

/**
 * Created by PhpStorm.
 * User: adascalu
 * Date: 22/09/2018
 * Time: 15:40
 */

interface InterfaceComparator
{
    function compare(Node $a, Node $b);
}