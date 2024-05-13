<?php

namespace Laravel\Blog\application\models\Repositories;

abstract class Repository
{
    protected $db;

    public function __construct($db) {
        $this->db = $db;
    }

    abstract public function getByKey($key);
    abstract public function save($entity);
    abstract public function delete($key);
    abstract public function update($entity);
}