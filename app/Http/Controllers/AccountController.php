<?php

namespace App\Http\Controllers;

Use App\User;
use App\Links;
use App\Userlinks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
Use Validator;
use Illuminate\Support\Facades\Hash;


class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function myaccount()
    {
        return view('account.myaccount');
    }

    public function myaccount_edit()
    {
        return view('account.edit');
    }

    public function myaccount_edit_post(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required',
        ]);

        $name = $request->input('name');

        $user = User::find(Auth::id());
        $old_name = $user->name;
        $user->name = $name;
        $user->save();
        add_log(
            json_encode(
                [
                    'action' => 'account_edit',
                    'user_id' => Auth::id(),
                    'ip' => $request->ip(),
                    'old_name' => $old_name,
                    'new_name' => $user->name
                ]
            )
        );
        return back()->with('success','Updated');
    }

    public function myaccount_password()
    {
        return view('account.password');
    }

    public function myaccount_password_post(Request $request)
    {


        $validator = $request->validate([
            'current' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);

        $current = $request->input('current');
        $password = $request->input('password');

        $check = Hash::check($current, auth()->user()->password);
        if($check)
        {
            User::find(auth()->user()->id)->update(['password'=> Hash::make($password)]);
            add_log(
                json_encode(
                    [
                        'action' => 'account_password_change',
                        'user_id' => Auth::id(),
                        'ip' => $request->ip()
                    ]
                )
            );
            return back()->with('success','The password was changed.');
        }else{
            return back()->with('error','The current password does not match.');
        }

    }

    public function mylinks()
    {
        $mylinks = DB::table('links')
            ->join('user_links', 'links.id', '=', 'user_links.links_id')
            ->select('links.links', 'links.share_id', 'links.created_at', 'links.updated_at')
            ->where('user_links.user_id', '=', Auth::id())
            ->orderByRaw('links.id DESC')
            ->paginate(15);

        return view('account.mylinks', ['mylinks' => $mylinks]);
    }

    public function mylinks_hide(Request $request,$id)
    {
        $links = DB::table('links')
            ->join('user_links', 'links.id', '=', 'user_links.links_id')
            ->select('links.id')
            ->where('user_links.user_id', '=', Auth::id())
            ->where('links.share_id', '=', $id)
            ->first();
        $user_links = Userlinks::where('links_id', $links->id)->where('user_id', Auth::id())->first();
        $user_links->delete();
        add_log(
            json_encode(
                [
                    'action' => 'mylink_hide',
                    'user_id' => Auth::id(),
                    'link_id' => $id,
                    'ip' => $request->ip()
                ]
            )
        );
        return redirect('/go/mylinks');
    }

    public function mylinks_stats($id)
    {
        $link = DB::table('links')
            ->join('user_links', 'links.id', '=', 'user_links.links_id')
            ->select('links.id', 'links.share_id', 'links.created_at')
            ->where('user_links.user_id', '=', Auth::id())
            ->where('links.share_id', '=', $id)
            ->first();
        $link_clicks = $singular_user = DB::table('link_stats')->where('links_id', $link->id)->count();
        $languages = DB::table('link_stats')
            ->select('language', DB::raw('count(*) as total'))
            ->where('links_id', $link->id)
            ->groupBy('language')
            ->orderByRaw('total DESC')
            ->get();

        $browsers = DB::table('link_stats')
            ->select('browser', DB::raw('count(*) as total'))
            ->where('links_id', $link->id)
            ->groupBy('browser')
            ->orderByRaw('total DESC')
            ->get();

        $referers = DB::table('link_stats')
            ->select('referer', DB::raw('count(*) as total'))
            ->where('links_id', $link->id)
            ->groupBy('referer')
            ->orderByRaw('total DESC')
            ->get();

        return view('account.mylinkstats', ['link' => $link, 'link_clicks' => $link_clicks, 'languages' => $languages, 'browsers' => $browsers, 'referers' => $referers]);
    }

}
