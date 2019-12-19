<?php

namespace App\Http\Controllers;

use App\Links;
use App\Linkstats;
use App\Pages;
use App\User;
use App\Userlinks;
use App\Userroles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function links(Request $request)
    {
        $share_id = $request->query('id');
        if(empty($share_id))
        {
            $links = DB::table('links')->orderByRaw('links.id DESC')->paginate(15);
        }else{
            $links = DB::table('links')->where('links.share_id', '=', $share_id)->orderByRaw('links.id DESC')->paginate(15);
        }

        return view('admin.links.index', ['links' => $links]);
    }

    public function links_stats($id)
    {
        $link = Links::where('share_id', $id)->first();
        $link_stats = Linkstats::where('links_id', $link->id)->paginate(15);
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

        $owners = DB::table('user_links')
            ->join('users', 'user_links.user_id', '=', 'users.id')
            ->select('users.id', 'users.name')
            ->where('user_links.links_id', '=', $link->id)
            ->get();

        return view('admin.links.stats', ['link' => $link, 'link_clicks' => $link_clicks, 'languages' => $languages, 'browsers' => $browsers, 'referers' => $referers, 'link_stats' => $link_stats, 'owners' => $owners]);
    }

    public function links_delete(Request $request,$id)
    {
        $link = Links::where('share_id', $id)->first();
        $userlinks = Userlinks::where('links_id', $link->id)->delete();
        $linkstats = Linkstats::where('links_id', $link->id)->delete();
        $link->delete();
        add_log(
            json_encode(
                [
                    'action' => 'admin_link_delete',
                    'user_id' => Auth::id(),
                    'link_id' => $id,
                    'ip' => $request->ip()
                ]
            )
        );
        return redirect('/admin/links');

    }

    public function  users(Request $request)
    {
        $email = $request->query('email');
        if(empty($email))
        {
            $users = DB::table('users')->orderByRaw('users.id DESC')->paginate(15);
        }else{
            $users = DB::table('users')->where('users.email', '=', $email)->orderByRaw('users.id DESC')->paginate(15);
        }

        return view('admin.users.index', ['users' => $users]);
    }

    public function  users_info($id)
    {
        $user = User::find($id);
        return view('admin.users.info', ['user' => $user]);
    }

    public function  users_edit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit', ['user' => $user]);
    }

    public function  users_edit_post(Request $request,$id)
    {

        $validator = $request->validate([
            'email' => 'required|email',
            'name' => 'required'
        ]);

        $email = $request->input('email');
        $name = $request->input('name');

        $user = User::find($id);
        $old_name = $user->name;
        $old_email = $user->email;
        $user->email = $email;
        $user->name = $name;
        $user->save();
        add_log(
            json_encode(
                [
                    'action' => 'admin_users_edit',
                    'user_id' => Auth::id(),
                    'ip' => $request->ip(),
                    'old_name' => $old_name,
                    'new_name' => $user->name,
                    'old_email' => $old_email,
                    'new_email' => $user->email
                ]
            )
        );
        return back()->with('success','Updated.');
    }

    public function  logs()
    {
        $logs = DB::table('logs')->orderByRaw('logs.id DESC')->paginate(15);
        return view('admin.logs.index', ['logs' => $logs]);
    }

    public function  pages()
    {
        $pages = DB::table('pages')->orderByRaw('pages.id DESC')->paginate(15);
        return view('admin.pages.index', ['pages' => $pages]);
    }

    public function pages_new()
    {
        return view('admin.pages.new');
    }

    public function pages_new_post(Request $request)
    {


        $validator = $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $title = $request->input('title');
        $content = $request->input('content');

        $page = new Pages();
        $page->title = $title;
        $page->title_sef = sef_link($title);
        $page->content = $content;
        $page->save();
        add_log(
            json_encode(
                [
                    'action' => 'admin_new_page',
                    'user_id' => Auth::id(),
                    'ip' => $request->ip(),
                ]
            )
        );
        return redirect()->route('pages')
            ->with('success','Created.');
    }

    public function pages_edit($id)
    {
        $page = Pages::find($id);
        return view('admin.pages.edit', ['page' => $page]);
    }

    public function pages_edit_post(Request $request,$id)
    {

        $validator = $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $title = $request->input('title');
        $content = $request->input('content');

        $page = Pages::find($id);
        $page->title = $title;
        $page->title_sef = sef_link($title);
        $page->content = $content;
        $page->save();
        add_log(
            json_encode(
                [
                    'action' => 'admin_edit_page',
                    'user_id' => Auth::id(),
                    'ip' => $request->ip(),
                ]
            )
        );
        return back()->with('success','Updated.');
    }

    public function pages_delete(Request $request,$id)
    {
        $page = Pages::find($id);
        $page->delete();
        add_log(
            json_encode(
                [
                    'action' => 'admin_delete_page',
                    'user_id' => Auth::id(),
                    'ip' => $request->ip(),
                    'page_title' => $page->title
                ]
            )
        );
        return redirect('/admin/pages');
    }

    public function dashboard()
    {
        $users = DB::table('users')->count();
        $links = DB::table('links')->count();
        $logs = DB::table('logs')->count();
        $link_stats = DB::table('link_stats')->count();
        return view('admin.dashboard.index', ['users' => $users, 'links' => $links, 'logs' => $logs, 'link_stats' => $link_stats]);
    }

    public function roles()
    {
        $roles = DB::table('user_roles')
            ->join('users', 'user_roles.user_id', '=', 'users.id')
            ->select('user_roles.id as role_id', 'users.id', 'users.name', 'users.email', 'user_roles.role_name', 'user_roles.created_at')
            ->paginate(15);

        return view('admin.users.roles', ['roles' => $roles]);
    }

    public function roles_add(Request $request)
    {
        $validator = $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->input('email');
        $user = User::where('email', $email)->first();

        if($user)
        {
            $user_role = Userroles::where('user_id', $user->id)->first();
            if($user_role)
            {
                return back()->with('error','Role already given.');
            }else{
                $role = new Userroles();
                $role->user_id = $user->id;
                $role->role_name = 'admin';
                $role->save();
                add_log(
                    json_encode(
                        [
                            'action' => 'role_add',
                            'user_id' => Auth::id(),
                            'role_user_id' => $user->id,
                            'ip' => $request->ip()
                        ]
                    )
                );
                return back()->with('success','Role was given.');
            }

        }else{
            return back()->with('error','User not found.');
        }
    }

    public function roles_delete(Request $request,$id)
    {
        $role = Userroles::find($id);
        if($role)
        {
            if($role->user_id == Auth::id())
            {
                return back()->with('error','You cannot cancel your role.');
            }else{
                $role->delete();
                add_log(
                    json_encode(
                        [
                            'action' => 'role_cancelled',
                            'user_id' => Auth::id(),
                            'role_user_id' => $role->id,
                            'ip' => $request->ip()
                        ]
                    )
                );
                return back()->with('success','The role has been revoked.');
            }

        }
    }
}
