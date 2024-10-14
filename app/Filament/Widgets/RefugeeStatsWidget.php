<?php

namespace App\Filament\Widgets;

use App\Models\Refugee;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class RefugeeStatsWidget extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('إجمالي النازحين', Refugee::count())
                ->description('العدد الكلي للنازحين المسجلين')
                ->descriptionIcon('heroicon-s-user-group')
                ->color('primary'),
            Card::make('متوسط حجم الأسرة', number_format(Refugee::avg('family_members'), 1))
                ->description('متوسط عدد أفراد الأسرة')
                ->descriptionIcon('heroicon-s-users')
                ->color('success'),
            Card::make('النازحون الجدد هذا الشهر', Refugee::whereMonth('created_at', now()->month)->count())
                ->description('عدد النازحين المسجلين هذا الشهر')
                ->descriptionIcon('heroicon-s-calendar')
                ->color('warning'),
        ];
    }
}
