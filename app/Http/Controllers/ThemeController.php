<?php

namespace App\Http\Controllers;

use App\Models\UserPreference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThemeController extends Controller
{
    /**
     * Display the theme settings page.
     */
    public function index()
    {
        try {
            $user = Auth::user();
            $preferences = $user->getPreferences();
            
            return view('theme.index', compact('preferences'));
        } catch (\Exception $e) {
            \Log::error('Theme index error: ' . $e->getMessage());
            return redirect()->route('dashboard')->with('error', 'Terjadi kesalahan saat memuat halaman tema.');
        }
    }

    /**
     * Update the theme preferences.
     */
    public function update(Request $request)
    {
        try {
            $user = Auth::user();
            $preferences = $user->getPreferences();

            // Debug: Log request data
            \Log::info('Theme update request data:', $request->all());

            $request->validate([
                'theme' => 'nullable|in:light,dark,auto',
                'color_scheme' => 'nullable|in:blue,green,purple,red,orange',
                'font_size' => 'nullable|in:small,medium,large',
                'show_animations' => 'nullable|boolean',
                'show_tooltips' => 'nullable|boolean',
                'language' => 'nullable|in:id,en',
                'date_format' => 'nullable|in:d-m-Y,m/d/Y,Y-m-d',
                'time_format' => 'nullable|in:12,24',
                'number_format' => 'nullable|in:dot,comma',
            ]);

            // Prepare data for update - only update fields that are provided
            $data = $request->only([
                'theme', 'color_scheme', 'font_size', 'language', 'date_format', 
                'time_format', 'number_format'
            ]);
            
            // Handle checkbox fields only if they are provided
            if ($request->has('show_animations')) {
                $data['show_animations'] = $request->boolean('show_animations');
            }
            if ($request->has('show_tooltips')) {
                $data['show_tooltips'] = $request->boolean('show_tooltips');
            }

            // Remove empty values
            $data = array_filter($data, function($value) {
                return $value !== null && $value !== '';
            });

            \Log::info('Theme update data prepared:', $data);

            if (!empty($data)) {
                $preferences->update($data);
            }

            \Log::info('Theme updated successfully for user: ' . $user->id);

            $updatedFields = array_keys($data);
            $message = 'Pengaturan tema berhasil diperbarui!';
            if (count($updatedFields) > 0) {
                $message .= ' Field yang diupdate: ' . implode(', ', $updatedFields);
            }

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => $message
                ]);
            }

            return redirect()->route('theme.index')
                ->with('success', $message);
        } catch (\Exception $e) {
            \Log::error('Theme update error: ' . $e->getMessage());
            \Log::error('Theme update error trace: ' . $e->getTraceAsString());
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat memperbarui tema: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->route('theme.index')
                ->with('error', 'Terjadi kesalahan saat memperbarui tema.');
        }
    }

    /**
     * Reset theme to defaults.
     */
    public function reset()
    {
        try {
            $user = Auth::user();
            $preferences = $user->getPreferences();
            
            $preferences->update(UserPreference::getDefaults());

            if (request()->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Tema berhasil direset ke pengaturan default!'
                ]);
            }

            return redirect()->route('theme.index')
                ->with('success', 'Tema berhasil direset ke pengaturan default!');
        } catch (\Exception $e) {
            \Log::error('Theme reset error: ' . $e->getMessage());
            
            if (request()->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat mereset tema.'
                ], 500);
            }

            return redirect()->route('theme.index')
                ->with('error', 'Terjadi kesalahan saat mereset tema.');
        }
    }

    /**
     * Preview theme changes.
     */
    public function preview(Request $request)
    {
        try {
            $user = Auth::user();
            $preferences = $user->getPreferences();

            // Create temporary preferences for preview
            $tempPreferences = new UserPreference();
            $tempPreferences->fill($request->all());

            return response()->json([
                'success' => true,
                'css_variables' => $tempPreferences->getCssVariables(),
                'theme_colors' => $tempPreferences->getThemeColors(),
            ]);
        } catch (\Exception $e) {
            \Log::error('Theme preview error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat preview tema.',
                'css_variables' => [],
                'theme_colors' => [],
            ], 500);
        }
    }

    /**
     * Get current preferences as JSON.
     */
    public function getPreferences()
    {
        try {
            $user = Auth::user();
            $preferences = $user->getPreferences();

            return response()->json([
                'success' => true,
                'preferences' => $preferences,
                'css_variables' => $preferences->getCssVariables(),
                'theme_colors' => $preferences->getThemeColors(),
            ]);
        } catch (\Exception $e) {
            \Log::error('Theme getPreferences error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil preferensi tema.',
                'preferences' => null,
                'css_variables' => [],
                'theme_colors' => [],
            ], 500);
        }
    }

    /**
     * Apply theme to current session.
     */
    public function apply(Request $request)
    {
        try {
            $user = Auth::user();
            $preferences = $user->getPreferences();

            // Store theme in session for immediate effect
            session(['user_theme' => $preferences->getCssVariables()]);

            return response()->json([
                'success' => true,
                'message' => 'Tema berhasil diterapkan!',
            ]);
        } catch (\Exception $e) {
            \Log::error('Theme apply error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menerapkan tema.',
            ], 500);
        }
    }
}
