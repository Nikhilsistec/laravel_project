<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class UsersImport implements ToModel, WithHeadingRow
{
    
    public function model(array $row)
    {
        // Hash the password before inserting
        $hashedPassword = Hash::make($row['password']);

        // Create and return a new User model instance with hashed password
        return new User([
            'name' => $row['name'],
            'email' => $row['email'],
            'password' => $hashedPassword,
            // Add more fields as needed
        ]);
    }


     // /**
    //  * @param array $row
    //  *
    //  * @return AddExcelUser|null
    //  */
    // public function model(array $row)
    // {
    //     return new  User([
    //         'name' => $row['name'],
    //          'email' => $row['email'],
    //     ]);
    // }

}
