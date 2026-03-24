<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admindashboard\SettingRequest;
use App\Models\Setting;
use App\utlis\ImagesManger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminSettingsController extends Controller
{
    public function index()
    {
        return view('dashbord.adminauth.settings.update');
    }
    public function update(SettingRequest $request)
    {
        try {
            DB::beginTransaction();
            $settings = Setting::findOrFail($request->setting_id);
            $updates = $settings->update($request->except(['_token', 'setting_id', 'logo', 'favicon']));
            if ($request->hasFile('logo')) {
                $this->updatelogofile($settings, $request);
            }
            if ($request->hasFile('favicon')) {
                $this->updatefaviconfile($settings,$request);
            }
            DB::commit();
            if (!$updates) {
                Session::flash('error', "Please Try again !");
                return redirect()->back();
            }
            Session::flash('success', "Settings Updated Successfuly !");
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(['errors' => $th->getMessage()]);
        }
    }

    private function updatelogofile($settings, $request)
    {
        ImagesManger::checkFileAndDelete($settings->logo);
        $filename = ImagesManger::generateImageName($request->logo);
        $logopath = ImagesManger::storeImageInLocal($request->logo, 'settings', $filename);
        $settings->update([
            'logo' => $logopath,
        ]);
    }
    private function updatefaviconfile($settings, $request)
    {
        ImagesManger::checkFileAndDelete($settings->favicon);
        $filename = ImagesManger::generateImageName($request->favicon);
        $faviconpath = ImagesManger::storeImageInLocal($request->favicon, 'settings', $filename);
        $settings->update([
            'favicon' => $faviconpath,
        ]);
    }
}
