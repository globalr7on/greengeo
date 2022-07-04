<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;

class ProfileController extends Controller
{
    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        $updated = User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->password)
        ]);

        return response([
            'status' => $updated
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function me(Request $request)
    {
        return response([
            'data' => new UserResource($request->user()),
            'status' => true
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     
     * @param  app\Http\Requests\ProfileRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request)
    {
        $user = User::whereId(auth()->id);
        $user->update($request->except('role_web', 'role_api'));
        $oldRoleWeb = intval($user->roles->filter(function ($roles) { return $roles->guard_name == 'web'; })->pluck('id')->first());
        $oldRoleApi = intval($user->roles->filter(function ($roles) { return $roles->guard_name == 'api'; })->pluck('id')->first());
        $newRoleWeb = intval($request->get('role_web'));
        $newRoleApi = intval($request->get('role_api'));
        if ($oldRoleWeb) {
            $user->removeRole($oldRoleWeb, 'web');
        }
        if ($oldRoleApi) {
            $user->removeRole($oldRoleApi, 'api');
        }
        if ($newRoleWeb) {
            $user->assignRole($newRoleWeb, 'web'); 
        }
        if ($newRoleApi) {
            $user->assignRole($newRoleApi, 'api'); 
        }

        return response([
            'data' => new UserResource($user),
            'status' => true
        ], 200);
    }
}
