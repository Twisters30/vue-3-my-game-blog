<?php

namespace models\User;

use models\Model;

class RefreshToken extends Model
{
    public string $table = 'refresh_tokens';

    public function tokenOwner($column, $value, $condition = '='): array
    {
        return $this->executeRaw(
            "SELECT rt.token, rt.id, u.email, u.id AS user_id, r.name AS role_name
                    FROM refresh_tokens AS rt
                    LEFT JOIN users AS u
                    ON u.id = rt.user_id
                    INNER JOIN roles AS r
                    ON u.role_id = r.id
                    WHERE rt.{$column} {$condition} '{$value}'"
        );
    }
}