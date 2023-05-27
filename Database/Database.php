<?php

namespace Database;

use PDO;

abstract class Database
{
    private PDO|null $dbh = null;

    public function __construct()
    {
        $this->dbh = new PDO(
            'mysql:host='.env('DB_HOST').';port='.env('DB_PORT').';dbname='.env('DB_DATABASE'),
            env('DB_USERNAME'), env('DB_PASSWORD')
        );
    }

    public function get()
    {
        return $this->dbh;
    }

}
