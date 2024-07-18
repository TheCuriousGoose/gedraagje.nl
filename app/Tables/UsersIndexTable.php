<?php

namespace App\Tables;

use App\Models\User;

class UsersIndexTable extends Table
{
    public $model = User::class;

    public string $translationFile = 'tables.users';

    public array $columns = [
        'id',
        'name',
        'email',
        'active',
        'actions'
    ];

    public array $casts = [
        'active' => 'bool',
    ];

    public array $sortableColumns = [
        'id',
        'name',
        'email',
    ];

    public array $searchableColumns = [
        'name',
        'email',
    ];

    public array $tableOptions = [
        'search' => 'true',
        'visible-search' => 'true',
        'sortable' => 'true',
        'page-size' => 100,
    ];

    public array $headerExtras = [
        'columnWithRights' => [
            'actions' => 'users.edit'
        ],
        'columnWithActions' => [
            'actions' => [
                'edit' => 'users.edit',
            ]
        ],
        'columnsWithAttributes' => [
            'name' => [
                'data-sortable' => 'true',
            ],
            'email' => [
                'data-sortable' => 'true',
            ]
        ]
    ];

    public function getModelQuery()
    {
        return User::query();
    }
}
