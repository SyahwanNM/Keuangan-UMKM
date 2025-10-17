// Logout Modal Global State
document.addEventListener('alpine:init', () => {
    // Global store for logout modal
    Alpine.store('logoutModal', {
        show: false,
        
        open() {
            this.show = true;
        },
        
        close() {
            this.show = false;
        }
    });
    
    // Global function for backward compatibility
    window.showLogoutModal = () => {
        Alpine.store('logoutModal').open();
    };
});
