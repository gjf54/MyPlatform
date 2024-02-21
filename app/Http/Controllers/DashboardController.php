<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Product;
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

        if($post == null) {
            return abort(404);
        }

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

        if($post == null) {
            return abort(404);
        }

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

        $user = auth()->user();

        return view('dashboard.users.main_page', [
            'super_admins' => $super_admins,
            'admins' => $admins,
            'managers' => $managers,
            'writers' => $writers,
            'user' => $user,
        ]);
    }

    public function remove_role_from_user($id, $role) {
        $selected_user = User::where(['id' => $id,])->first();
        $selected_role = Role::where(['name'] => $role)->first();
        $user = User::where(['id' => auth()->user()->id])->first();

		if($selected_role == null) {
			return back()->withErrors([	
				'message' => 'Role "' . $role . '" does not exist';
			]);
		}

        if($selected_user->hasRole('super_admin')) {
            return back()->withErrors([
                'message' => 'You can not remove super-admin role!'
            ]);
        }

        if($selected_user->can('control_user') and !($user->hasRole('super_admin'))) {
            return back()->withErrors([
                'message' => 'You can not remove other admin!'
            ]);
        }

        $selected_user->removeRole($role);
        $selected_user->save();

        return back()->with([
            'message' => 'User role success removed!'
        ]);
    }

    public function generate_user_role_form($role) {
    	$selected_role = Role::where(['name' => $role])->first();
    
    	if($selected_roles == null) {
    		return back()->withErrors([
				'message' => 'Role "' . $role . '" does not exist',
			]);	
    	}
    
        if($role == 'super_admin') {
            abort(404);
        }

        $user = User::where(['login' => auth()->user()->login])->first();

        if($user->hasRole('admin') and !($user->hasRole('super_admin')) and $role == 'admin') {
            return back()->withErrors([
                'message' => 'You can not add admins!',
            ]);
        }

        return view('dashboard.users.add_role_to_user_form', [
            'role' => $role,
        ]);
    }

    public function get_all_logins() {
        $logins = User::all()->pluck('login')->toArray();

        return response()->json($logins);
    }

    public function get_user_role(Request $request, $role) {
        $validator = Validator::make($request->all(), [
            'login' => 'required',
        ]);
        $validator->validate();

        $user = User::where(['login' => auth()->user()->login])->first();
        $selected_user = User::where(['login' => $request->login])->first();
        $selected_role = Role::where(['name' => $role])->first();
        
        if($selected_role == null) {
			return back()->withErrors([	
				'message' => 'Role "' . $role . '" does not exist';
			]);
		}

        if($selected_user->hasRole('super_admin')){
            return back()->withErrors([
                'message' => 'You can not grant role to super-admin!',
            ]);
        }

        if($selected_user == null) {
            return back()->withErrors([
                'message' => 'User does not exist!',
            ]);
        }

        if($role == 'super_admin') {
            return back()->withErrors([
                'message' => 'You can not add super-admin!',
            ]);
        }

        if($role == 'admin' and !($user->hasRole('super_admin'))) {
            return back()->withErrors([
                'message' => 'You can not add admin!',
            ]);
        }

        $selected_user->assignRole($role);
        $selected_user->save();

        return back()->with('message', 'Role successfull granted!');
    }

    public function generate_catalog_home_page() {
        $categories = Category::all();

        $max_lenght = 20;
        foreach ($categories as $category) {
            $name = $category->name;
            if(mb_strlen($name) > $max_lenght) {
                $name = mb_substr($name, 0, $max_lenght - 3) . '...';
                $category->name = $name;
            }
        }

        return view('dashboard.catalog.categories_list', [
            'categories' => $categories,
        ]);
    }

    public function generate_categories_create_form() {
        return view('dashboard.catalog.category_form', [
            'status' => 'create',
        ]);
    }

    public function insert_created_category(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories',
        ]);
        $validator->validate();

        Category::create($validator->validated());

        return back()->with('message', 'Category successfull created!');
    }

    public function generate_categories_edit_form($id) {
        $category = Category::where(['id' => $id])->first();

        return view('dashboard.catalog.category_form', [
            'category' => $category,
            'status' => 'edit',
        ]);
    }

    public function insert_edited_category($id, Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        $validator->validate();

        $category = Category::where(['id' => $id])->first();
        
        $category->name = $request->name;
        $category->save();

        return back()->with('message', 'Category successfull updated!');
    }

    public function delete_category($id) {
        $category = Category::where(['id' => $id])->first();
        $category->delete();

        return back()->with('message', 'Category successfull deleted!');
    }

    public function generate_category_contains($id) {
        $category = Category::where(['id' => $id])->first();

        $products = Product::where(['id_parent_category' => $category->id])->get();
        
        return view('dashboard.catalog.products_list', [
            'products' => $products,
            'category' => $category,
        ]);
    }

    public function generate_products_create_form() {

        return view('dashboard.catalog.products_form', [
            'status' => 'create',
        ]);
    }

    public function dashboard_send_created_product(Request $request, $id) {
        
    }
}
