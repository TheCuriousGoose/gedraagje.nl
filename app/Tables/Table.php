<?php

namespace App\Tables;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Table
{

    public array $columns = [];
    public array $headerExtras  = [
        'columnWithRights' => [],
        'columnWithActions' => [],
        'columnWithAttributes' => []
    ];
    public array $tableOptions = [
        'search' => true,
        'sortable' => true,
        'page-size' => 100,
    ];
    public $model;
    public string $translationFile;
    public array $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public array $sortableColumns = [
        'id',
    ];

    public array $searchableColumns = [
        'id',
    ];

    public function getBoolCast($model, $data)
    {
        if ($data) {
            return __('Yes');
        } else {
            return __('No');
        }
    }

    public function getDatetimeCast($model, $data)
    {
        return $data->format('Y-m-d H:i:s');
    }

    public function getModelQuery()
    {
        return $this->model->query();
    }

    public function create()
    {
        $headers = [];

        foreach ($this->columns as $column) {
            $rights = $this->headerExtras['columnWithRights'][$column] ?? null;
            $attributes = $this->headerExtras['columnsWithAttributes'][$column] ?? [];

            if ($rights && !Auth::user()->can($rights)) {
                continue;
            }

            $headers[$this->translationFile . '.' . $column] = $attributes;
        }

        $table = [
            'columns' => $headers,
            'options' => $this->tableOptions,
            'sortableColumns' => $this->sortableColumns,
        ];

        return $table;
    }

    public function ajaxSearch(Request $request)
    {
        $query = $this->getModelQuery();

        $queryCount = $query->count();

        if ($request->has('limit')) {
            $query->limit($request->input('limit'));
        }

        if ($request->has('offset')) {
            $query->offset($request->input('offset'));
        }

        if($request->has('search')){
            $search = $request->input('search');
            $query->where(function($query) use($search){
                foreach($this->searchableColumns as $column){
                    $query->orWhere($column, 'like', '%' . $search . '%');
                }
            });
        }

        if($request->has('sort')){
            $sort = $request->input('sort');
            $query->orderBy($sort, $request->input('order'));
        }

        $datas = $query->get();

        $rows = [];
        $castColumns = array_keys($this->casts);

        foreach ($datas as $data) {
            $row = [];

            foreach ($this->columns as $column) {
                $columnData = '';

                if (isset($this->headerExtras['columnWithActions'][$column])) {
                    $actions = $this->headerExtras['columnWithActions'][$column];

                    foreach ($actions as $action => $route) {
                        $actionIcon = '';
                        $actionText = '';

                        switch ($action) {
                            case 'edit':
                                $actionIcon = 'fa fa-pencil';
                                $actionText = __('Edit');
                                $actionButtonType = 'btn-primary';
                                break;
                            case 'show':
                                $actionIcon = 'fa fa-eye';
                                $actionText = __('Show');
                                $actionButtonType = 'btn-secondary';
                                break;
                        }

                        $columnData .= '<a class="gap-1 d-inline-flex align-items-center btn btn-sm ' . $actionButtonType . '" href="' . route($route, $data->id) . '"><i class="me-1 ' . $actionIcon . '"></i>' . $actionText . '</a>';
                    }
                } else if (in_array($column, $castColumns)) {
                    $castName = 'get' . ucwords($this->casts[$column]) . 'Cast';
                    $instance = new static($this->model);
                    $columnData = $instance->$castName($data, $data->$column);
                } else {
                    $columnData = $data->$column;
                }

                $row[$column] = $columnData;
            }

            $rows[] = $row;
        }

        $ajaxData = [
            'rows' => $rows,
            'total' => $queryCount,
        ];

        return $ajaxData;
    }
}
