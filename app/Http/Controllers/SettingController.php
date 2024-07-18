<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Tables\SettingsIndexTable;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settingsTable = (new SettingsIndexTable)->create();

        return view('pages.settings.index', [
            'settingsTable' => $settingsTable,
        ]);
    }

    public function create()
    {
        return view('pages.settings.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'value' => 'required',
            'type' => 'required',
        ]);

        Setting::create($validated);

        return redirect()->route('settings.index')->with('success', __('Setting successfully created'));
    }

    public function edit(Setting $setting)
    {
        return view('pages.settings.edit', [
            'setting' => $setting,
        ]);
    }

    public function update(Setting $setting, Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'value' => 'required',
            'type' => 'required',
        ]);

        $setting->update($validated);

        return redirect()->route('settings.index')->with('success', __('Setting successfully updated'));
    }

    public function set(Setting $setting, Request $request)
    {
        if($setting->type == 'checkbox'){
            $value = isset($request->value);
            $setting->update(['value' => $value]);
        }else{
            $setting->update($request->only('value'));
        }

        return redirect()->route('settings.index');
    }

    public function destroy(Setting $setting)
    {
        $setting->delete();

        return redirect()->route('settings.index')->with('success', __('Setting successfully deleted'));
    }

    public function ajaxSearch(Request $request)
    {
        return response()->json((new SettingsIndexTable)->ajaxSearch($request));
    }
}
