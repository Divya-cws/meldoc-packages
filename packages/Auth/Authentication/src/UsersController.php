<?php

namespace Auth\Authentication;

use App\Http\Controllers\Controller;
use Auth\Authentication\Users;

use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

use Validator;
use Mail;
use Debugbar;

class UsersController extends Controller
{
    public $successStatus = 200;
    public function login(Request $request)
    {
        $input = $request->all();
        $userDetails=Users::where('user_email',$request['user_email'])->first();
        if($userDetails && Hash::check($request['user_password'],$userDetails['user_password']))
        {
            $success['token'] = $userDetails->createToken('MyApp')-> accessToken; 
            return response()->json(['success' => $success],
            $this-> successStatus); 
        }
        else
        {
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }

    public function register(Request $request)
    {

         try {
            $input = $request->all();
            $duplicates=Users::where('user_email',$input['user_email'])->first();

            
            if($duplicates=='')
            {
                $input['user_password']=Hash::make($input['user_password']);
                $image = $request->file('user_image');
                if($image)
                    {
                        $input['user_image'] = time().'.'.$image->getClientOriginalExtension();
                        $destinationPath = public_path('/images');
                        $image->move($destinationPath, $input['user_image']);
                    }
                    if(Users::insert($input))
                    {
                        $name=$input['user_firstname'].' '.$input['user_lastname'];
                        $url=url('/');

                        $data = array('name'=>$name,'url'=>$url);


                        Mail::send('mail', $data, function($message) {
                                     $message->to('divya@sintheetaa.in', 'Tutorials Point')->subject
                                        ('Laravel Basic Testing Mail');
                                     $message->from('xyz@gmail.com','Virat Gandhi');
                        });
                      echo "Basic Email Sent. Check your inbox.";
                        $result['response']='Success';
                        $result['responseMessage']='Registration has been Completed Successfully.';
                    }
                    else
                    {
                        $result['response']='Failure';
                        $result['responseMessage']='Some Error has been occured';
                    }
            }
            else
            {
                $result['response']='Failure';
                $result['responseMessage']='This email '.$input['user_email'].' is already exist.';
            }

            // return response()->success($result);
           return response()->json(['success' => $result],$this-> successStatus);
        } catch (Exception $e) {
            Debugbar::addThrowable($e);
            return response()->exception($e->getMessage(), $e->getCode());
        }
        
    }

    public function update($id)
    {
        try{
                $input = Request::all();
                $users = Users::findOrFail($id);
                if($users->update($input))
                {
                    $result['response']='Success';
                    $result['responseMessage']='Details has been Updated Successfully.';
                }
                else
                {
                    $result['response']='Failure';
                    $result['responseMessage']='Some Error has been occured';
                }

                 return response()->success($result);
        } catch (Exception $e) {

            Debugbar::addThrowable($e);
            return response()->exception($e->getMessage(), $e->getCode());
        }
    }

    public function destroy($id)
    {
    	
         try {
                $users = Users::findOrFail($id);
                if($users->delete())
                {
                    $result['response']='Success';
                    $result['responseMessage']='Details has been Deleted Successfully.';
                }
                else
                {
                    $result['response']='Failure';
                    $result['responseMessage']='Some Error has been occured';
                }
            return response()->success($result);
        } 
        catch (Exception $e) 
        {
            Debugbar::addThrowable($e);
            return response()->exception($e->getMessage(), $e->getCode());
        }

    }       
}