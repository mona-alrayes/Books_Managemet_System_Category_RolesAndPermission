<?php

namespace App\Http\Controllers;

use App\Models\Role; // Assuming you have a Role model
use App\Models\Permission; // Assuming you have a Permission model
use Illuminate\Http\Request;

class PermissionRoleController extends Controller
{
    /**
     * Attach a permission to a role.
     */
    public function attach(Request $request, Role $role): \Illuminate\Http\JsonResponse
    {
        // Validate the incoming request
        $request->validate([
            'permission_id' => 'required|exists:permissions,id',
        ]);

        // Attach the permission to the role
        $role->permissions()->attach($request->permission_id);

        return response()->json(['message' => 'Permission attached successfully.'], 200);
    }

    /**
     * Detach a permission from a role.
     */
    public function detach(Request $request, Role $role): \Illuminate\Http\JsonResponse
    {
        // Validate the incoming request
        $request->validate([
            'permission_id' => 'required|exists:permissions,id',
        ]);

        // Detach the permission from the role
        $role->permissions()->detach($request->permission_id);

        return response()->json(['message' => 'Permission detached successfully.'], 200);
    }

    /**
     * List all permissions for a specific role.
     */
    public function index(Role $role): \Illuminate\Http\JsonResponse
    {
        // Get all permissions for the role
        $permissions = $role->permissions;

        return response()->json($permissions);
    }
}
