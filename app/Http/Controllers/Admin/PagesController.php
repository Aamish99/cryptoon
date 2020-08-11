<?php

namespace App\Http\Controllers\Admin;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class PagesController extends Controller
{

    public function __construct()
    {
        $this->middleware('demo', ['only' => ['store', 'update']]);
    }

    /*
    * Get list of all pages
    ***********************/
    public function index(){
        $pages = Page::orderBy('created_at', 'desc')->get();
        return view('admin.pages.index', compact('pages'));
    }

    /*
    * Create new page
    ***********************/
    public function create(){
        return view('admin.pages.create');
    }

    /*
    * Update existing page
    ***********************/
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'max:155'],
            'slug' => ['required', 'alpha_dash', 'max:155', 'unique:pages'],
            'placement' => ['required'],
            'meta_description' => ['nullable','max:155'],
            'description' => ['required'],
        ]);

        $page = new Page();
        $page->title = $request->title;
        $page->slug = $request->slug;
        $page->placement = $request->placement;
        if ($request->hasFile('image')){
            $file      = $request->image;
            $extention = $file->getClientOriginalExtension();
            $filename  = time().'-page.'.$extention;
            $file->move('uploads', $filename);
            $page->image = $filename;
        }
        $page->description = $request->description;
        $page->meta_description = $request->meta_description;
        $page->save();
        return redirect('admin/pages')->withStatus(__('lang.page_added_successfully'));
    }

    /*
    * Edit a page
    ***********************/
    public function edit($id)
    {
        $page = Page::find($id);
        if(isset($page))
            return view('admin.pages.edit', compact('page'));
        else
            return redirect('admin/pages')->withErrors(__('lang.page_not_found'));
    }

    /*
    * Update page
    ***********************/
    public function update(Request $request, $id){
        $this->validate($request, [
            'title' => ['required', 'max:155'],
            'slug' => 'required|alpha_dash|max:155|unique:pages,slug,'.$id,
            'placement' => ['required'],
            'meta_description' => ['nullable','max:155'],
            'description' => ['required'],
        ]);
        $page = Page::find($id);
        if(isset($page)) {
            $page->title = $request->title;
            $page->slug = $request->slug;
            $page->placement = $request->placement;
            if ($request->hasFile('image')) {
                File::delete('uploads/' . $page->image);
                $file = $request->image;
                $extention = $file->getClientOriginalExtension();
                $filename = time() . '-blog.' . $extention;
                $file->move('uploads', $filename);
                $page->image = $filename;
            }
            $page->description = $request->description;
            $page->meta_description = $request->meta_description;
            $page->save();
            return redirect('admin/pages')->withStatus(__('lang.page_updated_successfully'));
        }
        return redirect('admin/pages')->withError('Page not found');
    }

    /*
    * Delete page
    ***********************/
    public function destroy(Request $request)
    {
       /* foreach ($request->id as $item){
            $page =  Page::find($item);
            if($page)
                $page->delete();
        }
        return __('lang.page_delete_success');*/
       return 'demo';
    }
}
