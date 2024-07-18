<?php

namespace App\Tables;

use App\Models\Quote;
use Spatie\Permission\Models\Permission;

class QuotesIndexTable extends Table
{
    public $model = Permission::class;

    public string $translationFile = 'tables.quotes';

    public array $columns = [
        'id',
        'quote',
        'quotee_name',
        'user_id',
        'created_at',
        'actions'
    ];

    public array $sortableColumns = [
        'id',
        'quote',
    ];

    public array $searchableColumns = [
        'quote',
    ];

    public array $casts = [
        'user_id' => 'user',
        'created_at' => 'datetime',
    ];


    public array $tableOptions = [
        'search' => 'true',
        'visible-search' => 'true',
        'sortable' => 'true',
        'page-size' => 100,
    ];

    public array $headerExtras = [
        'columnWithRights' => [
            'actions' => 'quotes.edit'
        ],
        'columnWithActions' => [
            'actions' => [
                'edit' => 'quotes.edit',
            ]
        ]
    ];

    public function getModelQuery()
    {
        return Quote::query()->with('author');
    }

    public function getUserCast($model, $data)
    {
        return $model->author->name;
    }
}
