<?php

namespace App\Tables;

use App\Models\Setting;

class SettingsIndexTable extends Table
{
    public $model = Setting::class;

    public string $translationFile = 'tables.settings';

    public array $columns = [
        'id',
        'name',
        'value',
        'actions'
    ];

    public array $casts = [
        'value' => 'value',
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
            'actions' => 'settings.edit'
        ],
        'columnWithActions' => [
            'actions' => [
                'edit' => 'settings.edit',
            ]
        ]
    ];

    public function getModelQuery()
    {
        return Setting::query();
    }

    public function getValueCast($model, $data)
    {
        if ($model->type == 'checkbox') {
            $input = '<input class="form-check-input" name="value" type="checkbox" ' . ($data ? 'checked' : '') . ' required onchange="this.form.submit(); this.disabled = true">';
        } else if ($model->type == 'text') {
            $input = '<input class="form-control" type="text" name="value" value="' . $data . '" required onchange="this.form.submit(); this.disabled = true">';
        } else if ($model->type == 'number') {
            $input = '<input class="form-control" type="number" name="value" value="' . $data . '" required onchange="this.form.submit(); this.disabled = true">';
        }

        return '<form action="' . route('settings.set', $model->id) . '" method="POST">
            ' . csrf_field() . method_field('PUT') . $input . '</form>';
    }
}
