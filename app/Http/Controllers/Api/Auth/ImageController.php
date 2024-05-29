<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Validator;


class ImageController extends Controller
{
    public function UploadImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Image' => 'required|mimes:png,jpg|max:2048'
        ]);

          if( $validator ->fails())
          {
            return response()->json([
                'status' => false,
                 'message' => 'please provide valid details',
                 'errors' => $validator->errors()
            ]);
          }
          
          $img = $request->Image;
          $ext = $img->getClientOriginalExtension();
          $imageName = time().'.'.$ext;
          $img->move(public_path().'/UploadsImage/',$imageName);

          $image= new Image;
          $image-> Image = $imageName;
          $image-> save();


          return response()->json([
            'status' => true,
             'message' => 'Image Uploads Successfully!!!!',
             'path' => asset('/UploadsImage/'.$imageName),
             'data' => $image
        ]);
    }
}
