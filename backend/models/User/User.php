<?php

namespace models\User;

use models\Model;

class User extends Model
{
    public string $table = 'users';

    public function userWithRole($column, $value, $condition = '='): array
    {
        return $this->executeRaw(
            "SELECT u.*, r.name AS role_name
                    FROM {$this->table} AS u
                    INNER JOIN roles AS r
                    ON u.role_id = r.id
                    WHERE u.{$column} {$condition} '{$value}'"
        );
    }
}