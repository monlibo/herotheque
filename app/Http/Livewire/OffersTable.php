<?php

namespace App\Http\Livewire;

use App\Models\Offer;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class OffersTable extends LivewireDatatable
{
    public $model = Offer::class;

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->defaultSort('asc')
                ->sortBy('id'),

            Column::name('title')
                ->label('Title')
                ->searchable()
                ->filterable()
                ->editable()
                ->defaultSort('asc')
                ->sortBy('title'),

            Column::name('description')
                ->label('Description')
                ->editable(),
                
            
            
        ];
    }
}