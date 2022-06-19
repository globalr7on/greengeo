<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use App\Http\Resources\PermissionResource;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response([
            'data' => PermissionResource::collection(Permission::all()),
            'status' => true
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  app\Http\Requests\PermissionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        return response([
            'data' => new PermissionResource(Permission::create($request->all())),
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
            'data' => new PermissionResource(Permission::find($id)),
            'status' => true
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  app\Http\Requests\PermissionRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionRequest $request, $id)
    {
        $permission = Permission::find($id);
        $permission->update($request->all());

        return response([
            'data' => new PermissionResource($permission),
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
        Permission::findOrFail($id)->delete();
        return response(null, 204);
    }
}
