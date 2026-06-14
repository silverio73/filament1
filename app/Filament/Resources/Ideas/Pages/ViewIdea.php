<?php

namespace App\Filament\Resources\Ideas\Pages;

use App\Filament\Resources\Ideas\IdeaResource;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewIdea extends ViewRecord
{
    protected static string $resource = IdeaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('back')
                ->label('Back')
                ->url(IdeaResource::getUrl('index'))
                ->icon('heroicon-o-arrow-left'),
            EditAction::make(),
        ];
    }
}
