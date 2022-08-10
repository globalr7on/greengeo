<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\ActivationReceived;
use Validator;
use Hash;
use Mail;
use Str;
// use Illuminate\Auth\Events\Registered;


class UserController extends Controller
{
    /**
     * Generate token access
     *
     * @return \Illuminate\Http\Response
     */
    public function accessToken(Request $request, User $user)
    {
        if (!is_null($user->id)) {
            // $user->OauthAccessToken()->delete();
            return $user->createToken('accessToken')->accessToken;
        }

        $data = [];
        $status = true;
        $status_code = 200;

        $validator = Validator::make($request->all(), [
            'cpf' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            $data = $validator->errors();
            $status = false;
            $status_code = 400;
        } else {
            $user = User::where("cpf", $request->cpf)->first();
            if ($user) {
                if (Hash::check($request->password, $user->password)) {
                    // $user->OauthAccessToken()->delete();
                    $data = [
                        "token" => $user->createToken('accessToken')->accessToken
                    ];
                } else {
                    $data = [
                        "password" => "Wrong passowrd"
                    ];
                    $status = false;
                    $status_code = 400;
                }
            } else {
                $data = [
                    "cpf" => "User not found"
                ];
                $status = false;
                $status_code = 400;
            }
        }

       return response([
            'data' => $data,
            'status' => $status
        ], $status_code);
       
    }

    /**
     * Logout user
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        if (Auth::check()) {
            Auth::user()->OauthAccessToken()->delete();
        }

        return response([
            'data' => 'Successful logout',
            'status' => true
        ], 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::all();
        if ($request->has('usuario_responsavel_cadastro_id')) {
            $userResponsavel = User::find($request->usuario_responsavel_cadastro_id);
            if (!$userResponsavel->hasRole('admin')) {
                $users = $users->where('usuario_responsavel_cadastro_id', $request->usuario_responsavel_cadastro_id)->all();
            }
        }

        if ($request->has('pessoa_juridica_id')) {
            $users = $users->where('pessoa_juridica_id', $request->pessoa_juridica_id)->all();
        }

        if ($request->has('funcao')) {
            $filteredUsers = [];
            foreach ($users as $user) {
                if ($user->hasRole($request->funcao)) {
                    array_push($filteredUsers, $user);
                }
            }
            $users = $filteredUsers;
        }

        return response([
            'data' => UserResource::collection($users),
            'status' => true
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  app\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $request->merge(array('password' => Str::random(16)));
        $user = User::create($request->except('role_web', 'role_api'));
        $newRoleWeb = intval($request->get('role_web'));
        $newRoleApi = intval($request->get('role_api'));
        if ($newRoleWeb) {
            $user->assignRole($newRoleWeb, 'web'); 
        }
        if ($newRoleApi) {
            $user->assignRole($newRoleApi, 'api'); 
        }

        // event(new Registered($user));
        Mail::to($user->email)->send(new ActivationReceived($user->cpf, $user->name, $user->email, $request->password));

        return response([
            'data' => new UserResource($user),
            'status' => true
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response([
            'data' => new UserResource(User::find($id)),
            'status' => true
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     
     * @param  app\Http\Requests\UserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::find($id);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return response(null, 204);
    }
}
