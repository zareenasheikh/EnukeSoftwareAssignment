<?php
   
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Image;
use App\Models\image_gallery;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

   
class AuthController extends Controller
{
    

    public function createUser(Request $request)
    {
        try {
            //Validated
            $validateUser = Validator::make($request->all(), 
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Login The User
     * @param Request $request
     * @return User
     */
    public function loginUser(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(), 
            [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }


    public function uploadUserImg(Request $request)
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