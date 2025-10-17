<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\UserPreference;

class ThemeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Share theme data with all views
        View::composer('*', function ($view) {
            try {
                if (Auth::check()) {
                    $user = Auth::user();
                    $preferences = $user->getPreferences();
                    
                    $view->with([
                        'userTheme' => $preferences,
                        'themeColors' => $preferences->getThemeColors(),
                        'cssVariables' => $preferences->getCssVariables(),
                        'themeName' => $preferences->theme,
                    ]);
                } else {
                    // Provide default theme data for non-authenticated users
                    $defaultPreferences = new UserPreference(UserPreference::getDefaults());
                    $view->with([
                        'userTheme' => $defaultPreferences,
                        'themeColors' => $defaultPreferences->getThemeColors(),
                        'cssVariables' => $defaultPreferences->getCssVariables(),
                        'themeName' => 'light',
                    ]);
                }
            } catch (\Exception $e) {
                \Log::error('ThemeServiceProvider error: ' . $e->getMessage());
                // Provide default theme data
                $defaultPreferences = new UserPreference(UserPreference::getDefaults());
                $view->with([
                    'userTheme' => $defaultPreferences,
                    'themeColors' => $defaultPreferences->getThemeColors(),
                    'cssVariables' => $defaultPreferences->getCssVariables(),
                    'themeName' => 'light',
                ]);
            }
        });
    }
}
