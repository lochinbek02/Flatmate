<?php

namespace App\Http\Controllers;

use App\Models\InformationModel;
use App\Models\MessageModel;
use App\Models\RoleModel;
use App\Models\User;
use App\Models\UserWithModel;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MainApiController extends Controller
{
    //
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        // return $request;
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('api_token')->plainTextToken;
            // $user->update([
            //     'token' => $token,
            // ]);
            
            return response()->json(['token' => $token], 200);
        }
    
        return response()->json(['message' => 'Unauthorized'], 401);
    }
    public function register(Request $request)
    {
        // return $request;
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);
      
        return response()->noContent();
    }
    public function home(Request $request)
    {
        $user_id= $request->user()->id;
        $role=RoleModel::where('user_id',$user_id)->first();
        // return $user_id;
        if($role->role=='admin'){
            return InformationModel::all();
        }
        else{
            $provence=InformationModel::where('user_id',$user_id)->select('province')->first();
            $response = InformationModel::where('province',$provence->province)
            ->select('user_id',
            'first_name',
            'last_name',
            'age',
            'smoking',
            'province',
            'city',
            'neighborhood',
            'from_money',
            'up_money',
            'about_user',
            'image')
            ->get();
            return $response;
        }
        
    }
    public function like(Request $request)
    {
        $user_id= $request->user()->id;
        $credentials = $request->only('userid_n2', 'like_n1');
        if($user_id!=$credentials['userid_n2']){
            UserWithModel::create([
                'userid_n1'=>$user_id,
                'userid_n2'=>$credentials['userid_n2'],
                'like_n1'=>$credentials['like_n1'],
            ]);
            return 'success';
        }

        return '?';
        
    }
    public function message(Request $request)
    {
        $user_id= $request->user()->id;
        $credentials = $request->only('recipient_user', 'message');
        if($user_id!=$credentials['recipient_user']){
            
            MessageModel::create([
                'sending_user'=>$user_id,
                'recipient_user'=>$credentials['recipient_user'],
                'message'=>$credentials['message'],
            ]);
            $response = MessageModel::where(function($query) use ($user_id, $credentials) {
                $query->where('sending_user', $user_id)
                      ->where('recipient_user', $credentials['recipient_user']);
            })->orWhere(function($query) use ($user_id, $credentials) {
                $query->where('recipient_user', $user_id)
                      ->where('sending_user', $credentials['recipient_user']);
            })->get();
            
            return $response;
        }

        return '?';
    }
    public function messageshow(Request $request)
    {
        $user_id= $request->user()->id;
        $credentials = $request->only('recipient_user');
        if($user_id!=$credentials['recipient_user']){
            
            
            $response = MessageModel::where(function($query) use ($user_id, $credentials) {
                $query->where('sending_user', $user_id)
                      ->where('recipient_user', $credentials['recipient_user']);
            })->orWhere(function($query) use ($user_id, $credentials) {
                $query->where('recipient_user', $user_id)
                      ->where('sending_user', $credentials['recipient_user']);
            })->get();
            
            return $response;
        }

        return '?';
    }
    public function search(Request $request)
    {
        $query = InformationModel::query();    
        foreach ($request->all() as $key => $value) {
            if ($value) {
                $query->where($key, $value);
            }
        }
        $response = $query->get();
        return response()->json($response);
    }

}
