<?php

namespace App\Http\Livewire;


use App\Models\ReceiveOrder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class ListRecieveOrder extends DataTableComponent
{
    protected $model = ReceiveOrder::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Supplier Name", "purchaseOrder.supplier.name")
                ->sortable()
                ->searchable(),
            Column::make("Recieved By", "receivedBy.last_name")
                ->searchable(),
            Column::make("Total Cost", "cost"),
            Column::make("status", "status"),
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
                        ->title(fn($row) => 'View ' . $row->name)
                        ->location(fn($row) => route('purchase-order.show', $row))
                        ->attributes(function($row) {
                            return [
                                'class' => 'underline text-primary',
                            ];
                        }),
                    LinkColumn::make('Edit')
                        ->title(fn($row) => 'Edit ' . $row->name)
                        ->location(fn($row) => route('purchase-order.show', $row))
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
