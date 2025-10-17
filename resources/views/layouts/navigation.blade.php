<nav x-data="{ open: false }" class="border-b navbar" style="border-color: var(--color-text_secondary, #6B7280); position: relative; z-index: 1000;">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current style="color: var(--color-text, #1F2937);"" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('transactions.index')" :active="request()->routeIs('transactions.*')">
                        {{ __('Transaksi') }}
                    </x-nav-link>
                    <x-nav-link :href="route('taxes.index')" :active="request()->routeIs('taxes.*')">
                        {{ __('Pajak') }}
                    </x-nav-link>
                    <x-nav-link :href="route('capitals.index')" :active="request()->routeIs('capitals.*')">
                        {{ __('Modal') }}
                    </x-nav-link>
                <x-nav-link :href="route('reports.index')" :active="request()->routeIs('reports.*')">
                    {{ __('Laporan') }}
                </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md transition ease-in-out duration-150" style="color: var(--color-text_secondary); background: var(--color-surface);">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">

                        <!-- Profile & Account -->
                        <div class="py-1">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profil Saya') }}
                            </x-dropdown-link>
                            
                            <x-dropdown-link :href="route('business-info.index')">
                                {{ __('Informasi Usaha') }}
                            </x-dropdown-link>
                        </div>

                        <!-- Settings -->
                        <div class="py-1 border-t border-gray-100 dark:border-slate-600">
                            <x-dropdown-link :href="route('theme.index')">
                                {{ __('Tema & Tampilan') }}
                            </x-dropdown-link>
                        </div>

                        <!-- Logout -->
                        <div class="py-1 border-t border-gray-100 dark:border-slate-600">
                            <x-dropdown-link href="#"
                                    onclick="event.preventDefault(); 
                                             if(typeof window.showLogoutModal === 'function') { 
                                                 window.showLogoutModal(); 
                                             } else { 
                                                 console.warn('Logout modal not initialized'); 
                                             }">
                                {{ __('Keluar') }}
                            </x-dropdown-link>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md style="color: var(--color-text_secondary, #9CA3AF);" hover:style="color: var(--color-text_secondary, #6B7280);" hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:style="color: var(--color-text_secondary, #6B7280);" transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('transactions.index')" :active="request()->routeIs('transactions.*')">
                {{ __('Transaksi') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('taxes.index')" :active="request()->routeIs('taxes.*')">
                {{ __('Pajak') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('capitals.index')" :active="request()->routeIs('capitals.*')">
                {{ __('Modal') }}
            </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('reports.index')" :active="request()->routeIs('reports.*')">
                    {{ __('Laporan') }}
                </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                        <span class="text-white font-semibold text-sm">{{ substr(Auth::user()->name, 0, 1) }}</span>
                    </div>
                    <div class="ml-3">
                <div class="font-medium text-base style="color: var(--color-text, #1F2937);"">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm style="color: var(--color-text_secondary, #6B7280);"">{{ Auth::user()->business_name ?? 'UMKM' }}</div>
                    </div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profil Saya') }}
                </x-responsive-nav-link>
                
                <x-responsive-nav-link :href="route('business-info.index')">
                    {{ __('Informasi Usaha') }}
                </x-responsive-nav-link>
                
                <x-responsive-nav-link :href="route('theme.index')">
                    {{ __('Tema & Tampilan') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <x-responsive-nav-link href="#"
                        onclick="event.preventDefault(); 
                                 if(typeof window.showLogoutModal === 'function') { 
                                     window.showLogoutModal(); 
                                 } else { 
                                     console.warn('Logout modal not initialized'); 
                                 }">
                    {{ __('Keluar') }}
                </x-responsive-nav-link>
            </div>
        </div>
    </div>
</nav>