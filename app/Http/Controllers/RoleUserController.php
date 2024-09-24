<?php

namespace App\Http\Controllers;

use App\Models\User; // Assuming you have a User model
use App\Models\Role; // Assuming you have a Role model
use Illuminate\Http\Request;

class RoleUserController extends Controller
{
    /**
     * Attach a role to a user.
     */
    public function attach(Request $request, User $user): \Illuminate\Http\JsonResponse
    {
        // Validate the incoming request
        $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        // Attach the role to the user
        $user->roles()->attach($request->role_id);

        return response()->json(['message' => 'Role attached successfully.'], 200);
    }

    /**
     * Detach a role from a user.
     */
    public function detach(Request $request, User $user): \Illuminate\Http\JsonResponse
    {
        // Validate the incoming request
        $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        // Detach the role from the user
        $user->roles()->detach($request->role_id);

        return response()->json(['message' => 'Role detached successfully.'], 200);
    }

    /**
     * List all roles for a specific user.
     */
    public function index(User $user): \Illuminate\Http\JsonResponse
    {
        // Get all roles for the user
        $roles = $user->roles;

        return response()->json($roles);
    }
}
