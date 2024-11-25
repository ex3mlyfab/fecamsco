<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\ProductService;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class ProductServiceTable extends DataTableComponent
{

public function builder(): Builder
{
    return ProductService::query()
        ->join('product_service_categories', 'product_services.product_service_id', '=','product_service_categories.id' )
        ->select('product_services.*', 'product_service_categories.name'); // Select some things
}
    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Product Name", "name")
                ->sortable()
                ->searchable(),
            Column::make("Category", "productServiceCategory.name")
                ->searchable(),
            Column::make("Description", "description"),
            Column::make("Created at", "created_at")
                ->sortable(),
            ButtonGroupColumn::make('Actions')
                ->attributes(function($row) {
                    return [
                        'class' => 'g-x-2',
                    ];
                })
                ->buttons([
                    LinkColumn::make('View') // make() has no effect in this case but needs to be set anyway
                        ->title(fn($row) => 'View')
                        ->location(fn($row) => route('product.show', $row))
                        ->attributes(function($row) {
                            return [
                                'class' => 'underline text-primary',
                            ];
                        }),
                    LinkColumn::make('Edit')
                        ->title(fn($row) => 'Edit')
                        ->location(fn($row) => route('product.sales', $row))
                        ->attributes(function($row) {
                            return [
                                'target' => '_blank',
                                'class' => 'underline text-primary',
                            ];
                        }),
                ]),
        ];
    }
}
