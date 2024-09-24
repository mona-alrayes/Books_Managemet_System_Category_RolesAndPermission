<?php

namespace App\Services;
use App\Models\Role;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class RoleService
{

    /**
     * @throws Exception
     */
    public function getAll()
    {
        try {
            return Role::paginate(5);
        } catch (Exception $e) {
            throw new Exception('Failed to retrieve roles: ' . $e->getMessage());
        }
    }

    /**
     * Store a new role.
     *
     * @param array $data
     * An associative array containing the book's details .
     *
     * @return Role
     * The created book resource.
     *
     * @throws \Exception
     * Throws an exception if book creation fails.
     */
    public function store(array $data): Role
    {
        try {
            $role = Role::create($data);
            if (!$role) {
                throw new Exception('Failed to create the role.');
            }
            return $role;
        } catch (Exception $e) {
            throw new Exception('Role creation failed: ' . $e->getMessage());
        }
    }

    /**
     * Retrieve a specific role by its ID.
     *
     * @param int $id
     * The ID of the role to retrieve.
     *
     * @return Role
     * The role resource.
     *
     * @throws \Exception
     * Throws an exception if the role is not found.
     */
    public function show(string $id): Role
    {
        try {
            return Role::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new Exception('Role not found: ' . $e->getMessage());
        } catch (Exception $e) {
            throw new Exception('Failed to retrieve role: ' . $e->getMessage());
        }
    }

    /**
     * Update an existing role.
     *
     * @param array $data
     *
     * @param string $id
     * The ID of the role to update.
     *
     * @return Role
     * The updated role resource.
     *
     * @throws \Exception
     * Throws an exception if the role is not found or update fails.
     */
    public function update(array $data, string $id): Role
    {
        try {
            $role = Role::findOrFail($id);
            $role->update(array_filter($data));
            return $role;
        } catch (ModelNotFoundException $e) {
            throw new Exception('Role not found: ' . $e->getMessage());
        } catch (Exception $e) {
            throw new Exception('Failed to update Role: ' . $e->getMessage());
        }
    }

    /**
     * Delete a book by its ID.
     *
     * @param string $id
     * The ID of the role to delete.
     *
     * @return string
     * A message confirming the successful deletion.
     *
     * @throws \Exception
     * Throws an exception if the role is not found or deletion fails.
     */
    public function delete(string $id): string
    {
        try {
            $role = Role::findOrFail($id);
            $role->delete();
            return "Role deleted successfully.";
        } catch (ModelNotFoundException $e) {
            throw new Exception('Role not found: ' . $e->getMessage());
        } catch (Exception $e) {
            throw new Exception('Failed to delete role: ' . $e->getMessage());
        }
    }
}
