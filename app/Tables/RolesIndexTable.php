<?php

namespace App\Tables;

use Spatie\Permission\Models\Role;

class RolesIndexTable extends Table
{
    public $model = Role::class;

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
            'actions' => 'roles.edit'
        ],
        'columnWithActions' => [
            'actions' => [
                'edit' => 'roles.edit',
            ]
        ]
    ];

    public function getModelQuery()
    {
        return Role::query();
    }
}
