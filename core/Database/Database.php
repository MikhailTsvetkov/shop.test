<?php

namespace Core\Database;

use PDO;

abstract class Database
{
    private PDO|null $dbh = null;

    public function __construct()
    {
    }

    public function connect(): ?PDO
    {
        $this->dbh = new PDO(
            'mysql:host='.env('DB_HOST').';port='.env('DB_PORT').';dbname='.env('DB_DATABASE'),
            env('DB_USERNAME'), env('DB_PASSWORD')
        );
        return $this->dbh;
    }

    public function get()
    {
        return $this->dbh;
    }

    public function get_inserted($table)
    {
        if ($id=$this->dbh->lastInsertId()) {
            $stmt = $this->dbh->prepare("SELECT * FROM $table WHERE id=$id");
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        }
        return false;
    }

}
