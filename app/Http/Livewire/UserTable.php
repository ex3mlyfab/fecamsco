<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class UserTable extends DataTableComponent
{
    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
        ->setTableWrapperAttributes([
            'id' => 'user-table',
            'class' => 'table table-striped',
          ])
          ->setTheadAttributes([
            'class' => 'bg-primary',
          ]);
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Full name", "first_name")
                ->format(
                    fn($value, $row, Column $column) => $row->first_name . ' ' . $row->middle_name .' ' . $row->last_name
                ),
            Column::make("Membership Status", "member.status")
            ->sortable()
            ->format(
                fn($value, $row, Column $column) => view('components.badge2')->withValue($value)
            ),
            Column::make("Email", "email")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
                ButtonGroupColumn::make('Actions')
                ->attributes(function($row) {
                    return [
                        'class' => 'd-flex justify-content-between',
                    ];
                })
                ->buttons([
                    LinkColumn::make('View') // make() has no effect in this case but needs to be set anyway
                        ->title(fn($row) => 'View ' . $row->name)
                        ->location(fn($row) => route('user.show', $row))
                        ->attributes(function($row) {
                            return [
                                'class' => 'btn btn-outline-primary',
                            ];
                        }),
                    LinkColumn::make('Edit')
                        ->title(fn($row) => 'Edit ' . $row->name)
                        ->location(fn($row) => route('user.edit', $row))
                        ->attributes(function($row) {
                            return [
                                'class' => 'underline text-blue-500 hover:no-underline',
                            ];
                        }),
                ]),
        ];
    }
}
