<?php
namespace App;

use PDO;
use PDOException;

class DataBase
{
    const HOST = 'localhost';
    const USER = 'root';
    const PASSWORD = '';   
    const DBNAME = 'consultorio';

    private $connection;
    private $table;

    public function __construct($table = null)
    {
        $this->setConnection();
        $this->table = $table;
    }

    private function setConnection()
    {
        try {
            $this->connection = new PDO(
                'mysql:host=' . self::HOST .
                ';dbname=' . self::DBNAME .
                ';charset=utf8mb4',
                self::USER,
                self::PASSWORD
            );

            $this->connection->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

            $this->connection->setAttribute(
                PDO::ATTR_DEFAULT_FETCH_MODE,
                PDO::FETCH_OBJ
            );

        } catch (PDOException $e) {
            die('Erro ao conectar ao banco de dados. Verifique as credenciais do MySQL.');
        }
    }

    public function execute($query, $values = [])
    {
        try {
            $statement = $this->connection->prepare($query);
            $statement->execute($values);

            return $statement;

        } catch (PDOException $e) {
            die('Erro ao executar SQL: ' . $e->getMessage());
        }
    }

    public function insert($array)
    {
        $fields = array_keys($array);
        $binds = array_fill(0, count($array), '?');

        $query = 'INSERT INTO ' . $this->table .
            ' (' . implode(', ', $fields) . ')' .
            ' VALUES (' . implode(', ', $binds) . ')';

        $this->execute($query, array_values($array));

        return $this->connection->lastInsertId();
    }

    public function select()
    {
        $query = 'SELECT * FROM ' . $this->table;

        return $this->execute($query)->fetchAll();
    }
}
