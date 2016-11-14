<?php

namespace App\Http\Controllers;
use App\User;
use Gate;
use Session;
use Illuminate\Http\Request;
use Auth;
use App\Article;
use App\Http\Requests\ArticleRequest;

class ArticlesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['create', 'edit']]);
        $this->middleware('admin', ['only' => ['admin', 'make_admin', 'make_user']]);
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
                if(Gate::denies('auth_admin', $article)){
                    abort(403, 'Sorry, Can\'t access.');
                }
            }

            return view('articles.edit', compact('article'));
    }

    public function update($id, ArticleRequest $request)
    {
        $article = Article::findOrFail($id);

        if(Gate::denies('auth_user', $article)){
            if(Gate::denies('auth_admin', $article)){
                    abort(403, 'Sorry, Can\'t access.');
            }
        }

        $article->update($request->all());

        Session::flash('status', 'Article Updated');

        return redirect('articles');
    }

    public function myarticles()
    {
        $user =  Auth::user();

        $myarticles = $user->articles()->latest()->get();

        if ($user->isSuperAdmin()) {
            return redirect('articles/superAdmin');
        }

        return view('articles.myarticles', compact('myarticles'));
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        if(Gate::denies('auth_user', $article)){
            if(Gate::denies('auth_admin', $article)){
                    abort(403, 'Sorry, Can\'t access.');
            }
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

        if($id_user->isIdAdmin($id_user))
        {

            return 'already an admin';

        }
        
        $id_user->roles()->detach(3);

        $id_user->roles()->attach(2);

        return redirect('articles/admin');
    }

    public function make_user($id)
    {
        $id_user = User::findOrFail($id);

        if($id_user->isIdAdmin($id_user))
        {
            $id_user->roles()->detach(2);

            $id_user->roles()->attach(3);

            return redirect('articles/admin');
        }
        return 'already a user';
        


        
    }
}
