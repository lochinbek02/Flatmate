<?php

namespace App\Http\Controllers;

use App\Models\InformationModel;
use App\Models\MessageModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user_id=$request->user()->id;
        $response=InformationModel::all();
        $notifacation=MessageModel::where('recipient_user',$user_id)->get();
        $groupedNotifications = $notifacation->groupBy('sending_user');
        $len=count($groupedNotifications);
        if($notifacation && $response){
            return view('home', compact('response','len'));

        }
    }
}
