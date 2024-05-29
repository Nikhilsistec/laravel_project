<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AddUpdate;
use Illuminate\Http\Response;
// Nikhil suryawanshi

class AddUpdateController extends Controller
{
    public function AddUsers(Request $request)
     {
          $validatedData = $request->validate([
             'first_name' => 'required',
             'last_name' => 'required',
             'age' => 'required',
             'address' => 'required',
             'Mobile_num' => ['required', 'numeric'],
             'email' => 'required',
             'password' => ['required', 'string', 'min:8', 'max:20', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/'],
          ]);
          $Addusers = AddUpdate::create($validatedData);
        //   echo "<pre>";
        //   print_r($Addusers->toArray());

        return response()->json([
                    'user_details' => $Addusers,
                    'message' => 'User added successfully'
                 ], 200);
     }

    // public function updateUser(Request $request, $id)
    // {
    //   $user = AddUpdate::find($id);

    //    if (is_null($user)) {
    //       return response()->json([
    //           'message' => 'User not found !!!'
    //       ], 404);
    //    }

    //     $validatedData = $request->validate([
    //       'name' => 'required',
    //       'age' => 'required',
    //       'address' => 'required',
    //      'Mobile_num' => 'required',
    //   ]);

   
    //    $user->update($validatedData);

  
    //     return response()->json([
    //         'user_details' => $user,
    //         'message' => 'User updated successfully'
    //      ], 200);
    // }


    public function getUser(Request $request, $id)
    {
        $user = AddUpdate::find($id);

        if (is_null($user)) {
            return response()->json([
                'message' => 'User not found !!!'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'user_details' => $user,
            'message' => 'User details retrieved successfully'
        ], Response::HTTP_OK);
    }

    public function updateUser(Request $request, $id)
    {
        $user = AddUpdate::find($id);

        if (is_null($user)) {
            return response()->json([
                'message' => 'User not found !!!'
            ], Response::HTTP_NOT_FOUND);
        }

        $validatedData = $request->validate([
            'first_name' => 'sometimes|required',
            'last_name' => 'sometimes|required',
            'age' => 'sometimes|required',
            'address' => 'sometimes|required',
            'Mobile_num' =>  'sometimes|required|numeric',
            'email' => 'sometimes|required',
            'password' =>  'sometimes|required|string|min:8|max:20|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/',
        ]);

        $user->update($validatedData);

        return response()->json([
            'user_details' => $user,
            'message' => 'User updated successfully'
        ], Response::HTTP_OK);
    }





    public function deleteUser($id)
    {
        $user = AddUpdate::find($id);
        if (is_null($user)) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }
        $user->delete();
        return response()->json([
            'message' => 'User soft deleted successfully'
        ]);
    }


    public function showUsers()
    {
        $users = AddUpdate::all();

        return response()->json([
            'users' => $users
        ]);
    }
    
    //Search API Implementation

    public function search($str)
    {
        $result = AddUpdate::where(function($query) use ($str) {
            $query->where("first_name", "like", "%" . $str . "%")
                  ->orWhere("last_name", "like", "%" . $str . "%")
                  ->orWhereRaw("CONCAT(first_name,'',last_name) like ?", ["%" . $str . "%"]);
        })
        ->get();
                            
         if($result->isEmpty())
         {
            return response()->json([
                'message' => 'User not found'
            ]);
         }
         else
         {
            return response()->json([
                'user' => $result
            ]);
         }
    }

     //Restore deleted user by id 

    public function restoreUser($id)
    {
        $user = AddUpdate::withTrashed()->find($id);

        if (is_null($user)) {
            return response()->json([
                'message' => 'User not found or already restored'
            ], 404);
        }

        
        if ($user->deleted_at === null) {
            return response()->json([
                'message' => 'User is already active'
            ]);
        }

        $user->restore();

        return response()->json([
            'message' => 'User restored successfully'
        ]);
    }

}
