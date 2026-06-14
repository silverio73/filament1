<?php

namespace App\Filament\Resources\Ideas\Schemas;

use App\Enums\Priority;
use App\Enums\Status;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class IdeaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Envolvemos tudo em um Grid Inteligente e Responsivo
                Grid::make([
                    'default' => 1, // 1 coluna por padrão no celular
                    'md' => 2,      // 2 colunas em tablets e computadores
                ])
                ->schema([
                    TextInput::make('title')
                        ->required()
                        ->columnSpan(1), // Ocupa metade da linha no desktop

                    Select::make('category_id')
                        ->relationship('category', 'name')
                        ->preload() // Carrega as opções de forma suave
                        ->required()
                        ->columnSpan(1), // Ocupa a outra metade no desktop

                    Textarea::make('description')
                        ->required()
                        ->columnSpanFull(), // Descrição sempre ocupa a linha toda

                    Select::make('status')
                        ->options(Status::class)
                        ->required()
                        ->columnSpan(1),

                    Select::make('priority')
                        ->options(Priority::class)
                        ->required()
                        ->columnSpan(1),
                ]),
            ]);
    }
}
