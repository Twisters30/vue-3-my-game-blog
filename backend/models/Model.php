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

    /**
     * @throws \Exception
     */
    public function get(): array
    {
        $result = [];
        $data = $this->execute();

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
        $this->query = "SELECT {$columns} FROM {$this->table}";

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

    public function andWhere($column, $value, $condition = '='): Model
    {
        $this->query .= " AND {$column} {$condition} '{$value}'";

        return $this;
    }

    public function find($id): array
    {
        $this->query .= "SELECT * FROM {$this->table} WHERE {$this->key} = {$id} LIMIT 1";

        return $this->execute();
    }

    public function first()
    {
        $this->query .= " LIMIT 1";

        return $this->execute()->fetch_assoc();
    }

    public function all(): array
    {
        $this->query = "SELECT * FROM {$this->table}";

        return $this->get();
    }

    /**
     * @throws \Exception
     */
    public function create($data): array
    {
        (array)$data;
        $columns = implode(', ', array_keys($data));
        $values = implode('\', \'', array_values($data));
        $this->query = "INSERT INTO {$this->table} ({$columns}) VALUES ('{$values}')";
        $this->execute();

        $this->checkErrors();

        return $this->select()->where('id', mysqli_insert_id($this->instance->connect))->first();
    }

    final public function executeRaw(string $query): array
    {
        return $this->instance->connect->query($query)->fetch_assoc() ?? [];
    }

    /**
     * @throws \Exception
     */
    protected function checkErrors()
    {
        if (mysqli_error($this->instance->connect)) {
            throw new \Exception(mysqli_error($this->instance->connect), 500);
        }
    }

    /**
     * @throws \Exception
     */
    final public function execute()
    {
        $executeResult = mysqli_query($this->instance->connect, $this->query);
        $this->query = '';

        $this->checkErrors();

        return $executeResult;
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

    /**
     * @throws \Exception
     */
    public function delete($column, $value, $condition = '='): bool
    {
        $this->query = "DELETE FROM {$this->table}";
        $this->where($column, $value, $condition);
        $this->execute();

        return true;
    }

    public function htmlDecode(): array
    {
        $data = $this->all();

        array_walk_recursive($data, function (&$item){
            $item = htmlspecialchars_decode($item);
        });

        return $data;
    }
}