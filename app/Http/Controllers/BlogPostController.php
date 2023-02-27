<?php
namespace App\Http\Controllers;
use App\Models\BlogPost;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class BlogPostController extends Controller
{




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = BlogPost::select()
        ->paginate(10);
        // $blogs = BlogPost::all();
        //return $blogs[0]->title;
        return view('blog.index', ['blogs' => $blogs]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = new Category;
        $category = $category->selectCategory();
        return view('blog.create', ['categories' => $category]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'categories_id' => 'required',
        ]);
        //insert -> lastid  => select where lastId
        $newPost = BlogPost::create([
            'title' => $request->title,
            'title_fr' => $request->title_fr,
            'body'  => $request->body,
            'body_fr'  => $request->body_fr,
            'user_id' => Auth::user()->id,
            'categories_id'  => $request->categories_id
        ]);
        return redirect(route('blog.show', $newPost->id));
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function show(BlogPost $blogPost)
    {
        $userId = Auth::user()->id; // chercher le id de l'user
        return view('blog.show', ['blogPost' => $blogPost], ['userId' => $userId]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function edit(BlogPost $blogPost)
    {
        $userId = Auth::user()->id; // chercher le id de l'user
        $blogId = $blogPost->user_id;
        if($userId == $blogId) {
            $category = Category::select()->orderby('categorie')->get();
            $category = new Category;
            $category = $category->selectCategory();
            return view('blog.edit', ['blogPost' => $blogPost], ['categories' => $category]);
        } else {
            $blogs = BlogPost::all();
            return view('blog.index', ['blogs' => $blogs]);
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BlogPost $blogPost)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'categories_id' => 'required',
        ]);
        //update where blogPost->id  => select where blogPost->id
        $blogPost->update([
            'title' => $request->title,
            'title_fr' => $request->title_fr,
            'body' => $request->body,
            'body_fr' => $request->body_fr,
            'categories_id'  => $request->categories_id
        ]);
        return redirect(route('blog.show', $blogPost->id));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(BlogPost $blogPost)
    {
        $blogPost->delete();
        return redirect(route('blog.index'));
    }
}
