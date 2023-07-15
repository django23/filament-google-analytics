<?php

namespace BezhanSalleh\FilamentGoogleAnalytics\Pages;

use BezhanSalleh\FilamentGoogleAnalytics\Widgets;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class FilamentGoogleAnalyticsDashboard extends Page
{
    protected static string $view = 'filament-google-analytics::pages.google-analytics-dashboard';

    public function mount()
    {
        parent::mount();

        if (! static::canView()) {
            return redirect(config('filament.path'));
        }
    }

    public static function getNavigationIcon(): string
    {
        return config('filament-google-analytics.dashboard_icon') ?? 'heroicon-o-chart-bar';
    }

    public static function getNavigationLabel(): string
    {
        return __('filament-google-analytics::widgets.navigation_label');
    }

    public function getTitle(): string | Htmlable
    {
        return __('filament-google-analytics::widgets.title');
    }

    public static function canView(): bool
    {
        return config('filament-google-analytics.dedicated_dashboard');
    }

    public static function shouldRegisterNavigation(): bool
    {
        return static::canView() && static::$shouldRegisterNavigation;
    }

    /**
     * @return array<class-string>
     */
    protected function getHeaderWidgets(): array
    {
        return [
            Widgets\PageViewsWidget::class,
            Widgets\VisitorsWidget::class,
            Widgets\ActiveUsersOneDayWidget::class,
            Widgets\ActiveUsersSevenDayWidget::class,
            Widgets\ActiveUsersTwentyEightDayWidget::class,
            Widgets\SessionsWidget::class,
            Widgets\SessionsDurationWidget::class,
            Widgets\SessionsByCountryWidget::class,
            Widgets\SessionsByDeviceWidget::class,
            Widgets\MostVisitedPagesWidget::class,
            Widgets\TopReferrersListWidget::class,
        ];
    }
}
