<?php

namespace App\Filament\Widgets;

use App\Enums\Priority;
use App\Enums\Status;
use App\Models\Idea;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class IdeaStats extends StatsOverviewWidget
{
    // A LINHA FOI ADICIONADA BEM AQUI:
    protected int | string | array $columnSpan = [
        'default' => 'full', // No celular, cada card ocupa a largura total (empilhados)
        'md' => 2,          // Em tablets, divide o espaço melhor
        'xl' => 'full',     // Em telas grandes, expande para o grid padrão do painel
    ];

    protected function getStats(): array
    {
        return [
            Stat::make('Total Ideas', Idea::count())
                ->description('Total number of ideas in the system')
                ->color('primary'),

            Stat::make('High Priority Ideas', Idea::where('priority', Priority::High->value)->count())
                ->description('Need attention')
                ->color(Priority::High->getColor()),

            Stat::make('In Progress', Idea::where('status', Status::InProgress->value)->count())
                ->description('Moderate attention')
                ->color(Status::InProgress->getColor()),

            Stat::make('Completed', Idea::where('status', Status::Completed->value)->count())
                ->description('Ideas that have been completed')
                ->color(Status::Completed->getColor()),
        ];
    }
}
