<?php

namespace App\Http\Controllers\Setting;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateSettingRequest;
use App\Traits\UploadImageTrait;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    use UploadImageTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::select()->latest()->first();
        return view('pages.settings',compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSettingRequest $request)
    {
        try {
            $setting = Setting::select()->find(1);

            if(! $setting){

                $logo_path = $this->uploadImage($request, 'logo' , 'Logo' );
                $favicon_path = $this->uploadImage($request, 'favicon' , 'Logo');

                Setting::create($request->all());

            }
            else {

                $oldLogo =  $setting->logo != null ? $setting->logo : '';
                $logo_path = $this->uploadImage($request, 'logo' , 'Logo', $oldLogo );

                $oldFavicon =  $setting->favicon != null ? $setting->favicon : '';
                $favicon_path = $this->uploadImage($request, 'favicon' , 'Logo', $oldFavicon );

                $requestData = $request->all();
                $requestData['logo'] = $logo_path;
                $requestData['favicon'] = $favicon_path;

                $setting->update($requestData);

            }

            session()->flash('Update','تم التعديل بنجاح');
            return redirect()->route('settings');

        } catch (\Exception $ex) {
            session()->flash('error','هناك خطأ ما يرجي المحاولة مرة أخري');
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
