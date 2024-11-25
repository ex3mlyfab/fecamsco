<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;

use App\Models\Loan;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class SelfLoanDetail extends DataTableComponent
{
    public $user_id;
    public function builder(): Builder
    {
        return Loan::query()->where('user_id', $this->user_id);
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
            Column::make("Loan Amount", "amount")
                ->sortable()
                ->searchable(),
            Column::make("Loan Type", "loan_type")
                ->searchable(),
            Column::make("Status", "status"),
            Column::make("Installment Paid", "given_installment"),
            Column::make("Total Installment", "total_installments")
                ->sortable(),
            LinkColumn::make('Action')
                ->title(fn($row) => 'view')
                ->location(fn($row) => route('self-loan.view', $row)),
        ];
    }
}
