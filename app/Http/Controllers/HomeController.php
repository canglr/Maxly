<?php

namespace App\Http\Controllers;

use App\Links;
use App\Pages;
use App\Userlinks;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function golink(Request $request,$share_id)
    {
        $link = Links::where('share_id', $share_id)->first();
        if ($link)
        {
            link_stats($request,$link->id);
            return redirect($link->links);
        }else{
            return view('errors.404');
        }

    }

    public function linkcreate(Request $request)
    {
        $link_long = $request->input('link');

        $validator = Validator::make($request->all(), [
            'link' => 'required|url',
        ]);


        if ($validator->passes()) {

            $link = new Links;
            $link->links = $link_long;
            $link->share_id = Str::random(rand(6,8));
            $link->save();

            if(Auth::check())
            {
                $userlink = new Userlinks;
                $userlink->user_id = Auth::id();
                $userlink->links_id = $link->id;
                $userlink->save();

            }

            add_log(
                json_encode(
                    [
                        'action' => 'add_link',
                        'user_id' => Auth::id() ?? null,
                        'ip' => $request->ip(),
                        'link_id' => $link->share_id
                    ]
                )
            );

            return response()->json([
                'link' => url('/').'/'.$link->share_id,
                'status' => true
            ]);
        }else{
            return response()->json([
                'status' => false
            ]);
        }
    }

    public function page($title_sef)
    {
        $page = Pages::where('title_sef', $title_sef)->first();
        return view('page', ['page'=> $page]);
    }

}
