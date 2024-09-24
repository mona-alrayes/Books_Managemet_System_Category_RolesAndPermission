<?php

namespace App\Services;
use App\Models\Permission;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class PermissionService
{

    /**
     * @throws Exception
     */
    public function getAll()
    {
        try {
            return Permission::paginate(5);
        } catch (Exception $e) {
            throw new Exception('Failed to retrieve permissions: ' . $e->getMessage());
        }
    }

    /**
     * Store a new permission.
     *
     * @param array $data
     * An associative array containing the permission's details .
     *
     * @return Permission
     * The created Permission resource.
     *
     * @throws \Exception
     * Throws an exception if permission creation fails.
     */
    public function store(array $data): Permission
    {
        try {
            $permission = Permission::create($data);
            if (!$permission) {
                throw new Exception('Failed to create the Permission.');
            }
            return $permission;
        } catch (Exception $e) {
            throw new Exception('Permission creation failed: ' . $e->getMessage());
        }
    }

    /**
     * Retrieve a specific Permission by its ID.
     *
     * @param string $id
     * The ID of the Permission to retrieve.
     *
     * @return Permission
     * The Permission resource.
     *
     * @throws \Exception
     * Throws an exception if the Permission is not found.
     */
    public function show(string $id): Permission
    {
        try {
            return Permission::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new Exception('Permission not found: ' . $e->getMessage());
        } catch (Exception $e) {
            throw new Exception('Failed to retrieve Permission: ' . $e->getMessage());
        }
    }

    /**
     * Update an existing Permission.
     *
     * @param array $data
     *
     * @param string $id
     * The ID of the Permission to update.
     *
     * @return Permission
     * The updated Permission resource.
     *
     * @throws \Exception
     * Throws an exception if the Permission is not found or update fails.
     */
    public function update(array $data, string $id): Permission
    {
        try {
            $permission = Permission::findOrFail($id);
            $permission->update(array_filter($data));
            return $permission;
        } catch (ModelNotFoundException $e) {
            throw new Exception('Permission not found: ' . $e->getMessage());
        } catch (Exception $e) {
            throw new Exception('Failed to update Permission: ' . $e->getMessage());
        }
    }

    /**
     * Delete a $permission by its ID.
     *
     * @param string $id
     * The ID of the $permission to delete.
     *
     * @return string
     * A message confirming the successful deletion.
     *
     * @throws \Exception
     * Throws an exception if the $permission is not found or deletion fails.
     */
    public function delete(string $id): string
    {
        try {
            $permission = Permission::findOrFail($id);
            $permission->delete();
            return "Permission deleted successfully.";
        } catch (ModelNotFoundException $e) {
            throw new Exception('Permission not found: ' . $e->getMessage());
        } catch (Exception $e) {
            throw new Exception('Failed to delete Permission: ' . $e->getMessage());
        }
    }
}
