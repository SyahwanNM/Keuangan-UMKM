// Global theme management
document.addEventListener('DOMContentLoaded', function() {
    // Function to apply theme based on data-theme attribute
    function applyTheme() {
        const theme = document.body.getAttribute('data-theme') || 'light';
        console.log('Applying theme:', theme);
        console.log('Body data-theme attribute:', document.body.getAttribute('data-theme'));
        console.log('Current theme detection:', theme);
        
        // Apply theme-specific styles
        if (theme === 'light') {
            // Light theme colors
            const lightColors = {
                '--color-primary': '#3B82F6',
                '--color-secondary': '#1E40AF',
                '--color-accent': '#60A5FA',
                '--color-background': '#F8FAFC',
                '--color-surface': '#FFFFFF',
                '--color-text': '#1F2937',
                '--color-text_secondary': '#6B7280',
            };
            
            const root = document.documentElement;
            Object.entries(lightColors).forEach(([key, value]) => {
                root.style.setProperty(key, value);
            });
        } else if (theme === 'dark') {
            // Dark theme colors
            const darkColors = {
                '--color-primary': '#60A5FA',
                '--color-secondary': '#3B82F6',
                '--color-accent': '#93C5FD',
                '--color-background': 'linear-gradient(135deg, #0F172A 0%, #1E293B 50%, #334155 100%)',
                '--color-surface': 'linear-gradient(145deg, #1E293B 0%, #334155 100%)',
                '--color-text': '#F1F5F9',
                '--color-text_secondary': '#CBD5E1',
            };
            
            const root = document.documentElement;
            Object.entries(darkColors).forEach(([key, value]) => {
                root.style.setProperty(key, value);
            });
        }
        
        // Force dropdown theme update
        updateDropdownTheme(theme);
    }
    
    // Function to update dropdown theme
    function updateDropdownTheme(theme) {
        // Force update CSS variables
        const root = document.documentElement;
        
        if (theme === 'light') {
            // Light theme colors
            root.style.setProperty('--color-primary', '#3B82F6');
            root.style.setProperty('--color-secondary', '#1E40AF');
            root.style.setProperty('--color-accent', '#60A5FA');
            root.style.setProperty('--color-background', '#F8FAFC');
            root.style.setProperty('--color-surface', '#FFFFFF');
            root.style.setProperty('--color-text', '#1F2937');
            root.style.setProperty('--color-text_secondary', '#6B7280');
        } else {
            // Dark theme colors
            root.style.setProperty('--color-primary', '#60A5FA');
            root.style.setProperty('--color-secondary', '#3B82F6');
            root.style.setProperty('--color-accent', '#93C5FD');
            root.style.setProperty('--color-background', 'linear-gradient(135deg, #0F172A 0%, #1E293B 50%, #334155 100%)');
            root.style.setProperty('--color-surface', 'linear-gradient(145deg, #1E293B 0%, #334155 100%)');
            root.style.setProperty('--color-text', '#F1F5F9');
            root.style.setProperty('--color-text_secondary', '#CBD5E1');
        }
        
        // Force dropdown styling update with hardcoded colors and !important
        const dropdowns = document.querySelectorAll('.dropdown > div');
        dropdowns.forEach(dropdown => {
            if (theme === 'light') {
                dropdown.style.setProperty('background', '#FFFFFF', 'important');
                dropdown.style.setProperty('color', '#1F2937', 'important');
                dropdown.style.setProperty('border', '1px solid #6B7280', 'important');
                dropdown.style.setProperty('box-shadow', '0 10px 25px rgba(0, 0, 0, 0.1)', 'important');
            } else {
                dropdown.style.setProperty('background', 'rgba(15, 23, 42, 0.95)', 'important');
                dropdown.style.setProperty('color', '#F1F5F9', 'important');
                dropdown.style.setProperty('border', '1px solid #60A5FA', 'important');
                dropdown.style.setProperty('box-shadow', '0 10px 40px rgba(0, 0, 0, 0.4)', 'important');
            }
        });
        
        const dropdownItems = document.querySelectorAll('.dropdown-item');
        dropdownItems.forEach(item => {
            if (theme === 'light') {
                item.style.setProperty('color', '#1F2937', 'important');
                item.style.setProperty('background', '#FFFFFF', 'important');
            } else {
                item.style.setProperty('color', '#CBD5E1', 'important');
                item.style.setProperty('background', 'transparent', 'important');
            }
        });
    }
    
    // Apply theme on page load
    applyTheme();
    
    // Force theme check every 1000ms to ensure dropdown uses correct theme (reduced frequency)
    setInterval(() => {
        const theme = document.body.getAttribute('data-theme') || 'light';
        const dropdowns = document.querySelectorAll('.dropdown > div');
        
        dropdowns.forEach((dropdown, index) => {
            const isVisible = dropdown.style.display !== 'none' && dropdown.offsetParent !== null;
            
            if (isVisible) {
                if (theme === 'light') {
                    dropdown.style.setProperty('background', '#FFFFFF', 'important');
                    dropdown.style.setProperty('color', '#1F2937', 'important');
                    dropdown.style.setProperty('border', '1px solid #6B7280', 'important');
                    dropdown.style.setProperty('box-shadow', '0 10px 25px rgba(0, 0, 0, 0.1)', 'important');
                } else {
                    dropdown.style.setProperty('background', 'rgba(15, 23, 42, 0.95)', 'important');
                    dropdown.style.setProperty('color', '#F1F5F9', 'important');
                    dropdown.style.setProperty('border', '1px solid #60A5FA', 'important');
                    dropdown.style.setProperty('box-shadow', '0 10px 40px rgba(0, 0, 0, 0.4)', 'important');
                }
                
                // Force dropdown items theme
                const dropdownItems = dropdown.querySelectorAll('a');
                dropdownItems.forEach((item, itemIndex) => {
                    if (theme === 'light') {
                        item.style.setProperty('color', '#1F2937', 'important');
                        item.style.setProperty('background', '#FFFFFF', 'important');
                    } else {
                        item.style.setProperty('color', '#CBD5E1', 'important');
                        item.style.setProperty('background', 'transparent', 'important');
                    }
                });
            }
        });
    }, 1000);
    
    // Watch for Alpine.js dropdown state changes
    document.addEventListener('alpine:init', () => {
        console.log('Alpine.js initialized, setting up dropdown theme directive');
        Alpine.directive('dropdown-theme', (el, { expression }, { effect, cleanup }) => {
            effect(() => {
                const theme = document.body.getAttribute('data-theme') || 'light';
                console.log('Alpine directive triggered, theme:', theme);
                const dropdowns = document.querySelectorAll('.dropdown > div');
                dropdowns.forEach((dropdown, index) => {
                    console.log(`Alpine updating dropdown ${index}`);
                    if (theme === 'light') {
                        dropdown.style.setProperty('background', '#FFFFFF', 'important');
                        dropdown.style.setProperty('color', '#1F2937', 'important');
                        dropdown.style.setProperty('border', '1px solid #6B7280', 'important');
                        dropdown.style.setProperty('box-shadow', '0 10px 25px rgba(0, 0, 0, 0.1)', 'important');
                    } else {
                        dropdown.style.setProperty('background', 'rgba(15, 23, 42, 0.95)', 'important');
                        dropdown.style.setProperty('color', '#F1F5F9', 'important');
                        dropdown.style.setProperty('border', '1px solid #60A5FA', 'important');
                        dropdown.style.setProperty('box-shadow', '0 10px 40px rgba(0, 0, 0, 0.4)', 'important');
                    }
                });
            });
        });
    });
    
    // Watch for Alpine.js x-show changes
    document.addEventListener('alpine:init', () => {
        Alpine.directive('show', (el, { expression }, { effect, cleanup }) => {
            effect(() => {
                if (el.style.display !== 'none') {
                    console.log('Alpine x-show triggered, updating dropdown theme');
                    const theme = document.body.getAttribute('data-theme') || 'light';
                    if (theme === 'light') {
                        el.style.setProperty('background', '#FFFFFF', 'important');
                        el.style.setProperty('color', '#1F2937', 'important');
                        el.style.setProperty('border', '1px solid #6B7280', 'important');
                        el.style.setProperty('box-shadow', '0 10px 25px rgba(0, 0, 0, 0.1)', 'important');
                    } else {
                        el.style.setProperty('background', 'rgba(15, 23, 42, 0.95)', 'important');
                        el.style.setProperty('color', '#F1F5F9', 'important');
                        el.style.setProperty('border', '1px solid #60A5FA', 'important');
                        el.style.setProperty('box-shadow', '0 10px 40px rgba(0, 0, 0, 0.4)', 'important');
                    }
                }
            });
        });
    });
    
    // Watch for theme changes
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === 'attributes' && mutation.attributeName === 'data-theme') {
                applyTheme();
            }
        });
    });
    
    observer.observe(document.body, {
        attributes: true,
        attributeFilter: ['data-theme']
    });
    
    // Force dropdown z-index and theme on every dropdown interaction
    document.addEventListener('click', function(e) {
        // Only handle dropdown clicks, don't interfere with other clicks
        if (e.target.closest('.dropdown')) {
            const theme = document.body.getAttribute('data-theme') || 'light';
            const dropdowns = document.querySelectorAll('.dropdown > div');
            dropdowns.forEach(dropdown => {
                dropdown.style.zIndex = '99999999';
                dropdown.style.position = 'absolute';
                
                // Force theme colors with !important
                if (theme === 'light') {
                    dropdown.style.setProperty('background', '#FFFFFF', 'important');
                    dropdown.style.setProperty('color', '#1F2937', 'important');
                    dropdown.style.setProperty('border', '1px solid #6B7280', 'important');
                    dropdown.style.setProperty('box-shadow', '0 10px 25px rgba(0, 0, 0, 0.1)', 'important');
                } else {
                    dropdown.style.setProperty('background', 'rgba(15, 23, 42, 0.95)', 'important');
                    dropdown.style.setProperty('color', '#F1F5F9', 'important');
                    dropdown.style.setProperty('border', '1px solid #60A5FA', 'important');
                    dropdown.style.setProperty('box-shadow', '0 10px 40px rgba(0, 0, 0, 0.4)', 'important');
                }
            });
            
            // Force dropdown items theme with !important
            const dropdownItems = document.querySelectorAll('.dropdown-item');
            dropdownItems.forEach(item => {
                if (theme === 'light') {
                    item.style.setProperty('color', '#1F2937', 'important');
                    item.style.setProperty('background', '#FFFFFF', 'important');
                } else {
                    item.style.setProperty('color', '#CBD5E1', 'important');
                    item.style.setProperty('background', 'transparent', 'important');
                }
            });
        }
    }, { passive: true });
    
    // Watch for any DOM changes that might affect dropdown
    const dropdownObserver = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === 'childList' || mutation.type === 'attributes') {
                const theme = document.body.getAttribute('data-theme') || 'light';
                const dropdowns = document.querySelectorAll('.dropdown > div');
                dropdowns.forEach(dropdown => {
                    if (dropdown.style.display !== 'none') {
                        if (theme === 'light') {
                            dropdown.style.setProperty('background', '#FFFFFF', 'important');
                            dropdown.style.setProperty('color', '#1F2937', 'important');
                            dropdown.style.setProperty('border', '1px solid #6B7280', 'important');
                            dropdown.style.setProperty('box-shadow', '0 10px 25px rgba(0, 0, 0, 0.1)', 'important');
                        } else {
                            dropdown.style.setProperty('background', 'rgba(15, 23, 42, 0.95)', 'important');
                            dropdown.style.setProperty('color', '#F1F5F9', 'important');
                            dropdown.style.setProperty('border', '1px solid #60A5FA', 'important');
                            dropdown.style.setProperty('box-shadow', '0 10px 40px rgba(0, 0, 0, 0.4)', 'important');
                        }
                    }
                });
            }
        });
    });
    
    // Start observing
    dropdownObserver.observe(document.body, {
        childList: true,
        subtree: true,
        attributes: true,
        attributeFilter: ['style', 'class']
    });
});
