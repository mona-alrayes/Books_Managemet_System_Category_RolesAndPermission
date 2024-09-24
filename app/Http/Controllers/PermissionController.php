<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Models\Permission;
use App\Services\PermissionService;

class PermissionController extends Controller
{

    protected PermissionService $PermissionService;

    /**
     * Constructor for PermissionController
     *
     * @param PermissionService $PermissionService  $PermissionService The Permission service for handling Permission-related logic.
     */
    public function __construct(PermissionService $PermissionService)
    {
        $this->PermissionService = $PermissionService;
    }

    /**
     * Display a listing of the resource.
     * @throws \Exception
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        $roles=$this->PermissionService->getAll();
        return self::paginated( $roles, 'Permissions Retrieved successfully',200);
    }

    /**
     * Store a newly created resource in storage.
     * @throws \Exception
     */
    public function store(StorePermissionRequest $request): \Illuminate\Http\JsonResponse
    {
        $role = $this->PermissionService->store($request->validated());
        return self::success( $role ,'Permission Created Successfully',201);
    }

    /**
     * Display the specified resource.
     * @throws \Exception
     */
    public function show(Permission $permission): \Illuminate\Http\JsonResponse
    {
        $role= $this->PermissionService->show($permission);
        return self::success($role,'Permission retrieved Successfully');
    }

    /**
     * Update the specified resource in storage.
     * @throws \Exception
     */
    public function update(UpdatePermissionRequest $request, Permission $permission): \Illuminate\Http\JsonResponse
    {
        $permission=$this->PermissionService->update($request->validated(), $permission);
        return self::success( $permission , 'Permission updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @throws \Exception
     */
    public function destroy(Permission $permission): \Illuminate\Http\JsonResponse
    {
        return self::success(null,$this->PermissionService->delete($permission));
    }
}
