<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\StorePermissionRequest;
use Illuminate\Routing\Controllers\HasMiddleware;
use App\Http\Requests\AssignPermissionToRoleRequest;

class PermissionController extends Controller implements HasMiddleware
{
    
    public static function middleware()
    {
        return [
            'auth:sanctum'
        ];
    }

    public function index() 
    {
        return $this->response(Permission::all());
    }

    public function store(StorePermissionRequest $request)
    {
        if(Permission::query()->where('name', $request->name)->exists()){
            return $this->error('permission already exists');
        }
        $permission = Permission::create(['name' => $request->name]);

        return $this->success('permission created');
    }

    public function assign(AssignPermissionToRoleRequest $request)
    {
        $permission = Permission::findOrFail($request->permission_id);
        $role = Role::findOrFail($request->role_id);

        if($role->hasPermissionTo($permission->name)){
            return $this->error('permission already has in this role');
        }

        $role->givePermissionTo($permission->name);

        return $this->success('permission assigned to role');
    }
}
