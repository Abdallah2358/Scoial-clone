<?php

namespace App\Http\Controllers;

use App\Comments;
use App\Likes;
use App\Posts;
use App\Users;
use DB;
use Illuminate\Http\Request;

class PostClass
{
   
    // Properties
    public $post;
    public $likes;
    public $comments;
    // Methods
    public function set_post($post)
    {
        $this->post = $post;
    }
    public function get_post()
    {
        return $this->post;
    }

    public function set_likes($likes)
    {
        $this->likes = $likes;
    }
    public function get_likes()
    {
        return $this->likes;
    }

    public function set_comments($comments)
    {
        $this->comments = $comments;
    }
    public function get_comments()
    {
        return $this->comments;
    }
}
class PostsController extends Controller
{
    protected  $user = null;
    protected $postsArray = [];
    public function setUser(  $user)
   {
       $this->user=$user;
   }
   public function getUser()
   {
      return  $this->user;
   }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('login');
    }
    public function logout()
    {
        $this->user =null;
        return view('login');
    }
    public function index()
    {
        //

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('createPost');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $user)
    { 
        if ($request->input('post')) {
           DB::insert("call createPost	('".$request->input('post')."' , '".$user."')");





           $posts = DB::select( "call userPosts('".$user."')" );
           $postsArray = [];
           foreach ($posts as $post) {
               $postToBePushed = new PostClass();
               $postToBePushed->set_post($post);
               $postId = $post->id;

               $likes = DB::select( "call userPostLikes('".$postId."')" )[0]->count;
              
               $postToBePushed->set_likes($likes);
               $comments = DB::select( "call userPostComments ('".$postId."')" );
               $postToBePushed->set_comments($comments);
               array_push($postsArray, $postToBePushed);
           }
           return \view('posts', ['posts' => $postsArray , 'postNo'=>0 , 'user'=>$user]);
        }
        return \view('createPost' , ['back'=>"/posts/create/$user" ]  );
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

        //
    
        $username = $request->input('user');
        $pass = $request->input('password');
        //    \dd( $username .'   '. $pass);
        if ( DB::select( "call `login`('".$username."', '".$pass."' )") ) {
            
            $id = DB::select( "call `login`('".$username."','".$pass."' )")[0]->id;
            $this-> setUser($id); 
            $posts = DB::select( "call userPosts('".$id."')" );
            $postsArray = [];
            foreach ($posts as $post) {
                $postToBePushed = new PostClass();
                $postToBePushed->set_post($post);
                $postId = $post->id;

                $likes = DB::select( "call userPostLikes('".$postId."')" )[0]->count;
               
                $postToBePushed->set_likes($likes);
                $comments = DB::select( "call userPostComments ('".$postId."')" );
                $postToBePushed->set_comments($comments);
                array_push($postsArray, $postToBePushed);
            }
        

            return \view('posts', ['posts' => $postsArray , 'postNo'=>0 ,'user'=>$this->user]);

        } else {
            return \view('login', ['auth' => 'failed']);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function edit(Posts $posts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Posts $posts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Posts $posts)
    {
        //
    }
}
