<?php

namespace Core;

class Request
{
    public function __construct()
    {
        $this->assignValues($_GET);
        $this->assignValues($_POST);
    }

    private function assignValues(array $values)
    {
        foreach ($values as $key => $value) {
            $this->$key = htmlspecialchars($value);
        }
    }
}