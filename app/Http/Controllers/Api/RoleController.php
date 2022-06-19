<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Http\Resources\RoleResource;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response([
            'data' => RoleResource::collection(Role::all()),
            'status' => true
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  app\Http\Requests\RoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $role = Role::create($request->except('permissions'));
        $role->syncPermissions($request->get('permissions'));
        return response([
            'data' => new RoleResource($role),
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
            'data' => new RoleResource(Role::find($id)),
            'status' => true
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  app\Http\Requests\RoleRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        $role = Role::find($id);
        $role->update($request->except('permissions'));
        $role->syncPermissions($request->get('permissions'));

        return response([
            'data' => new RoleResource($role),
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
        Role::findOrFail($id)->delete();
        return response(null, 204);
    }
}
