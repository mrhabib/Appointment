<?php

namespace App\Repositories;

use Core\DB;

class Repository
{
    protected string $table = "";


    public function __construct(
        protected readonly DB $db
    )
    {

    }

    public function findById(int $id): mixed
    {
        return $this->db->getOne("SELECT * FROM " . $this->table . " WHERE id = " . $id);
    }

    public function getAll(): array|false
    {
        return $this->db->getAll("SELECT * FROM " . $this->table);
    }
}