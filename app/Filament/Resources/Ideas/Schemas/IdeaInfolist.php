<?php

namespace App\Filament\Resources\Ideas\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class IdeaInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('title'),
                TextEntry::make('description')
                    ->columnSpanFull(),
                TextEntry::make('status')
                    ->badge(),
                    // ->formatStateUsing(fn($state) =>$state->label())
                    // ->color(fn($state) => $state->color()),
                TextEntry::make('priority')
                    ->badge(),
                TextEntry::make('category.name')
                    ->label('Category')
                    ->badge(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
