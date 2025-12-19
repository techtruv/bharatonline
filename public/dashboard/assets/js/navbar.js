/**
 * Responsive Navbar JavaScript
 * Handles hamburger menu toggle, dropdown functionality, and mobile responsiveness
 */

document.addEventListener('DOMContentLoaded', function () {
    // Get navbar elements
    const navbarToggler = document.querySelector('.navbar-toggler');
    const navbarCollapse = document.querySelector('.navbar-collapse');
    const navLinks = document.querySelectorAll('.nav-link');
    const dropdownToggles = document.querySelectorAll('[data-bs-toggle="dropdown"]');

    // Close navbar collapse when clicking on a non-dropdown link
    navLinks.forEach(link => {
        // Skip dropdown toggles
        if (!link.hasAttribute('data-bs-toggle')) {
            link.addEventListener('click', function () {
                if (navbarCollapse.classList.contains('show')) {
                    navbarToggler.click();
                }
            });
        }
    });

    // Handle dropdown menus on mobile
    if (window.innerWidth <= 991) {
        dropdownToggles.forEach(toggle => {
            toggle.addEventListener('click', function (e) {
                // Prevent default link behavior for dropdown toggles on mobile
                if (window.innerWidth <= 991) {
                    e.preventDefault();
                }
            });
        });
    }

    // Handle window resize
    window.addEventListener('resize', function () {
        if (window.innerWidth > 991) {
            // Close mobile menu if window is resized to desktop size
            if (navbarCollapse.classList.contains('show')) {
                navbarToggler.click();
            }
        }
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function (e) {
        dropdownToggles.forEach(toggle => {
            const dropdownMenu = toggle.nextElementSibling;
            if (dropdownMenu && dropdownMenu.classList.contains('dropdown-menu')) {
                if (!toggle.contains(e.target) && !dropdownMenu.contains(e.target)) {
                    dropdownMenu.classList.remove('show');
                    toggle.setAttribute('aria-expanded', 'false');
                }
            }
        });
    });

    // Highlight active links based on current route
    updateActiveLinks();

    // Update active links when navigation occurs
    window.addEventListener('popstate', updateActiveLinks);

    function updateActiveLinks() {
        const currentPath = window.location.pathname;
        const currentRoute = window.location.href;

        navLinks.forEach(link => {
            const href = link.getAttribute('href');

            // Remove active class first
            link.classList.remove('active');
            link.closest('.nav-item')?.classList.remove('active');

            // Add active class if link matches current location
            if (href && href !== '#') {
                // Exact match or path includes the href
                const isActive = currentPath === href || 
                                currentPath.startsWith(href + '/') ||
                                currentRoute.includes(href.split('/').pop());
                
                if (isActive) {
                    link.classList.add('active');
                    link.closest('.nav-item')?.classList.add('active');
                    
                    // Also activate parent dropdown if exists
                    const dropdown = link.closest('.dropdown');
                    if (dropdown) {
                        dropdown.querySelector('.dropdown-toggle')?.classList.add('active');
                    }
                }
            }
        });
    }
});

/**
 * Smooth scroll to anchor links
 */
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        const href = this.getAttribute('href');
        if (href !== '#' && document.querySelector(href)) {
            e.preventDefault();
            const target = document.querySelector(href);
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

/**
 * Add scroll effect to navbar
 */
let lastScrollTop = 0;
const navbar = document.querySelector('.navbar');

window.addEventListener('scroll', function () {
    if (navbar) {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        if (scrollTop > lastScrollTop) {
            // Scrolling down
            navbar.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.15)';
        } else {
            // Scrolling up
            navbar.style.boxShadow = '0 2px 8px rgba(0, 0, 0, 0.1)';
        }

        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
    }
});
