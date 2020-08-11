<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{

    public function __construct()
    {
        $this->middleware('demo', ['only' => ['store', 'update']]);
    }
    /*
    * Get list of all blog posts
    ***********************/
    public function index(){
        $blog = Blog::orderBy('created_at', 'desc')->get();
        return view('admin.blog.index', compact('blog'));
    }

    /*
    * Create new blog posts
    ***********************/
    public function create(){
        return view('admin.blog.create');
    }

    /*
    * Add new blog posts
    ***********************/
    public function store(Request $request){

        $this->validate($request, [
            'title' => ['required', 'max:155'],
            'slug' => ['required', 'alpha_dash', 'max:155', 'unique:blogs'],
            'meta_description' => ['nullable','max:155'],
        ]);

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->slug = $request->slug;
        if ($request->hasFile('image')) {
            $file = $request->image;
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '-blog.' . $extention;
            $file->move('uploads', $filename);
            $blog->image = $filename;
        }
        $blog->description = $request->description;
        $blog->meta_description = $request->meta_description;
        $blog->save();
        return redirect('admin/blog')->withStatus(__('lang.blog_added_successfully'));

    }

    /*
    * Create new blog posts
    ***********************/
    public function edit($id)
    {
        $blog1 = Blog::find($id);
        if(isset($blog1)){
            return view('admin.blog.edit')->with(['blog1' => $blog1]);
        }

        return redirect('admin/blog')->withErrors(__('lang.blog_not_found'));
    }

    /*
    * Update blog post
    ***********************/
    public function update(Request $request, $id){
        $this->validate($request, [
            'title' => ['required', 'max:155'],
            'slug' => 'required|alpha_dash|max:155|unique:blogs,slug,'.$id,
            'meta_description' => ['nullable','max:155'],
        ]);
        $blog = Blog::find($id);
        if(isset($blog)){
            $blog->title = $request->title;
            $blog->slug = $request->slug;
            if ($request->hasFile('image')){
                File::delete('uploads/'.$blog->image);
                $file      = $request->image;
                $extention = $file->getClientOriginalExtension();
                $filename  = time().'-blog.'.$extention;
                $file->move('uploads', $filename);
                $blog->image = $filename;
            }
            $blog->description = $request->description;
            $blog->meta_description = $request->meta_description;
            $blog->save();
            return redirect('admin/blog')->withStatus('blog_updated_successfully');
        }
        return redirect('admin/blog')->withErrors(__('lang.blog_not_found'));
    }

    /*
    * Delete blog post
    ***********************/
    public function destroy(Request $request)
    {
        /*foreach ($request->id as $item){
            $blog =  Blog::find($item);
            if($blog)
                $blog->delete();
        }
        return __('lang.blog_delete_success');*/

        return 'demo';
    }
}
