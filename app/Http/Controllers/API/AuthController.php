<?php
   
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\User;
use Image;
use App\Models\image_gallery;

   
class AuthController extends Controller
{
    
    public function store(Request $request)
    {
        


        $this->validate($request, [
           'image' => 'image|max:500',
       ],[
        'image.max'=>'This image size required minimum 500 ',

    ]);



        if($request->hasFile('image'))
        {     
            $file = $request->file('image');
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = date('d_m_Y_h_i_s',time()) . '.' . $extension;

            $destinationPath = base_path().'/public/images/';

             $file->move($destinationPath,$fileName);



        }else{
            $fileName = ''; 
        }


        $data=[
            'image'=>$fileName,
            'user_id'=>'1',
        ];


        $image=new image_gallery($data);
        $image->save();




        return ['status'=>'success'];


    }



   
}