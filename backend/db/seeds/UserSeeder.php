<?php


use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
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
            [
                'name' => 'Admin',
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'role_id' => 1,
                'email' => 'admin@admin.com',
            ]
        ];

        $users = $this->table('users');
        $users->insert($data)
              ->saveData();
    }
}
