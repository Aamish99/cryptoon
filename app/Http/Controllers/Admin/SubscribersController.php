<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Response;

class SubscribersController extends Controller
{
    /*
    * Get all subscribers
    ***********************/
    public function index()
    {
        $subscribers = Subscriber::all();
        return view('admin.subscribers.index', compact('subscribers'));
    }

    /*
    * Delete subscribers
    ***********************/
    public function destroy(Request $request)
    {
        /*foreach ($request->id as $item){
            $subscriber =  Subscriber::find($item);
            if(isset($subscriber))
                $subscriber->delete();
        }
        return __('lang.subscriber_delete_success');*/
        return 'demo';
    }

    /*
    * Export all subscribers as CSV
    ***********************/
    public function export_csv()
    {
        $subscribers = Subscriber::all();
        if(!($subscribers->isEmpty())) {
            $filename = "subscribers.csv";
            $handle = fopen($filename, 'w+');
            fputcsv($handle, array('email'));
            foreach ($subscribers as $item) {
                fputcsv($handle, array($item->email));
            }
            fclose($handle);
            $headers = array(
                'Content-Type' => 'text/csv',
            );
            return Response::download($filename, $filename, $headers);
        }
        return redirect('admin/subscribers')->withErrors(__('lang.no_subscriber_found'));
    }
}
