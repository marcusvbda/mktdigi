<?php

namespace App\Http\Resources;

use App\Http\Filters\FilterByPresetDate;
use App\Http\Filters\FilterByText;
use App\Http\Models\Pixel;
use marcusvbda\vstack\Resource;
use Auth;
use marcusvbda\vstack\Fields\{
    BelongsTo,
    Card,
    Text,
    DateTime
};
use App\Http\Models\ShortUrl;
use marcusvbda\vstack\Services\Messages;

class LinksEncurtados extends Resource
{
    public $model = ShortUrl::class;

    public function icon()
    {
        return 'el-icon-link';
    }

    public function label()
    {
        return 'Links Encurtados';
    }

    public function singularLabel()
    {
        return 'Link Encurtado';
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
        return Auth::user()->can('create-short-urls');
    }

    public function canUpdate()
    {
        return Auth::user()->can('edit-short-urls');
    }

    public function canClone()
    {
        return false;
    }

    public function canDelete()
    {
        return Auth::user()->can('delete-short-urls');
    }


    public function canView()
    {
        return false;
    }

    public function search()
    {
        return ['name'];
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
        $default_ids = [];
        if (request()->page_type == 'edit' && request()->content) {
            $default_ids = request()->content->pixels()->pluck('id')->map(function ($row) {
                return strval($row);
            })->toArray();
        }

        return [
            new Card('Identificação', [
                new Text([
                    'label' => 'Nome',
                    'field' => 'name',
                    'description' => 'Apenas para identificação',
                    'rules' => ['required']
                ]),
                new Text([
                    'label' => 'Url',
                    'field' => 'original_url',
                    'type' => 'url',
                    'description' => 'Link original',
                    'rules' => ['required']
                ]),
            ]),
            new Card('Configurações', [
                new BelongsTo([
                    'label' => 'Pixels',
                    'field' => 'pixel_ids',
                    'multiple' => true,
                    'options' => Pixel::select("id as id", "name as value")->get(),
                    'default' => $default_ids,
                ]),
                new DateTime([
                    'label' => 'Vencimento',
                    'field' => 'due_date',
                    'type' => 'date',
                    'description' => 'Caso o link não possua vencimento deixe este campo em branco',
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

    public function storeMethod($id, $data)
    {
        $target = @$id ? $this->getModelInstance()->findOrFail($id) : $this->getModelInstance();
        $target->name = data_get($data, "data.name");
        $target->due_date = data_get($data, "data.due_date");
        $target->original_url = data_get($data, "data.original_url");
        $target->save();
        $pixels_ids =  data_get($data, "data.pixel_ids", []);
        $target->pixels()->detach();
        $target->pixels()->sync($pixels_ids);
        Messages::send("success", "Registro salvo com sucesso !!");
        if (request("clicked_btn") == "save") {
            $route = route('resource.edit', ["resource" => $this->id, "code" => $target->code]);
        } else {
            $route = route('resource.index', ["resource" => $this->id]);
        }
        return ["success" => true, "route" => $route, "model" => $target];
    }
}
