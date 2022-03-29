<?php

namespace App\Http\Resources;

use App\Http\Filters\FilterByPresetDate;
use App\Http\Filters\FilterByText;
use marcusvbda\vstack\Resource;
use Auth;
use marcusvbda\vstack\Fields\{
    Card,
    Tags,
    Check,
    Text,
    Radio,
    CustomComponent
};
use App\Http\Models\Pixel;

class Pixels extends Resource
{
    public $model = Pixel::class;

    public function icon()
    {
        return 'el-icon-place';
    }

    public function label()
    {
        return 'Pixels de Rastreamento';
    }

    public function singularLabel()
    {
        return 'Pixels de Rastreamento';
    }

    public function canImport()
    {
        return false;
    }

    public function canExport()
    {
        return false;
    }

    public function canCreate()
    {
        return Auth::user()->can('create-pixels');
    }

    public function canUpdate()
    {
        return Auth::user()->can('edit-pixels');
    }

    public function canClone()
    {
        return false;
    }

    public function canDelete()
    {
        return Auth::user()->can('delete-pixels');
    }


    public function canView()
    {
        return false;
    }

    public function search()
    {
        return ['name', 'value'];
    }

    public function table()
    {
        $columns = [];
        $columns['code'] = ['label' => 'Código', 'sortable_index' => 'id'];
        $columns['label'] = ['label' => 'Nome', 'sortable' => 'name'];
        $columns['f_created_at_badge'] = ['label' => 'Data de Criação', 'sortable_index' => "created_at"];
        $columns['f_updated_at_badge'] = ['label' => 'Data de Atualização', 'sortable_index' => "updated_at"];
        return $columns;
    }

    public function fields()
    {
        return [
            new Card('Identificação', [
                new Text([
                    'label' => 'Nome',
                    'field' => 'name',
                    'description' => 'Nome de referência do pixel',
                    'rules' => ['required']
                ]),
                new Radio([
                    'label' => 'Serviço',
                    'field' => 'provider',
                    'default' => 'Facebook',
                    'description' => 'Serviço de rastreamento',
                    'options' => [
                        'Facebook'
                    ],
                    'rules' => ['required']
                ]),
            ]),
            new Card('Configurações', [
                new Text([
                    'label' => 'Identificador',
                    'field' => 'value',
                    'description' => 'Código de identificação do pixel',
                    'rules' => ['required']
                ])
            ])
        ];
    }

    public function lenses()
    {
        return [
            "Facebook" => ["field" => "provider", "value" => 'Facebook', 'handler' => function ($q, $value) {
                return $q->where("provider", $value);
            }],
        ];
    }

    public function getPresetDateFilter()
    {
        return new FilterByPresetDate();
    }

    public function filters()
    {
        $filters[] = $this->getPresetDateFilter();
        $filters[] = new FilterByText([
            "label" => "Nome",
            "column" => "name"
        ]);
        $filters[] = new FilterByText([
            "label" => "Identificador",
            "column" => "value"
        ]);

        return $filters;
    }
}
