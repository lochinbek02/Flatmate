<?php

namespace App\Http\Controllers;

use App\Models\InformationModel;
use App\Models\User;
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
