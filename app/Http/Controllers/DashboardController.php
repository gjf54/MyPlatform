<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function generate_home_page() {
        $user = auth()->user();

        return view('dashboard.home', [
            'user' => $user,
        ]);
    }

    public function generate_writer_page() {
        $posts = Post::all();

        return view('dashboard.posts.main_list', [
            'posts' => $posts,
        ]);
    }

    public function generate_create_form_of_post() {
        return view('dashboard.posts.post_form', [
            'status' => 'create',
        ]);
    }

    public function add_writers_post(Request $request, Post $post) {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:100',
            'text' => 'required|max:4000',
        ]);
        $validator->validate();

        $user = auth()->user();
        
        $post->id_creator = $user->id;
        $post->title = $request->title;
        $post->text = $request->text;
        $post->id_editor = $user->id;

        $post->save();

        return back()->with('message', 'Post created successfull!');
    }

    public function generate_edit_form_of_post($id) {
        $post = Post::where(['id' => $id])->first();
        return view('dashboard.posts.post_form', [
            'post' => $post,
            'status' => 'edit',
        ]);
    }

    public function edit_writers_post($id, Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:100',
            'text' => 'required|max:4000',
        ]);
        $validator->validate();

        $post = Post::where(['id' => $id])->first();

        $post->title = $request->title;
        $post->text = $request->text;
        $post->id_editor = auth()->user()->id;
        $post->is_edited = 1;
        $post->save();

        return back()->with('message', 'Post edited successfull!');
    }

    public function delete_writers_post($id) {
        $post = Post::where(['id' => $id])->first();
        $post->delete();
        return back();
    }

    public function get_creator_of_post($id) {
        $user = User::where(['id' => $id])->first();

        return response([
            'login' => $user->login,
        ]);
    }

    public function generate_users_page() {
        $super_admins = User::role('super_admin')->get();
        $admins = User::role('admin')->get();
        $managers = User::role('manager')->get();
        $writers = User::role('writer')->get();

        return view('dashboard.users.main_page', [
            'super_admins' => $super_admins,
            'admins' => $admins,
            'managers' => $managers,
            'writers' => $writers,
        ]);
    }
}
