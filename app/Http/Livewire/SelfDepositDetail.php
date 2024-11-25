<?php

namespace App\Http\Livewire;

use App\Models\Deposit;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class SelfDepositDetail extends DataTableComponent
{
    public $user_id;
    public function builder(): Builder
    {
        return Deposit::query()->where('user_id', $this->user_id);
            // Select some things
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
            Column::make("Deposit Amount", "amount")
                ->sortable()
                ->searchable(),
            Column::make("Period", "created_at")
                ->searchable(),

        ];
    }
}
