<?php

namespace Model;

use cijic\phpMorphy\Morphy;
use Database\Database;
use PDO;
use PDOException;
use ReflectionClass;
use ReflectionException;

abstract class Model
{

    public array $fillable = [];

    protected PDO $db;
    protected string $table;
    private array $dataResult;
    private Database $dbObj;

    /**
     * @throws ReflectionException
     */
    public function __construct()
    {
        // Объект PDO
        $dbClassName = 'Database\\'.ucfirst(strtolower(env('DB_CONNECTION')));
        $this->dbObj = new $dbClassName;
        $this->db = $this->dbObj->get();

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

    // Получить список полей для вставки
    protected function fieldsTable(array $fields): array
    {
        // Получаем поля, которые нужно записать в бд
        return array_intersect_key($fields, array_flip($this->fillable));
    }


    // Запись в базу данных
    public function create(array $fields)
    {
        // Получаем массив валидных полей
        $fields = $this->fieldsTable($fields);

        // Получаем строку, содержащую список полей
        $queryFields = implode(',', array_flip($fields));

        // Получаем список параметров для строки запроса
        $queryPlace = ':'.str_replace(',', ',:', $queryFields);

        $stmt = $this->db->prepare("INSERT INTO {$this->table} ($queryFields) VALUES ($queryPlace)");
        $result = $stmt->execute($fields);

        // Получаем добавленные данные
        if ($result && $output=$this->dbObj->get_inserted($this->table)) {
            return $output;
        }
        $this->errors = ['status'=>'error', 'errors'=>['Не удалось добавить отзыв. Попробуйте позже.']];
        return false;
    }

    // Венуть массив с ошибками
    public function get_errors()
    {
        return $this->errors;
    }

    // Выполнить пользовательский запрос
    protected function query(string $sql, string|array $options=[])
    {
        $options = (is_array($options)) ? $options : [$options];
        $this->_getResult($sql, $options);
    }

    // Получить все записи
    protected function getAllRows()
    {
        if(empty($this->dataResult)) return false;
        return $this->dataResult;
    }

    // Получить одну запись
    protected function getOneRow()
    {
        if(empty($this->dataResult)) return false;
        return $this->dataResult[0];
    }

    // Извлечь из базы данных одну запись
    protected function fetchOne(): bool
    {
        if(empty($this->dataResult)) return false;
        foreach($this->dataResult[0] as $key => $val){
            $this->$key = $val;
        }
        return true;
    }

    // Выполнение запроса к базе данных
    private function _getResult(string $sql, string|array $options=[])
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

    // Обработка параметров запроса
    protected function getQueryOptions(array $options): string
    {
        $query_parameters = [];
        foreach ($options as $k=>$v) {
            switch (strtolower($k)) {
                case 'orderby':
                    $direction = strtoupper($v[1]);
                    $direction = ($direction=='DESC') ? $direction : 'ASC';
                    $query_parameters[0] = " ORDER BY {$v[0]} $direction";
                    break;
                case 'limit':
                    $query_parameters[1] = " LIMIT $v";
                    break;
                case 'offset':
                    $query_parameters[2] = " OFFSET $v";
                    break;
            }
        }
        ksort($query_parameters);
        return implode($query_parameters);
    }
}
