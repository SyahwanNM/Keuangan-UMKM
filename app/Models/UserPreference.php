<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPreference extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'theme',
        'color_scheme',
        'font_size',
        'show_animations',
        'show_tooltips',
        'language',
        'date_format',
        'time_format',
        'number_format',
        'custom_colors',
    ];

    protected $casts = [
        'show_animations' => 'boolean',
        'show_tooltips' => 'boolean',
        'custom_colors' => 'array',
    ];

    /**
     * Get the user that owns the preferences.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get default preferences.
     */
    public static function getDefaults()
    {
        return [
            'theme' => 'light',
            'color_scheme' => 'blue',
            'font_size' => 'medium',
            'show_animations' => true,
            'show_tooltips' => true,
            'language' => 'id',
            'date_format' => 'd-m-Y',
            'time_format' => '24',
            'number_format' => 'dot',
            'custom_colors' => null,
        ];
    }

    /**
     * Get theme colors based on theme and color scheme.
     */
    public function getThemeColors()
    {
        try {
            // Base colors for light theme
            $lightColors = [
                'blue' => [
                    'primary' => '#3B82F6',
                    'secondary' => '#1E40AF',
                    'accent' => '#60A5FA',
                    'background' => '#F8FAFC',
                    'surface' => '#FFFFFF',
                    'text' => '#1F2937',
                    'text_secondary' => '#6B7280',
                ],
                'green' => [
                    'primary' => '#10B981',
                    'secondary' => '#047857',
                    'accent' => '#34D399',
                    'background' => '#F0FDF4',
                    'surface' => '#FFFFFF',
                    'text' => '#1F2937',
                    'text_secondary' => '#6B7280',
                ],
                'purple' => [
                    'primary' => '#8B5CF6',
                    'secondary' => '#7C3AED',
                    'accent' => '#A78BFA',
                    'background' => '#FAF5FF',
                    'surface' => '#FFFFFF',
                    'text' => '#1F2937',
                    'text_secondary' => '#6B7280',
                ],
                'red' => [
                    'primary' => '#EF4444',
                    'secondary' => '#DC2626',
                    'accent' => '#F87171',
                    'background' => '#FEF2F2',
                    'surface' => '#FFFFFF',
                    'text' => '#1F2937',
                    'text_secondary' => '#6B7280',
                ],
                'orange' => [
                    'primary' => '#F97316',
                    'secondary' => '#EA580C',
                    'accent' => '#FB923C',
                    'background' => '#FFF7ED',
                    'surface' => '#FFFFFF',
                    'text' => '#1F2937',
                    'text_secondary' => '#6B7280',
                ],
            ];

            // Dark theme colors - Dark base with color scheme accents
            $darkColors = [
                'blue' => [
                    'primary' => '#60A5FA',
                    'secondary' => '#3B82F6',
                    'accent' => '#93C5FD',
                    'background' => 'linear-gradient(135deg, #0F172A 0%, #1E293B 50%, #334155 100%)',
                    'surface' => 'linear-gradient(145deg, #1E293B 0%, #334155 100%)',
                    'text' => '#F1F5F9',
                    'text_secondary' => '#CBD5E1',
                ],
                'green' => [
                    'primary' => '#34D399',
                    'secondary' => '#10B981',
                    'accent' => '#6EE7B7',
                    'background' => 'linear-gradient(135deg, #0F172A 0%, #1E293B 50%, #334155 100%)',
                    'surface' => 'linear-gradient(145deg, #1E293B 0%, #334155 100%)',
                    'text' => '#F1F5F9',
                    'text_secondary' => '#CBD5E1',
                ],
                'purple' => [
                    'primary' => '#A78BFA',
                    'secondary' => '#8B5CF6',
                    'accent' => '#C4B5FD',
                    'background' => 'linear-gradient(135deg, #0F172A 0%, #1E293B 50%, #334155 100%)',
                    'surface' => 'linear-gradient(145deg, #1E293B 0%, #334155 100%)',
                    'text' => '#F1F5F9',
                    'text_secondary' => '#CBD5E1',
                ],
                'red' => [
                    'primary' => '#F87171',
                    'secondary' => '#EF4444',
                    'accent' => '#FCA5A5',
                    'background' => 'linear-gradient(135deg, #0F172A 0%, #1E293B 50%, #334155 100%)',
                    'surface' => 'linear-gradient(145deg, #1E293B 0%, #334155 100%)',
                    'text' => '#F1F5F9',
                    'text_secondary' => '#CBD5E1',
                ],
                'orange' => [
                    'primary' => '#FB923C',
                    'secondary' => '#F97316',
                    'accent' => '#FDBA74',
                    'background' => 'linear-gradient(135deg, #0F172A 0%, #1E293B 50%, #334155 100%)',
                    'surface' => 'linear-gradient(145deg, #1E293B 0%, #334155 100%)',
                    'text' => '#F1F5F9',
                    'text_secondary' => '#CBD5E1',
                ],
            ];

            // Choose color scheme based on theme
            $colorSchemes = $this->theme === 'dark' ? $darkColors : $lightColors;
            $colors = $colorSchemes[$this->color_scheme] ?? $colorSchemes['blue'];
            
            // Apply custom colors if any
            if ($this->custom_colors) {
                $colors = array_merge($colors, $this->custom_colors);
            }

            return $colors;
        } catch (\Exception $e) {
            \Log::error('UserPreference getThemeColors error: ' . $e->getMessage());
            // Return default blue colors if error
            return [
                'primary' => '#3B82F6',
                'secondary' => '#1E40AF',
                'accent' => '#60A5FA',
                'background' => '#F8FAFC',
                'surface' => '#FFFFFF',
                'text' => '#1F2937',
                'text_secondary' => '#6B7280',
            ];
        }
    }

    /**
     * Get CSS variables for theme.
     */
    public function getCssVariables()
    {
        try {
            $colors = $this->getThemeColors();
            $variables = [];
            
            foreach ($colors as $key => $value) {
                $variables["--color-{$key}"] = $value;
            }

            // Add font size
            $fontSizes = [
                'small' => '14px',
                'medium' => '16px',
                'large' => '18px',
            ];
            $variables['--font-size-base'] = $fontSizes[$this->font_size] ?? '16px';

            // Add additional color variants
            $variables['--color-primary-light'] = $this->getColorVariant($colors['primary'], 'light');
            $variables['--color-primary-dark'] = $this->getColorVariant($colors['primary'], 'dark');
            $variables['--color-primary-darker'] = $this->getColorVariant($colors['primary'], 'darker');
            $variables['--color-success-light'] = $this->getColorVariant('#10B981', 'light');
            $variables['--color-success-dark'] = $this->getColorVariant('#10B981', 'dark');
            $variables['--color-danger-light'] = $this->getColorVariant('#EF4444', 'light');
            $variables['--color-danger-dark'] = $this->getColorVariant('#EF4444', 'dark');
            $variables['--color-warning-light'] = $this->getColorVariant('#F59E0B', 'light');
            $variables['--color-warning-dark'] = $this->getColorVariant('#F59E0B', 'dark');
            $variables['--color-border'] = $this->getColorVariant($colors['text_secondary'], 'light');

            return $variables;
        } catch (\Exception $e) {
            \Log::error('UserPreference getCssVariables error: ' . $e->getMessage());
            // Return default variables if error
            return [
                '--color-primary' => '#3B82F6',
                '--color-secondary' => '#1E40AF',
                '--color-accent' => '#60A5FA',
                '--color-background' => '#F8FAFC',
                '--color-surface' => '#FFFFFF',
                '--color-text' => '#1F2937',
                '--color-text_secondary' => '#6B7280',
                '--font-size-base' => '16px',
            ];
        }
    }

    /**
     * Get color variant (light, dark, darker)
     */
    private function getColorVariant($color, $variant)
    {
        // Remove # if present
        $color = ltrim($color, '#');
        
        // Convert hex to RGB
        $r = hexdec(substr($color, 0, 2));
        $g = hexdec(substr($color, 2, 2));
        $b = hexdec(substr($color, 4, 2));
        
        switch ($variant) {
            case 'light':
                // Make color lighter by increasing RGB values
                $r = min(255, $r + 40);
                $g = min(255, $g + 40);
                $b = min(255, $b + 40);
                break;
            case 'dark':
                // Make color darker by decreasing RGB values
                $r = max(0, $r - 40);
                $g = max(0, $g - 40);
                $b = max(0, $b - 40);
                break;
            case 'darker':
                // Make color even darker
                $r = max(0, $r - 80);
                $g = max(0, $g - 80);
                $b = max(0, $b - 80);
                break;
        }
        
        return sprintf('#%02x%02x%02x', $r, $g, $b);
    }
}
