<?php

namespace App\Filament\Resources\Ideas\Pages;

use App\Filament\Resources\Ideas\IdeaResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditIdea extends EditRecord
{
    protected static string $resource = IdeaResource::class;

     protected function getRedirectUrl(): string
{
    return $this->getResource()::getUrl('index');
}

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
