<?php

namespace App\Http\Controllers;

use App\Models\UserAddress;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\StoreUserAddressRequest;
use App\Http\Requests\UpdateUserAddressRequest;
use Illuminate\Routing\Controllers\HasMiddleware;

class UserAddressController extends Controller implements HasMiddleware
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
        return $this->response(auth()->user()->addresses);
    }

    public function store(StoreUserAddressRequest $request)
    {
        $address = auth()->user()->addresses()->create($request->toArray());
        return $this->success('shipping address created', $address);
    }

    /**
     * Display the specified resource.
     */
    public function show(UserAddress $userAddress)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserAddress $userAddress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserAddressRequest $request, UserAddress $userAddress)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserAddress $userAddress)
    {
        //
    }
}
