/**
 * OtakuTechie Theme JavaScript
 * Handles mobile navigation, smooth scrolling, and interactive elements
 */

(function($) {
    'use strict';

    // DOM Ready
    $(document).ready(function() {
        initMobileMenu();
        initSmoothScrolling();
        initHeaderScroll();
        initPostCardAnimations();
        initLazyLoading();
        initSearchEnhancements();
        initTooltips();
    });

    // Mobile Menu Functions
    function initMobileMenu() {
        const mobileToggle = $('.mobile-menu-toggle');
        const navigation = $('.main-navigation');
        const navLinks = $('.main-navigation a');
        const body = $('body');

        // Toggle mobile menu
        mobileToggle.on('click', function(e) {
            e.preventDefault();
            toggleMobileMenu();
        });

        // Close menu when clicking on links
        navLinks.on('click', function() {
            if (navigation.hasClass('active')) {
                toggleMobileMenu();
            }
        });

        // Close menu when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.site-header').length && navigation.hasClass('active')) {
                toggleMobileMenu();
            }
        });

        // Close menu on escape key
        $(document).on('keydown', function(e) {
            if (e.keyCode === 27 && navigation.hasClass('active')) {
                toggleMobileMenu();
            }
        });

        function toggleMobileMenu() {
            const icon = mobileToggle.find('i');
            
            navigation.toggleClass('active');
            body.toggleClass('mobile-menu-open');
            
            // Animate hamburger to X
            if (navigation.hasClass('active')) {
                icon.removeClass('fa-bars').addClass('fa-times');
                mobileToggle.attr('aria-expanded', 'true');
            } else {
                icon.removeClass('fa-times').addClass('fa-bars');
                mobileToggle.attr('aria-expanded', 'false');
            }
        }
    }

    // Smooth Scrolling
    function initSmoothScrolling() {
        $('a[href^="#"]').on('click', function(e) {
            const target = $(this.getAttribute('href'));
            
            if (target.length) {
                e.preventDefault();
                
                $('html, body').animate({
                    scrollTop: target.offset().top - 80
                }, 800, 'easeInOutQuart');
            }
        });
    }

    // Header Scroll Effects
    function initHeaderScroll() {
        const header = $('.site-header');
        let lastScrollTop = 0;
        let isScrolled = false;

        $(window).on('scroll', function() {
            const scrollTop = $(this).scrollTop();
            const windowHeight = $(window).height();

            // Add/remove scrolled class
            if (scrollTop > 100 && !isScrolled) {
                header.addClass('scrolled');
                isScrolled = true;
            } else if (scrollTop <= 100 && isScrolled) {
                header.removeClass('scrolled');
                isScrolled = false;
            }

            // Hide/show header on scroll (mobile only)
            if ($(window).width() <= 768) {
                if (scrollTop > lastScrollTop && scrollTop > windowHeight) {
                    // Scrolling down
                    header.addClass('header-hidden');
                } else {
                    // Scrolling up
                    header.removeClass('header-hidden');
                }
            }

            lastScrollTop = scrollTop;
        });
    }

    // Post Card Animations
    function initPostCardAnimations() {
        // Animate cards on scroll
        if (typeof IntersectionObserver !== 'undefined') {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-in');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });

            $('.post-card').each(function() {
                observer.observe(this);
            });
        }

        // Hover effects for touch devices
        $('.post-card').on('touchstart', function() {
            $(this).addClass('touch-hover');
        }).on('touchend', function() {
            setTimeout(() => {
                $(this).removeClass('touch-hover');
            }, 300);
        });
    }

    // Lazy Loading for Images
    function initLazyLoading() {
        if ('loading' in HTMLImageElement.prototype) {
            // Native lazy loading support
            $('img').attr('loading', 'lazy');
        } else {
            // Fallback for browsers without native support
            const imageObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        const src = img.getAttribute('data-src');
                        
                        if (src) {
                            img.setAttribute('src', src);
                            img.removeAttribute('data-src');
                            img.classList.add('loaded');
                        }
                        
                        imageObserver.unobserve(img);
                    }
                });
            });

            $('img[data-src]').each(function() {
                imageObserver.observe(this);
            });
        }
    }

    // Search Enhancements
    function initSearchEnhancements() {
        const searchForm = $('.search-form');
        const searchInput = searchForm.find('input[type="search"]');

        // Add search suggestions (if you implement AJAX search)
        searchInput.on('input', debounce(function() {
            const query = $(this).val();
            if (query.length >= 3) {
                // Implement AJAX search suggestions here
                performSearch(query);
            }
        }, 300));

        // Enhance search form
        searchForm.on('submit', function(e) {
            const query = searchInput.val().trim();
            if (query.length < 2) {
                e.preventDefault();
                searchInput.focus();
                showNotification('Please enter at least 2 characters to search', 'warning');
            }
        });
    }

    // Tooltips
    function initTooltips() {
        $('[data-tooltip]').each(function() {
            const $this = $(this);
            const tooltipText = $this.data('tooltip');
            
            $this.on('mouseenter', function() {
                showTooltip($this, tooltipText);
            }).on('mouseleave', function() {
                hideTooltip();
            });
        });
    }

    // Utility Functions
    function debounce(func, wait, immediate) {
        let timeout;
        return function() {
            const context = this;
            const args = arguments;
            const later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            const callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    }

    function performSearch(query) {
        // Implement AJAX search functionality
        $.ajax({
            url: otaku_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'otaku_search',
                query: query,
                nonce: otaku_ajax.nonce
            },
            success: function(response) {
                // Handle search results
                displaySearchResults(response);
            }
        });
    }

    function displaySearchResults(results) {
        // Display search results in dropdown
        console.log('Search results:', results);
    }

    function showTooltip(element, text) {
        const tooltip = $('<div class="tooltip">' + text + '</div>');
        $('body').append(tooltip);
        
        const offset = element.offset();
        const elementWidth = element.outerWidth();
        const elementHeight = element.outerHeight();
        const tooltipWidth = tooltip.outerWidth();
        
        tooltip.css({
            top: offset.top - tooltip.outerHeight() - 10,
            left: offset.left + (elementWidth / 2) - (tooltipWidth / 2)
        }).addClass('show');
    }

    function hideTooltip() {
        $('.tooltip').remove();
    }

    function showNotification(message, type = 'info') {
        const notification = $(`
            <div class="notification notification-${type}">
                <span>${message}</span>
                <button class="notification-close">&times;</button>
            </div>
        `);
        
        $('body').append(notification);
        
        setTimeout(() => {
            notification.addClass('show');
        }, 100);
        
        // Auto hide after 5 seconds
        setTimeout(() => {
            hideNotification(notification);
        }, 5000);
        
        // Close button
        notification.find('.notification-close').on('click', function() {
            hideNotification(notification);
        });
    }

    function hideNotification(notification) {
        notification.removeClass('show');
        setTimeout(() => {
            notification.remove();
        }, 300);
    }

    // Performance Monitoring
    function initPerformanceMonitoring() {
        // Monitor page load time
        window.addEventListener('load', function() {
            const loadTime = performance.timing.loadEventEnd - performance.timing.navigationStart;
            console.log('Page load time:', loadTime + 'ms');
            
            // Send analytics if needed
            if (typeof gtag !== 'undefined') {
                gtag('event', 'timing_complete', {
                    name: 'load',
                    value: loadTime
                });
            }
        });
    }

    // Initialize performance monitoring
    initPerformanceMonitoring();

    // Service Worker Registration (for PWA features)
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', function() {
            navigator.serviceWorker.register('/sw.js')
                .then(function(registration) {
                    console.log('SW registered: ', registration);
                }).catch(function(registrationError) {
                    console.log('SW registration failed: ', registrationError);
                });
        });
    }

    // Add custom easing function
    $.easing.easeInOutQuart = function(x, t, b, c, d) {
        if ((t /= d / 2) < 1) return c / 2 * t * t * t * t + b;
        return -c / 2 * ((t -= 2) * t * t * t - 2) + b;
    };

    // Expose functions globally if needed
    window.OtakuTechie = {
        showNotification: showNotification,
        hideNotification: hideNotification
    };

})(jQuery);

