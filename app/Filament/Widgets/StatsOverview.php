<?php

namespace App\Filament\Widgets;

use App\Models\Capsule;
use App\Models\Contributor;
use App\Models\Memory;
use App\Models\Receiver;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;
    protected function getStats(): array
    {
        return [

            Stat::make(__('Users'), User::Count())
                ->description(__('All of Users use Future Echo System'))
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3])
                ->icon('heroicon-o-user'),

            Stat::make(__('Memories'), Memory::Count())
                ->description(__('Memories that users added, and how traffic in our system deal'))
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger')
                ->icon('heroicon-o-light-bulb')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3]),

            Stat::make(__('Capsules'), Capsule::Count())
                ->description(__('Total of the capsules in Future Echo'))
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->icon('heroicon-o-photo')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3]),

                Stat::make(__('Contributors'), Contributor::Count())
                ->description(__('Total of the contributors in user\'s capsules'))
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->icon('heroicon-o-user')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3]),

                Stat::make(__('Receivers'), Receiver::Count())
                ->description(__('Total of receivers which receive notification per day'))
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->icon('heroicon-o-user')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3]),
        ];
    }
}
