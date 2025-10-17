<!-- Logout Confirmation Modal -->
<div x-data="{
    showModal: false,
    init() {
        // Fallback if store is not available
        if (!window.showLogoutModal) {
            window.showLogoutModal = () => {
                this.showModal = true;
            };
        }
    }
}">
    <!-- Modal Overlay -->
    <div x-show="$store.logoutModal?.show || showModal" 
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-[99999999] overflow-y-auto"
         style="background: rgba(0, 0, 0, 0.1); backdrop-filter: blur(2px);"
         @click="$store.logoutModal?.close() || (showModal = false)">
        
        <!-- Modal Container -->
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div x-show="$store.logoutModal?.show || showModal"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="relative transform overflow-hidden rounded-lg text-left transition-all sm:my-8 sm:w-full sm:max-w-lg logout-modal-popup"
                 @click.stop>
                
                <!-- Modal Content -->
                <div class="px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <!-- Warning Icon -->
                        <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full sm:mx-0 sm:h-10 sm:w-10"
                             style="background: var(--color-warning-light, #FEF3C7);">
                            <svg class="h-6 w-6" style="color: var(--color-warning, #F59E0B);" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                            </svg>
                        </div>
                        
                        <!-- Modal Body -->
                        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                            <h3 class="text-base font-semibold leading-6" style="color: var(--color-text, #1F2937);">
                                {{ __('Konfirmasi Logout') }}
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm" style="color: var(--color-text_secondary, #6B7280);">
                                    {{ __('Apakah Anda yakin ingin keluar dari aplikasi? Anda akan diarahkan ke halaman login.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Modal Actions -->
                <div class="px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6" style="background: var(--color-background, #F8FAFC); border-top: 1px solid var(--color-border, #E5E7EB);">
                    <!-- Logout Button -->
                    <form method="POST" action="{{ route('logout') }}" class="sm:ml-3">
                        @csrf
                        <button type="submit"
                                class="inline-flex w-full justify-center rounded-md px-3 py-2 text-sm font-semibold shadow-sm transition duration-150 ease-in-out sm:w-auto"
                                style="background: var(--color-danger, #EF4444); color: white;"
                                onmouseover="this.style.background='var(--color-danger-dark, #DC2626)'"
                                onmouseout="this.style.background='var(--color-danger, #EF4444)'">
                            {{ __('Ya, Keluar') }}
                        </button>
                    </form>
                    
                    <!-- Cancel Button -->
                    <button type="button"
                            @click="$store.logoutModal?.close() || (showModal = false)"
                            class="mt-3 inline-flex w-full justify-center rounded-md px-3 py-2 text-sm font-semibold shadow-sm ring-1 ring-inset transition duration-150 ease-in-out sm:mt-0 sm:w-auto"
                            style="background: var(--color-surface, #FFFFFF); color: var(--color-text, #1F2937); border: 1px solid var(--color-border, #E5E7EB);"
                            onmouseover="this.style.background='var(--color-background, #F8FAFC)'; this.style.color='var(--color-text, #1F2937)';"
                            onmouseout="this.style.background='var(--color-surface, #FFFFFF)'; this.style.color='var(--color-text, #1F2937)';">
                        {{ __('Batal') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>




