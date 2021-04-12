<?php

namespace App\Http\Livewire;

use App\Course;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\TableComponent;

class CoursesTable extends TableComponent
{
    public $offlineIndicator = false;
    public $loadingIndicator = true;

    public function query() : Builder
    {
        return Course::query();
    }

    public function columns() : array
    {


        return [
            Column::make('Zkratka', 'code')
                ->searchable()
                ->sortable(),
            Column::make('Název', 'full_name')
                ->searchable()
                ->sortable(),

        ];
    }
}
