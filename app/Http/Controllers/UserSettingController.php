<?php

namespace App\Http\Controllers;

use App\Models\UserSetting;
use App\Http\Resources\UserSettingResource;
use App\Http\Requests\StoreUserSettingRequest;
use App\Http\Requests\UpdateUserSettingRequest;
use Illuminate\Routing\Controllers\HasMiddleware;

class UserSettingController extends Controller implements HasMiddleware
{

    public static function middleware()
    {
        return [
            'auth:sanctum'
        ];
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->response(UserSettingResource::collection(auth()->user()->settings));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserSettingRequest $request)
    {
        if(auth()->user()->settings()->where('setting_id', $request->setting_id)->exists()){
            return $this->error('this setting already exists');
        }
        
        $userSetting = auth()->user()->settings()->create([
            'setting_id' => $request->setting_id,
            'value_id' => $request->value_id ?? null,
            'switch' => $request->switch ?? null,
        ]);

        return $this->success('user setting created', $userSetting);
    }

    /**
     * Display the specified resource.
     */
    public function show(UserSetting $userSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserSetting $userSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserSettingRequest $request, UserSetting $userSetting)
    {
        $userSetting->update([
            'switch' => $request->switch ?? null,
            'value_id' => $request->value_id ?? null
        ]);

        return $this->success('user setting updated');  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserSetting $userSetting)
    {
        $userSetting->delete();

        return $this->success('user setting deleted');
    }
}
