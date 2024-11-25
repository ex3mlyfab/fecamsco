<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Supplier;


class ListSupplier extends DataTableComponent
{
    protected $model = Supplier::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Supplier Name", "name")
                ->sortable()
                ->searchable(),
            Column::make("Supplier Phone", "phone")
                ->searchable(),
            Column::make("Address", "address"),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
