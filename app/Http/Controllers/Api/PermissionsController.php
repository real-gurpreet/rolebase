<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('jwt', ['except' => ['signup','login']]);


    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();
        if (count($permissions) == 0) {
            $permissions = "no permission add yet";
        }
        return response()->json([
            'permissions' => $permissions,
            'response' => 'success'

        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->name;
        $permission = Permission::create(['name' => $name]);
        return response()->json([
            'permission' => $name,
            'response' => 'success'

        ], 201);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::find($id);
        return response()->json([
            'permission' => $permission,
            'response' => 'success'

        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $permission = Permission::find($id);
        $permission->name = $request->name;
        $permission->save();
        return response()->json([
            'permission' => $permission,
            'response' => 'success'

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

        $permission = Permission::find($id);
        $permission->delete();
        return response()->json([
            'role' => $permission,
            'response' => 'success',

        ], 200);
    }

    public function assignPermissionToRole(Request $request)
    {
        $roleId = $request->role_id;
        $permissionId = $request->permssion_id;
        $role = Role::find($roleId);
        $permission = Permission::find($permissionId);

        $message = "";
        if ($role == null) {
            $message = "role does not exists";
        } else if ($permission == null) {
            $message = "permission does not exists";
        }
        if (!$message) {
            //add permission to role
            $message = $role->givePermissionTo($permission);
            //add role to permission
            //$message = $permission->assignRole($role);
            $message = "Permission : '". $permission-> name . "' asign permission to  Role : '". $role-> name ."'";
        }

        return response()->json([

            'response' => $message,

        ], 200);

    }

    public function assignMultiplePermissionToRole(Request $request)
    {
        $roleId = $request->role_id;
        $permissionId = $request->permssion_id;

        $role = Role::find($roleId);
        $permission = Permission::find($permissionId);

        $message = "";
        if ($role == null) {
            $message = "role does not exists";
        } else if ($permission == null) {
            $message = "permission does not exists";
        }
        if (!$message) {
            //add multiple permission to role
            $message = $role->syncPermissions($permission);
            //add multiple roles to permission
            //$message = $permission->syncRoles($roles);
            $text = "" ;
            foreach($permission as $perm){
                  $text .= $perm->name . " , ";
            }
             $message = "Permission : '". $text . "' asign permission to  Role : '". $role-> name ."'";
        }

        return response()->json([

            'response' => $message,

        ], 200);

    }

    public function revokePermissionToRole(Request $request)
    {
        $roleId = $request->role_id;
        $permissionId = $request->permssion_id;
        $role = Role::find($roleId);
        $permission = Permission::find($permissionId);

        $message = "";
        if ($role == null) {
            $message = "role does not exists";
        } else if ($permission == null) {
            $message = "permission does not exists";
        }
        if (!$message) {
            //add permission to role
            $message =  $permission->removeRole($role);
            //add role to permission
            //$message =   $role->revokePermissionTo($permission);;
            $message = "Permission : '". $permission-> name . "' remove permission to  Role : '". $role-> name ."'";
        }

        return response()->json([

            'response' => $message,

        ], 200);

    }


    public function revokeMultiplePermissionToRole(Request $request)
    {
        $roleId = $request->role_id;
        $permissionId = $request->permssion_id;

        $role = Role::find($roleId);
        $permission = Permission::find($permissionId);

        $message = "";
        if ($role == null) {
            $message = "role does not exists";
        } else if ($permission == null) {
            $message = "permission does not exists";
        }
        if (!$message) {


            //remove multiple permission to role
            $message =  $role->revokePermissionTo($permission);
            //remove multiple roles to permission
            //$message = $permission->removeRole($role);
            $text = "" ;
            foreach($permission as $perm){
                  $text .= $perm->name . " , ";
            }
             $message = "Permission : '". $text . "' revoke permission to  Role : '". $role-> name ."'";
        }

        return response()->json([

            'response' => $message,

        ], 200);

    }
}
