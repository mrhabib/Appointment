<?php
$dotenv = Dotenv\Dotenv::createImmutable(BASE_DIR);
$dotenv->safeLoad();
function config(string $key)
{
    return $_ENV[$key];
}