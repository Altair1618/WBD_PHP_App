<?php

class Model {
    protected $db;

    function __construct($db = null) {
        $this->db = $db ?? new Database();
    }
}
