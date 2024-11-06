<?php

namespace App\Filament\Widgets;

use App\Models\Capsule;
use App\Models\Contributor;
use App\Models\Memory;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;
    protected function getStats(): array
    {
        return [

            Stat::make('Users', User::Count())
                ->description('All of Users from the database')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3])
                ->icon('heroicon-o-user'),
            Stat::make('Memories', Memory::Count())
                ->description('The Memories ')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger')
                ->icon('heroicon-o-light-bulb')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3]),
            Stat::make('Capsules', Capsule::Count())
                ->description('Total the capsule in app')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->icon('heroicon-o-photo')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3]),
        ];
    }
}