// Vanilla JavaScript for critical functionality (no jQuery dependency)
document.addEventListener('DOMContentLoaded', function() {
    // Critical CSS loading
    const criticalCSS = document.createElement('style');
    criticalCSS.innerHTML = `
        .post-card { opacity: 0; transform: translateY(20px); transition: all 0.6s ease; }
        .post-card.animate-in { opacity: 1; transform: translateY(0); }
        .header-hidden { transform: translateY(-100%); }
        .scrolled { backdrop-filter: blur(20px); }
        .touch-hover { transform: translateY(-5px) scale(1.02); }
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 20px;
            border-radius: 8px;
            color: white;
            z-index: 10000;
            transform: translateX(400px);
            transition: transform 0.3s ease;
        }
        .notification.show { transform: translateX(0); }
        .notification-info { background: #4ecdc4; }
        .notification-warning { background: #ff6b6b; }
        .notification-success { background: #45b7d1; }
        .tooltip {
            position: absolute;
            background: rgba(0,0,0,0.9);
            color: white;
            padding: 8px 12px;
            border-radius: 4px;
            font-size: 14px;
            z-index: 1000;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .tooltip.show { opacity: 1; }
        @media (max-width: 768px) {
            .mobile-menu-open { overflow: hidden; }
        }
    `;
    document.head.appendChild(criticalCSS);
});