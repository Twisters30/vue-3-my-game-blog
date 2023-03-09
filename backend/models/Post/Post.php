<?php

namespace models\Post;

use models\Model;

class Post extends Model
{
    public string $table = 'posts';

    public function activePostsWithAuthor(): array
    {
        $this->query = "
            SELECT p.*, u.name AS author_name FROM posts AS p
            RIGHT JOIN users AS u
            ON p.user_id = u.id
            WHERE p.post_status_id = 1
        ";

        return $this->htmlDecode();
    }
}