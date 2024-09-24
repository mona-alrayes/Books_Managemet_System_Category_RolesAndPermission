<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Services\RoleService;

class RoleController extends Controller
{

    protected RoleService $RoleService;

    /**
     * Constructor for BookController
     *
     * @param RoleService $RoleService  $RoleService The role service for handling role-related logic.
     */
    public function __construct(RoleService $RoleService)
    {
        $this->RoleService = $RoleService;
    }

    /**
     * Display a listing of the resource.
     * @throws \Exception
     */
    public function index()
    {
        $roles=$this->RoleService->getAll();
        return self::paginated( $roles, 'Roles Retrieved successfully',200);
    }

    /**
     * Store a newly created resource in storage.
     * @throws \Exception
     */
    public function store(StoreRoleRequest $request): \Illuminate\Http\JsonResponse
    {
        $role = $this->RoleService->store($request->validated());
        return self::success( $role ,'Role Created Successfully',201);
    }

    /**
     * Display the specified resource.
     * @throws \Exception
     */
    public function show(Role $role): \Illuminate\Http\JsonResponse
    {
        $role= $this->RoleService->show($role);
        return self::success($role,'Role retrieved Successfully');
    }

    /**
     * Update the specified resource in storage.
     * @throws \Exception
     */
    public function update(UpdateRoleRequest $request, Role $role): \Illuminate\Http\JsonResponse
    {
        $role=$this->RoleService->update($request->validated(), $role);
        return self::success( $role , 'Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @throws \Exception
     */
    public function destroy(Role $role): \Illuminate\Http\JsonResponse
    {
        return self::success(null,$this->RoleService->delete($role));
    }
}
