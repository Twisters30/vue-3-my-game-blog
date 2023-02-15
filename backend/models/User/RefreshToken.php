<?php


namespace models\User;


use models\Model;

class RefreshToken extends Model
{
    public string $table = 'refresh_tokens';
}