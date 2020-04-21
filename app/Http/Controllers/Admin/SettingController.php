<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $settings = [];

        $dbSettings = Setting::get();

        foreach ($dbSettings as $s) {
            $settings[$s['name']] = $s['content'];
        }

        return view('admin.settings.index', compact('settings'));
    }

    public function save(Request $request)
    {
        $data = $request->only([
            'title', 'subtitle', 'email', 'bgcolor', 'textcolor'
        ]);
        $validator = $this->validator($data);

        if ($validator->fails()) {
            return redirect()->route('settings')
                ->withErrors($validator);
        }

        foreach ($data as $key => $value) {
            Setting::where('name', $key)->update(['content' => $value]);
        }

        return redirect()->route('settings')
            ->with('warning', 'Informações alteradas com sucesso');
    }

    private function validator($data) {
        return Validator::make($data, [
            'title' => ['string', 'max:100'],
            'subtitle' => ['string', 'max:100'],
            'email' => ['string', 'email'],
            'bgcolor' => ['string', 'regex:/#[A-Z0-9]{6}/i'],
            'textcolor' => ['string', 'regex:/#[A-Z0-9]{6}/i'],
        ]);
    }
}
