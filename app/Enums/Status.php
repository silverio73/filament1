<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum Status: string implements HasLabel, HasColor
{
    case Pending = 'pending';
    case InProgress = 'in_progress';
    case Completed = 'completed';

    public function getLabel(): string
    {
        return match ($this) {
            self::Pending => 'Pending',
            self::InProgress => 'in_progress',
            self::Completed => 'Completed',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::Pending => 'warning',
            self::InProgress => 'info',
            self::Completed => 'success',
        };
    }
}
