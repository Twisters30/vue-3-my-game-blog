<?php

namespace models;

abstract class Model
{
    public $instance;
    public string $table;
    public string $key = 'id';
    private string $query = '';
    public function __construct()
    {
        $this->instance = DB::getInstance();
    }

    public function get(): array
    {
        $result = [];
        $data = $this->execute($this->query);

        if ($data) {
            while ($row = mysqli_fetch_assoc($data)) {
                $result[] = $row;
            }
        }
        return $result;
    }

    public function select(array $columns = []): Model
    {
        if (empty($columns)){
            $columns = '*';
        } else {
            $columns = implode(',', $columns);
        }
        $this->query .= "SELECT {$columns} FROM {$this->table}";

        return $this;
    }

    public function where($column, $value, $condition = '='): Model
    {
        $this->query .= " WHERE {$column} {$condition} '{$value}'";

        return $this;
    }

    public function orWhere($column, $value, $condition = '='): Model
    {
        $this->query .= " OR {$column} {$condition} '{$value}'";

        return $this;
    }

    public function find($id): array
    {
        $this->query .= "SELECT * FROM {$this->table} WHERE {$this->key} = {$id} LIMIT 1";

        return $this->execute();
    }

    public function first(): array
    {
        $this->query .= " LIMIT 1";

        return $this->get();
    }

    public function create(array $data): array
    {
        $columns = implode(', ', array_keys($data));
        $values = implode('\', \'', array_values($data));
        $this->executeRaw("INSERT INTO {$this->table} ({$columns}) VALUES ('{$values}')");

        if (!mysqli_insert_id($this->instance->connect)) {
            exit(mysqli_error($this->instance->connect));
        }

        return $this->select()->where('id', mysqli_insert_id($this->instance->connect))->first();
    }

    final public function executeRaw($query)
    {
        //TODO
    }

    final public function execute()
    {
        mysqli_query($this->instance->connect, $this->query);
    }

    public function update(array $data): Model
    {
        $params = '';
        foreach ($data as $key => $value) {
            $params .= "{$key}='{$value}', ";

        }
        $params = rtrim($params, ', ');

        $this->query = "UPDATE {$this->table} SET {$params} ";

        return $this;
    }
}