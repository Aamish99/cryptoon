<?php

namespace App\Http\Controllers\Admin;

use App\Models\Alert;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AlertsController extends Controller
{
    /*
    * Get list of all alerts
    ***********************/
    public function index(){
        $alerts = Alert::orderBy('id', 'desc')->get();
        return view('admin.alerts.index', compact('alerts'));
    }

    /*
    * Delete a alerts
    ***********************/
    public function destroy(Request $request)
    {
        /*foreach ($request->id as $item){
            $alert =  Alert::find($item);
            if($alert)
                $alert->delete();
        }
        return __('lang.alert_deleted_successfully');*/
        return 'demo';
    }
}
