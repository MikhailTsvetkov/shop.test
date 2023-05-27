<?php

namespace Model;

use cijic\phpMorphy\Morphy;
use PDO;
use PDOException;
use ReflectionClass;
use ReflectionException;

abstract class Model
{

    protected PDO $db;
    protected string $table;
    private array $dataResult;

    /**
     * @throws ReflectionException
     */
    public function __construct()
    {
        // Объект PDO
        $dbClassName = 'Database\\'.ucfirst(strtolower(env('DB_CONNECTION')));
        $dbClass = new $dbClassName;
        $this->db = $dbClass->get();

        // Имя таблицы
        $reflect = new ReflectionClass($this);
        $modelName = $reflect->getShortName();

        $morphy = new Morphy('en');
        $tableName = strtolower($morphy->getAllForms(strtoupper($modelName))[1]);

        $this->table = $tableName;
    }

    // Получить имя таблицы
    public function getTableName(): string
    {
        return $this->table;
    }

    // Выполнить пользовательский запрос
    public function query(string $sql, string|array $options=[])
    {
        $options = (is_array($options)) ? $options : [$options];
        $this->_getResult($sql, $options);
    }

    // Получить все записи
    public function getAllRows()
    {
        if(empty($this->dataResult)) return false;
        return $this->dataResult;
    }

    // Получить одну запись
    public function getOneRow()
    {
        if(empty($this->dataResult)) return false;
        return $this->dataResult[0];
    }

    // Извлечь из базы данных одну запись
    public function fetchOne(): bool
    {
        if(empty($this->dataResult)) return false;
        foreach($this->dataResult[0] as $key => $val){
            $this->$key = $val;
        }
        return true;
    }

    // Выполнение запроса к базе данных
    private function _getResult(string $sql, string|array $options)
    {
        try {
            $db = $this->db;
            $stmt = $db->prepare($sql);
            $stmt->execute($options);
            $rows = $stmt->fetchAll();
            $this->dataResult = $rows;
        } catch(PDOException $e) {
            echo $e->getMessage();
            exit();
        }

        return $rows;
    }

    private function fieldsTable(): array
    {
        return [
            'id' => 'Id',
        ];
    }
}
