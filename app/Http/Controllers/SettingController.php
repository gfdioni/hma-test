<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    public function index()
    {
        return view('dashboard.setting');
    }

    public function update(Request $request)
    {
        foreach($request->all() as $k => $v)
        {
            if($request->hasFile($k))
            {

                $file = $request->file($k);
                $path = $file->store('uploads', 'public');

                $v = $path;
            }

            Setting::updateOrCreate(['key'=> $k],['value'=>$v]);
        }
        Cache::forget("assets");

        return redirect()->route('setting-index');
    }
}
