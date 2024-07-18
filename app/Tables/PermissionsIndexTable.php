<?php

namespace App\Tables;

use Spatie\Permission\Models\Permission;

class PermissionsIndexTable extends Table
{
    public $model = Permission::class;

    public string $translationFile = 'tables.permissions';

    public array $columns = [
        'id',
        'name',
        'guard_name',
        'actions'
    ];

    public array $sortableColumns = [
        'id',
        'name',
    ];

    public array $searchableColumns = [
        'name',
    ];

    public array $tableOptions = [
        'search' => 'true',
        'visible-search' => 'true',
        'sortable' => 'true',
        'page-size' => 100,
    ];

    public array $headerExtras = [
        'columnWithRights' => [
            'actions' => 'permissions.edit'
        ],
        'columnWithActions' => [
            'actions' => [
                'edit' => 'permissions.edit',
            ]
        ]
    ];

    public function getModelQuery()
    {
        return Permission::query();
    }
}
