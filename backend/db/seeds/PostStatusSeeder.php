<?php


use Phinx\Seed\AbstractSeed;

class PostStatusSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Опубликованно'],
            ['name' => 'Ожидает'],
            ['name' => 'Исправить'],
            ['name' => 'Отклонено']
        ];

        $postStatuses = $this->table('post_statuses');
        $postStatuses->insert($data)
            ->saveData();
    }
}
