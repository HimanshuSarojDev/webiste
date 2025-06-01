<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#667eea">
    <meta name="description" content="<?php bloginfo('description'); ?>">

    <!-- Preconnect for speed -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="header-container">
        <a href="<?php echo home_url(); ?>" class="site-logo">
            <?php bloginfo('name'); ?>
        </a>

        <!-- Mobile Menu Toggle Button -->
        <button class="mobile-menu-toggle" aria-label="Toggle Menu">
            <i class="fas fa-bars" id="menu-icon"></i>
        </button>

        <nav class="main-navigation" id="main-nav">
            <?php
            if (has_nav_menu('primary')) {
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container' => false,
                    'menu_class' => 'nav-menu',
                    'fallback_cb' => false,
                ));
            } else {
                echo '<ul class="nav-menu">';
                echo '<li><a href="' . home_url() . '">Home</a></li>';
                echo '<li><a href="' . home_url('/anime-reviews') . '">Anime</a></li>';
                echo '<li><a href="' . home_url('/manga-reviews') . '">Manga</a></li>';
                echo '<li><a href="' . home_url('/tech-reviews') . '">Tech</a></li>';
                echo '<li><a href="' . home_url('/about') . '">About</a></li>';
                echo '<li><a href="' . home_url('/contact') . '">Contact</a></li>';
                echo '</ul>';
            }
            ?>
        </nav>
    </div>
</header>

<?php if (is_front_page()): ?>
<section class="hero-section">
    <div class="hero-content">
        <h1>Where Anime Meets Technology</h1>
        <p>Discover the latest anime reviews, manga insights, and cutting-edge tech reviews</p>
        <div class="hero-buttons">
            <a href="#content" class="btn btn-primary">Explore Content</a>
            <a href="#newsletter" class="btn btn-secondary">Join Community</a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ✅ Mobile Nav Script -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const menuToggle = document.querySelector('.mobile-menu-toggle');
    const nav = document.getElementById('main-nav');
    const icon = document.getElementById('menu-icon');

    if (menuToggle && nav && icon) {
        menuToggle.addEventListener('click', function () {
            nav.classList.toggle('active');
            icon.classList.toggle('fa-bars');
            icon.classList.toggle('fa-times');
        });

        // Auto close nav on link click
        nav.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                nav.classList.remove('active');
                icon.classList.add('fa-bars');
                icon.classList.remove('fa-times');
            });
        });
    }
});
</script>

<?php wp_footer(); ?>
</body>
</html>
