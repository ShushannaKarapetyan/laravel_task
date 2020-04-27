<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return User
     */
    public function model(array $row)
    {
        return new User([
            'name' => $row[1],
            'is_admin' => $row[2],
            'email' => $row[3],
            'created_at' => $row[5],
            'updated_at' => $row[6],
        ]);
    }
}
