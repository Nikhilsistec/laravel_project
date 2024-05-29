<?php

namespace App\Http\Controllers\Api\Auth;

use App\Imports\UsersImport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class UserController extends Controller
{
    public function upload(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls|max:2048' // adjust max file size as needed
        ]);

        // Parse and insert data
        Excel::import(new UsersImport, $request->file('file'));

        // Return success response
        return response()->json(['message' => 'Users registered successfully'], 200);
    }
}
