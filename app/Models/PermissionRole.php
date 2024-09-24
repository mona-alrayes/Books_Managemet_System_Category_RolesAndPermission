<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PermissionRole extends Pivot
{
    use HasFactory;

    // Specify the table name if it differs from the default plural convention
    protected $table = 'permission_roles'; // Adjust if your table name is different

    // Define fillable attributes if needed
    protected $fillable = [
        'permission_id', // Example attribute, adjust based on your schema
        'role_id',       // Example attribute, adjust based on your schema
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

}
