<?php
namespace App\Http\Controllers;
use App\Models\BlogPost;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PDF;
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
    public function query()
    {
        // select * FROM blog_posts;
        //  $query = BlogPost::all();
        // $query = BlogPost::select()->get(); 
        //$query = BlogPost::select('title', 'body')->get(); 
        //WHERE
        /*$query = BlogPost::select()
                ->where('id', '=',1)
                ->get();
        return $query[0]->title;
        */
        // WHERE PK
        //SELECT  * from blog_posts where id = ?;
        //$query = BlogPost::find(1);
        //return $query->title;
        //AND
        //SELECT  * from blog_posts where user_id = ? AND title = ?;
        $query = BlogPost::Select()
            ->where('user_id', '=', 1)
            ->where('title', '=', 'Title 1')
            ->get();
        //OR
        //SELECT  * from blog_posts where user_id = ? OR title = ?;
        $query = BlogPost::Select()
            ->where('user_id', '=', 2)
            ->orWhere('title', '=', 'Title 1')
            ->get();
        //ORDER BY
        //SELECT  * from blog_posts ORDER BY title;
        $query = BlogPost::Select()
            //->where("user_id", ">", 2)
            ->orderBy('title', 'desc')
            ->get();
        //INNER
        //SELECT * FROM blog_posts INNER JOIN users ON user_id = users.id;
        $query = BlogPost::select()
            ->join('users', 'users.id', '=', 'user_id')
            ->get();
        //OUTER
        //SELECT * FROM blog_posts RIGHT OUTER JOIN users ON user_id = users.id;
        $query = BlogPost::select()
            ->rightjoin('users', 'users.id', '=', 'user_id')
            ->get();
        //aggregation
        //$query = BlogPost::max('id');
        $query = BlogPost::select()
            ->count();
        // Raw Query
        // SELECT count(*) as blogs, user_id  * FROM blog_posts group by user_id;
        $query = BlogPost::select(DB::raw('count(*) as blogs, user_id '))
            ->groupBy('user_id')
            ->get();
        return $query;
    }
}
