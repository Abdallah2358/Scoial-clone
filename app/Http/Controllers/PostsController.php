<?php

namespace App\Http\Controllers;
use \Ds\Set;
use App\Comments;
use App\Likes;
use App\Posts;
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
    protected $user = null;
    protected $postsArray = [];
    public function setUser($user)
    {
        $this->user = $user;
    }
    public function getUser()
    {
        return $this->user;
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
        $this->user = null;
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
            DB::insert("call createPost	('" . $request->input('post') . "' , '" . $user . "')");
            $postsArray = $this->userPosts($user);
            return \view('posts', ['posts' => $postsArray, 'postNo' => 0, 'user' => $user]);
        }
        return \view('createPost', ['back' => "/posts/create/$user"]);

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
        if (DB::select("call `login`('" . $username . "', '" . $pass . "' )")) {

            $id = DB::select("call `login`('" . $username . "','" . $pass . "' )")[0]->id;
            $this->setUser($id);

            $postsArray = $this->userPosts($id);

            return \view('posts', ['posts' => $postsArray, 'postNo' => 0, 'user' => $this->user]);

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
    public function edit($id)
    {
        $post = DB::select("call selectPostById('" . $id . "')")[0];
        return \view('editPost', ['content' => $post->comment, 'user' => $post->user_id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = $request->input('user');
        if ($request->input('post')) {
            DB::insert("call updatePost	('" . $request->input('post') . "' , '" . $id . "')");
            $postsArray = $this->userPosts($user);
            return \view('posts', ['posts' => $postsArray, 'postNo' => 0, 'user' => $user]);
        }
        $post = DB::select("call selectPostById('" . $id . "')")[0];
        return \view('editPost', ['back' => "/posts/edit/$id", 'content' => $post->comment, 'user' => $post->user_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::statement("call delete_post('" . $id . "')");
        return \view('login');

    }

    public function userPosts($user)
    {
        $posts = DB::select("call userPosts('" . $user . "')");
        $postsArray = [];
        foreach ($posts as $post) {
            $postToBePushed = new PostClass();
            $postToBePushed->set_post($post);
            $postId = $post->id;
            $likes = DB::select("call userPostLikes('" . $postId . "')");
            $postToBePushed->set_likes($likes);
            $comments = DB::select("call userPostComments ('" . $postId . "')");
            $postToBePushed->set_comments($comments);
            array_push($postsArray, $postToBePushed);
        }
        return $postsArray;
    }

    public function like_delete($id)
    {
        $user = DB::select("call likeById('" . $id . "')")[0]->user_id;
        DB::statement("call delete_like('" . $id . "')");
        $postsArray = $this->userPosts($user);
        return \view('posts', ['posts' => $postsArray, 'postNo' => 0, 'user' => $user]);

    }
    public function like($post)
    {
        $user = DB::select("call selectPostById ('" . $post . "')")[0]->user_id;
        DB::insert("call addLike ('" . $user . "','" . $post . "')");
        $postsArray = $this->userPosts($user);
        return \view('posts', ['posts' => $postsArray, 'postNo' => 0, 'user' => $user]);
    }
    public function comment(Request $request)
    {
        if (!$request->input('comment')) {
            return \view('createComment', ['post' => $request->input('post'), 'user' => $request->input('user')]);
        } else {
            DB::insert("call createComment('" . $request->input('user') . "','" . $request->input('post') . "','" . $request->input('comment') . "')");
            $postsArray = $this->userPosts($request->input('user'));
            return \view('posts', ['posts' => $postsArray, 'postNo' => 0, 'user' => $request->input('user')]);

        }
    }
    public function edit_comment($id)
    {
        $comment = DB::select("call commentById('" . $id . "')")[0];
        return \view('editComment', ['id' => $comment->id, 'comment' => $comment->content]);
    }

    public function update_comment(Request $request, $id)
    {
        $comment = DB::select("call commentById('" . $id . "')")[0];

        if ($request['comment']) {
            DB::insert("call updateComment('" . $id . "','" . $request['comment'] . "')");
            $postsArray = $this->userPosts($comment->user_id);
            return \view('posts', ['posts' => $postsArray, 'postNo' => 0, 'user' => $comment->user_id]);

        }
        return \view('editComment', ['id' => $comment->id, 'comment' => $comment->content]);
    }

    public function delete_comment($id)
    {
        $user = DB::select("call commentById('" . $id . "')")[0]->user_id;
        DB::statement("call delete_comment('" . $id . "')");
        $postsArray = $this->userPosts($user);
        return \view('posts', ['posts' => $postsArray, 'postNo' => 0, 'user' => $user]);
    }

   
    //likes 
    public function likess($id)
    {
        $set_of_friends = new \Ds\Set();
        $postsArray = $this->userPosts($id);

    }
}
