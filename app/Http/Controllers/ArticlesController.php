<?php

namespace App\Http\Controllers;
use App\User;
use App\Role;
use Gate;
use Session;
use Illuminate\Http\Request;
use Auth;
use App\Article;
use App\Http\Requests\ArticleRequest;

class ArticlesController extends Controller
{
    private $admin;
    private $user;
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['create', 'edit']]);
        $this->middleware('admin', ['only' => ['superAdmin', 'make_admin', 'make_user']]);
        $this->admin = Role::where('name', 'admin')->first();
        $this->user = Role::where('name', 'user')->first();
    }

    public function index()
    {
    	$articles = Article::latest()->get();

    	return view('articles.index', compact('articles'));
    }

    public function show($id)
    {

    	$article = Article::findOrFail($id);

    	return view('articles.show', compact('article'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(ArticleRequest $request)
    {
        $article = new Article($request->all());

        Auth::user()->articles()->save($article);

        Session::flash('status', 'Created Article');

    	return redirect('articles');
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $user = Auth::user();
            if(Gate::denies('auth_user', $article)){
                Session::flash('status', 'Can\'t access this page');
                return redirect('articles');
            }

        return view('articles.edit', compact('article'));
    }

    public function update($id, ArticleRequest $request)
    {
        $article = Article::findOrFail($id);

        if(Gate::denies('auth_user', $article)){
            Session::flash('status', 'Can\'t access this page');
            return redirect('articles');
        }

        $article->update($request->all());

        Session::flash('status', 'Article Updated');

        return redirect('articles');
    }

    public function myarticles()
    {
        $user =  Auth::user();

        $myarticles = $user->articles()->latest()->get();

        return view('articles.myarticles', compact('myarticles'));
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        if(Gate::denies('auth_user', $article)){
            Session::flash('status', 'Can\'t access this page');
            return redirect('articles');
        }
        $article->delete();
        Session::flash('status', 'Deleted Article');
        return redirect('articles');


    }

    public function superAdmin()
    {
        $users = User::all();
        return view('articles.admin', compact('users'));
    }

    public function make_admin($id)
    {
        $id_user = User::findOrFail($id);

        if(Gate::allows('auth_idSuper', $id_user))
        {
            Session::flash('status', 'Can\'t change role of super admin');
            return redirect('users');
        }

        if(Gate::allows('auth_id', $id_user))
        {
            Session::flash('status', 'Already an Admin');
            return redirect('users');
        }
        
        $id_user->roles()->detach($this->user); //detach user

        $id_user->roles()->attach($this->admin); //attach admin

        return redirect('users');
    }


    public function make_user($id)
    {
        $id_user = User::findOrFail($id);

        if(Gate::allows('auth_idSuper', $id_user))
        {
            Session::flash('status', 'Can\'t change the role of super admin');
            return redirect('users');
        }

        if(Gate::allows('auth_id', $id_user))
        {
            $id_user->roles()->detach($this->admin); //detach admin

            $id_user->roles()->attach($this->user); //attach user

            return redirect('users');
        }
        Session::flash('status', 'Already a user');
        return redirect('articles');
    }
}
