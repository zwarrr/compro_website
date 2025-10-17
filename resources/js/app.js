import './bootstrap';

// AJAX Navigation System
class AjaxNavigator {
    constructor() {
        this.isLoading = false;
        this.init();
    }

    init() {
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this.setup());
        } else {
            this.setup();
        }
    }

    setup() {
        console.log('🚀 AJAX Navigator initialized');

        // Get elements
        this.mainContent = document.getElementById('main-content');
        this.loadingBar = document.getElementById('loading-bar');
        this.loadingOverlay = document.getElementById('loading-overlay');

        if (!this.mainContent) {
            console.warn('⚠️ Main content not found');
            return;
        }

        // Setup event listeners
        this.setupLinkHandler();
        this.setupPopStateHandler();
        
        // Save initial state
        window.history.replaceState({ url: window.location.href }, document.title, window.location.href);
        
        // Update active menu
        this.updateActiveMenu(window.location.href);
    }

    setupLinkHandler() {
        document.addEventListener('click', (e) => {
            const link = e.target.closest('a');
            
            if (!link || !link.href) return;
            
            // Check if it's an internal link (same origin)
            try {
                const linkUrl = new URL(link.href);
                const currentUrl = new URL(window.location.href);
                
                // Only handle same-origin internal admin links
                if (linkUrl.origin !== currentUrl.origin) return;
                if (!linkUrl.pathname.includes('/admin/')) return;
            } catch (error) {
                // Invalid URL, let browser handle it
                return;
            }
            
            // Skip special links
            if (link.target === '_blank' || 
                link.href.includes('logout') ||
                link.closest('form') ||
                link.hasAttribute('data-no-ajax') ||
                link.download) {
                return;
            }

            // Prevent default navigation
            e.preventDefault();
            e.stopPropagation();
            
            console.log('📄 AJAX Loading:', link.href);
            
            // Load page via AJAX
            this.loadPage(link.href);
            this.closeMobileSidebar();
        }, true); // Use capture phase to catch event early
    }

    setupPopStateHandler() {
        window.addEventListener('popstate', (e) => {
            if (e.state && e.state.url) {
                this.loadPage(e.state.url, false);
            }
        });
    }

    showLoading() {
        if (this.isLoading) return;
        this.isLoading = true;
        
        console.log('⏳ Loading started');
        if (this.loadingBar) this.loadingBar.classList.remove('hidden');
        if (this.loadingOverlay) this.loadingOverlay.classList.remove('hidden');
    }

    hideLoading() {
        setTimeout(() => {
            this.isLoading = false;
            console.log('✓ Loading finished');
            if (this.loadingBar) this.loadingBar.classList.add('hidden');
            if (this.loadingOverlay) this.loadingOverlay.classList.add('hidden');
        }, 200);
    }

    async loadPage(url, pushState = true) {
        if (this.isLoading) {
            console.log('⏸️ Already loading, ignoring request');
            return;
        }

        this.showLoading();

        // Timeout protection
        const timeoutId = setTimeout(() => {
            console.warn('⏱️ Request timeout - falling back to regular navigation');
            this.hideLoading();
            window.location.href = url;
        }, 15000); // Increased timeout to 15 seconds

        try {
            console.log('🌐 Fetching:', url);
            
            const response = await fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'text/html, application/xhtml+xml',
                },
                credentials: 'same-origin',
                redirect: 'follow'
            });

            clearTimeout(timeoutId);

            if (!response.ok) {
                throw new Error(`HTTP ${response.status}: ${response.statusText}`);
            }

            const html = await response.text();
            
            // Check if response is actually HTML
            if (!html.includes('<html') && !html.includes('<!DOCTYPE')) {
                throw new Error('Invalid HTML response');
            }

            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            
            // Extract content
            const newContent = doc.querySelector('#main-content');
            const newTitle = doc.querySelector('title');

            if (!newContent) {
                throw new Error('Main content element not found in response');
            }

            console.log('✨ Content extracted, updating page...');

            // Fade out current content
            this.mainContent.style.opacity = '0';
            this.mainContent.style.transition = 'opacity 0.2s ease-in-out';
            await new Promise(resolve => setTimeout(resolve, 200));

            // Clean up old scripts and event listeners
            this.cleanupOldScripts();

            // Update content
            this.mainContent.innerHTML = newContent.innerHTML;
            if (newTitle) document.title = newTitle.textContent;

            // Execute new scripts
            this.executeScripts(newContent);

            // Fade in new content
            requestAnimationFrame(() => {
                this.mainContent.style.opacity = '1';
                this.mainContent.scrollTop = 0;
            });

            // Update history
            if (pushState && url !== window.location.href) {
                window.history.pushState({ url }, document.title, url);
            }

            // Update menu
            this.updateActiveMenu(url);

            // Dispatch page loaded event
            window.dispatchEvent(new CustomEvent('ajaxPageLoaded', { 
                detail: { url: url } 
            }));

            console.log('✅ Page loaded successfully');
            this.hideLoading();

        } catch (error) {
            clearTimeout(timeoutId);
            console.error('❌ AJAX Error:', error);
            console.log('↩️ Falling back to regular navigation');
            this.hideLoading();
            
            // Fallback to regular navigation
            window.location.href = url;
        }
    }

    stopBrowserLoading() {
        // Create an invisible iframe to stop the browser's loading indicator
        try {
            // Method 1: Stop window.stop() if available
            if (window.stop) {
                window.stop();
            }

            // Method 2: Complete the document loading state
            if (document.readyState !== 'complete') {
                // Create and immediately remove a script to signal completion
                const script = document.createElement('script');
                script.textContent = 'void(0);';
                document.head.appendChild(script);
                document.head.removeChild(script);
            }
        } catch (e) {
            // Silently fail if methods are not available
            console.log('⚠️ Could not stop browser loading indicator');
        }
    }

    notifyPageLoadComplete() {
        // Dispatch custom events to signal page load completion
        window.dispatchEvent(new Event('load'));
        window.dispatchEvent(new Event('DOMContentLoaded'));
        
        // Update document ready state
        try {
            Object.defineProperty(document, 'readyState', {
                value: 'complete',
                writable: false,
                configurable: true
            });
        } catch (e) {
            // Property might not be configurable
        }

        // Dispatch custom event for any listeners
        window.dispatchEvent(new CustomEvent('ajaxPageLoaded', { 
            detail: { url: window.location.href } 
        }));
    }

    cleanupOldScripts() {
        // Remove old dynamically added scripts
        const oldScripts = document.querySelectorAll('script[data-ajax-script]');
        oldScripts.forEach(script => script.remove());

        // Clear old modals if exist
        const oldModals = document.querySelectorAll('[id$="Modal"]');
        oldModals.forEach(modal => {
            if (!modal.closest('#main-content')) {
                modal.remove();
            }
        });

        // Clear global functions that might conflict
        const functionsToClean = [
            'openCreateModal', 'closeCreateModal',
            'openEditModal', 'closeEditModal',
            'showDetail', 'closeDetailModal',
            'confirmDelete', 'closeDeleteModal',
            'submitCreate', 'submitEdit', 'submitDelete',
            'clearErrors', 'displayErrors', 'showNotification'
        ];

        functionsToClean.forEach(funcName => {
            if (window[funcName]) {
                delete window[funcName];
            }
        });

        console.log('🧹 Cleaned up old scripts and functions');
    }

    executeScripts(content) {
        const scripts = content.querySelectorAll('script');
        
        scripts.forEach(oldScript => {
            const newScript = document.createElement('script');
            
            // Copy attributes
            Array.from(oldScript.attributes).forEach(attr => {
                newScript.setAttribute(attr.name, attr.value);
            });
            
            // Mark as ajax script for later cleanup
            newScript.setAttribute('data-ajax-script', 'true');
            
            // Copy content
            if (oldScript.src) {
                newScript.src = oldScript.src;
            } else {
                newScript.textContent = oldScript.textContent;
            }
            
            // Append to body to execute
            document.body.appendChild(newScript);
        });

        console.log(`📜 Executed ${scripts.length} scripts`);
    }

    updateActiveMenu(url) {
        const menuItems = document.querySelectorAll('nav a[href*="/admin/"]');
        
        // Parse URL to get pathname without query string
        const urlObj = new URL(url, window.location.origin);
        const currentPath = urlObj.pathname;
        
        menuItems.forEach(item => {
            const itemUrlObj = new URL(item.href, window.location.origin);
            const itemPath = itemUrlObj.pathname;
            
            // Check if the base route matches (without query parameters)
            const isActive = currentPath === itemPath || currentPath.startsWith(itemPath + '/');
            
            if (isActive) {
                item.classList.add('bg-primary', 'text-white', 'shadow-md');
                item.classList.remove('text-gray-700', 'hover:bg-gray-100');
                
                const iconDiv = item.querySelector('div.flex.items-center');
                if (iconDiv) {
                    const innerDiv = iconDiv.querySelector('div');
                    if (innerDiv) {
                        innerDiv.classList.remove('bg-gray-100', 'group-hover:bg-primary/10');
                        innerDiv.classList.add('bg-white/20');
                    }
                    const svg = iconDiv.querySelector('svg');
                    if (svg) {
                        svg.classList.remove('text-gray-600', 'group-hover:text-primary');
                        svg.classList.add('text-white');
                    }
                }
            } else {
                item.classList.remove('bg-primary', 'text-white', 'shadow-md');
                item.classList.add('text-gray-700', 'hover:bg-gray-100');
                
                const iconDiv = item.querySelector('div.flex.items-center');
                if (iconDiv) {
                    const innerDiv = iconDiv.querySelector('div');
                    if (innerDiv) {
                        innerDiv.classList.add('bg-gray-100', 'group-hover:bg-primary/10');
                        innerDiv.classList.remove('bg-white/20');
                    }
                    const svg = iconDiv.querySelector('svg');
                    if (svg) {
                        svg.classList.add('text-gray-600', 'group-hover:text-primary');
                        svg.classList.remove('text-white');
                    }
                }
            }
        });
        
        console.log(`✨ Updated active menu for: ${currentPath}`);
    }

    closeMobileSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        
        if (sidebar && !sidebar.classList.contains('-translate-x-full')) {
            sidebar.classList.add('-translate-x-full');
            if (overlay) overlay.classList.add('hidden');
        }
    }
}

// Initialize
new AjaxNavigator();
