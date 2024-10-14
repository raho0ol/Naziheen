<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Illuminate\Support\ServiceProvider;

class FilamentServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Filament::serving(function () {
            Filament::registerNavigationGroups([
                NavigationGroup::make()
                     ->label('إدارة النازحين')
                     ->icon('heroicon-o-user-group'),
                NavigationGroup::make()
                     ->label('الخدمات والأنشطة')
                     ->icon('heroicon-o-clipboard-list'),
            ]);

            Filament::registerNavigationItems([
                NavigationItem::make('النازحون')
                    ->icon('heroicon-o-user')
                    ->activeIcon('heroicon-s-user')
                    ->isActiveWhen(fn (): bool => request()->routeIs('filament.resources.refugees.*'))
                    ->group('إدارة النازحين')
                    ->sort(1),
                NavigationItem::make('التعليم والمهارات')
                    ->icon('heroicon-o-academic-cap')
                    ->activeIcon('heroicon-s-academic-cap')
                    ->isActiveWhen(fn (): bool => request()->routeIs('filament.resources.education-skills.*'))
                    ->group('إدارة النازحين')
                    ->sort(2),
                NavigationItem::make('الاحتياجات')
                    ->icon('heroicon-o-exclamation-circle')
                    ->activeIcon('heroicon-s-exclamation-circle')
                    ->isActiveWhen(fn (): bool => request()->routeIs('filament.resources.needs.*'))
                    ->group('إدارة النازحين')
                    ->sort(3),
                NavigationItem::make('التقييمات الصحية')
                    ->icon('heroicon-o-heart')
                    ->activeIcon('heroicon-s-heart')
                    ->isActiveWhen(fn (): bool => request()->routeIs('filament.resources.health-assessments.*'))
                    ->group('الخدمات والأنشطة')
                    ->sort(1),
                NavigationItem::make('المساعدات')
                    ->icon('heroicon-o-gift')
                    ->activeIcon('heroicon-s-gift')
                    ->isActiveWhen(fn (): bool => request()->routeIs('filament.resources.aids.*'))
                    ->group('الخدمات والأنشطة')
                    ->sort(2),
                NavigationItem::make('الأحداث والأنشطة')
                    ->icon('heroicon-o-calendar')
                    ->activeIcon('heroicon-s-calendar')
                    ->isActiveWhen(fn (): bool => request()->routeIs('filament.resources.events.*'))
                    ->group('الخدمات والأنشطة')
                    ->sort(3),
            ]);
        });
    }
}