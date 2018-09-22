<?php
/**
 * Created by PhpStorm.
 * User: adascalu
 * Date: 22/09/2018
 * Time: 15:32
 */

namespace Priority;

/**
 * Class PriorityList
 */
class PriorityList {

    public $next;
    public $data;

    /**
     * PriorityList constructor.
     * @param mixed $data
     */
    function __construct($data) {
        $this->next = null;
        $this->data = $data;
    }
}