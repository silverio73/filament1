<?php

namespace App\Filament\Resources\Categories\RelationManagers;

use App\Filament\Resources\Ideas\IdeaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class IdeasRelationManager extends RelationManager
{
    protected static string $relationship = 'ideas';

    protected static ?string $relatedResource = IdeaResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make(),
            ]);
    }
}
