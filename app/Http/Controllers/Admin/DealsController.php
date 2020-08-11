<?php

namespace App\Http\Controllers\Admin;

use App\Models\Deal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DealsController extends Controller
{
    public function __construct()
    {
        $this->middleware('demo', ['only' => ['store', 'update']]);
    }
    public function index(){

        $deals = Deal::all();
        return view('admin.deals.index', compact('deals'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'title' => ['required', 'max:155'],
            'image' => ['required'],
            'link' => ['required'],
            'description' => ['nullable','max:255'],
        ]);

        $deal = new Deal();
        $deal->title = $request->title;
        if ($request->hasFile('image')){
            $file      = $request->image;
            $extention = $file->getClientOriginalExtension();
            $filename  = time().'-deal.'.$extention;
            $file->move('uploads', $filename);
            $deal->image = $filename;
        }
        $deal->description = $request->description;
        $deal->link = $request->link;
        $deal->save();

        return redirect('admin/deals')->withStatus('Deal added successfully!');
    }

    public function edit($id){
        $deal = Deal::find($id);
        return  view('admin.deals.edit_request',compact('deal'));
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'title' => ['required', 'max:155'],
            'link' => ['required'],
            'description' => ['nullable','max:255'],
        ]);
        $deal = Deal::find($id);
        $deal->title = $request->title;
        if ($request->hasFile('image')){
            $file      = $request->image;
            $extention = $file->getClientOriginalExtension();
            $filename  = time().'-deal.'.$extention;
            $file->move('uploads', $filename);
            $deal->image = $filename;
        }
        $deal->description = $request->description;
        $deal->link = $request->link;
        $deal->save();
        return redirect('admin/deals')->withStatus('Deal updated successfully!');

    }

    public function remove(Request $request){
        /*foreach ($request->id as $item){
            $coin =  Deal::find($item);
            if($coin)
                $coin->delete();
        }
        return __('lang.deal_delete_alert');*/
        return 'demo';
    }

}
