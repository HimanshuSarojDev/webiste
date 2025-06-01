<?php
// Theme setup
function otakutechie_setup() {
    // Add theme support
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support('custom-logo');
    add_theme_support('responsive-embeds');
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    
    // Set default thumbnail size
    set_post_thumbnail_size(400, 250, true);
    
    // Add custom image sizes
    add_image_size('post-thumbnail-large', 800, 400, true);
    add_image_size('post-thumbnail-small', 300, 200, true);
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => 'Primary Menu',
        'footer' => 'Footer Menu',
    ));
}
add_action('after_setup_theme', 'otakutechie_setup');

// Enqueue styles and scripts
function otakutechie_scripts() {
    // Main stylesheet
    wp_enqueue_style('otakutechie-style', get_stylesheet_uri(), array(), '2.0');
    
    // Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');
    
    // Google Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap', array(), null);
    
    // Custom JavaScript
    wp_enqueue_script('otakutechie-js', get_template_directory_uri() . '/js/main.js', array('jquery'), '2.0', true);
    
    // Localize script for AJAX
    wp_localize_script('otakutechie-js', 'otaku_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('otaku_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'otakutechie_scripts');

// Register widget areas
function otakutechie_widgets_init() {
    register_sidebar(array(
        'name'          => 'Main Sidebar',
        'id'            => 'sidebar-1',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => 'Footer Widget 1',
        'id'            => 'footer-1',
        'before_widget' => '<div class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => 'Footer Widget 2',
        'id'            => 'footer-2',
        'before_widget' => '<div class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => 'Footer Widget 3',
        'id'            => 'footer-3',
        'before_widget' => '<div class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'otakutechie_widgets_init');

// Custom post types for better organization
function create_custom_post_types() {
    // Anime Reviews
    register_post_type('anime_review', array(
        'labels' => array(
            'name' => 'Anime Reviews',
            'singular_name' => 'Anime Review',
            'add_new' => 'Add New Review',
            'add_new_item' => 'Add New Anime Review',
            'edit_item' => 'Edit Anime Review',
            'new_item' => 'New Anime Review',
            'view_item' => 'View Anime Review',
            'search_items' => 'Search Anime Reviews',
            'not_found' => 'No anime reviews found',
            'not_found_in_trash' => 'No anime reviews found in trash'
        ),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'capability_type' => 'post',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments'),
        'has_archive' => true,
        'rewrite' => array('slug' => 'anime-reviews'),
        'menu_icon' => 'dashicons-video-alt',
        'show_in_rest' => true,
    ));
    
    // Manga Reviews
    register_post_type('manga_review', array(
        'labels' => array(
            'name' => 'Manga Reviews',
            'singular_name' => 'Manga Review',
            'add_new' => 'Add New Review',
            'add_new_item' => 'Add New Manga Review',
            'edit_item' => 'Edit Manga Review',
            'new_item' => 'New Manga Review',
            'view_item' => 'View Manga Review',
            'search_items' => 'Search Manga Reviews',
            'not_found' => 'No manga reviews found',
            'not_found_in_trash' => 'No manga reviews found in trash'
        ),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'capability_type' => 'post',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments'),
        'has_archive' => true,
        'rewrite' => array('slug' => 'manga-reviews'),
        'menu_icon' => 'dashicons-book',
        'show_in_rest' => true,
    ));
    
    // Tech Reviews
    register_post_type('tech_review', array(
        'labels' => array(
            'name' => 'Tech Reviews',
            'singular_name' => 'Tech Review',
            'add_new' => 'Add New Review',
            'add_new_item' => 'Add New Tech Review',
            'edit_item' => 'Edit Tech Review',
            'new_item' => 'New Tech Review',
            'view_item' => 'View Tech Review',
            'search_items' => 'Search Tech Reviews',
            'not_found' => 'No tech reviews found',
            'not_found_in_trash' => 'No tech reviews found in trash'
        ),
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'capability_type' => 'post',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments'),
        'has_archive' => true,
        'rewrite' => array('slug' => 'tech-reviews'),
        'menu_icon' => 'dashicons-smartphone',
        'show_in_rest' => true,
    ));
}
add_action('init', 'create_custom_post_types');

// Custom taxonomies
function create_custom_taxonomies() {
    // Anime Genres
    register_taxonomy('anime_genre', 'anime_review', array(
        'labels' => array(
            'name' => 'Anime Genres',
            'singular_name' => 'Anime Genre',
        ),
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'anime-genre'),
    ));
    
    // Manga Genres
    register_taxonomy('manga_genre', 'manga_review', array(
        'labels' => array(
            'name' => 'Manga Genres',
            'singular_name' => 'Manga Genre',
        ),
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'manga-genre'),
    ));
    
    // Tech Categories
    register_taxonomy('tech_category', 'tech_review', array(
        'labels' => array(
            'name' => 'Tech Categories',
            'singular_name' => 'Tech Category',
        ),
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'tech-category'),
    ));
}
add_action('init', 'create_custom_taxonomies');

// Add excerpt support to pages
add_post_type_support('page', 'excerpt');

// Custom excerpt length
function otakutechie_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'otakutechie_excerpt_length');

// Custom excerpt more text
function otakutechie_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'otakutechie_excerpt_more');

// Add custom meta boxes for reviews
function add_review_meta_boxes() {
    add_meta_box(
        'review_rating',
        'Review Rating',
        'review_rating_callback',
        array('anime_review', 'manga_review', 'tech_review'),
        'side',
        'high'
    );
    
    add_meta_box(
        'review_details',
        'Review Details',
        'review_details_callback',
        array('anime_review', 'manga_review', 'tech_review'),
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_review_meta_boxes');

// Rating meta box callback
function review_rating_callback($post) {
    wp_nonce_field('review_rating_nonce', 'review_rating_nonce');
    $rating = get_post_meta($post->ID, '_review_rating', true);
    ?>
    <p>
        <label for="review_rating">Rating (1-10):</label>
        <input type="number" id="review_rating" name="review_rating" value="<?php echo esc_attr($rating); ?>" min="1" max="10" step="0.1" style="width: 100%;">
    </p>
    <?php
}

// Review details meta box callback
function review_details_callback($post) {
    wp_nonce_field('review_details_nonce', 'review_details_nonce');
    $pros = get_post_meta($post->ID, '_review_pros', true);
    $cons = get_post_meta($post->ID, '_review_cons', true);
    ?>
    <table style="width: 100%;">
        <tr>
            <td style="width: 50%; vertical-align: top;">
                <label for="review_pros"><strong>Pros:</strong></label>
                <textarea id="review_pros" name="review_pros" rows="5" style="width: 100%;"><?php echo esc_textarea($pros); ?></textarea>
            </td>
            <td style="width: 50%; vertical-align: top;">
                <label for="review_cons"><strong>Cons:</strong></label>
                <textarea id="review_cons" name="review_cons" rows="5" style="width: 100%;"><?php echo esc_textarea($cons); ?></textarea>
            </td>
        </tr>
    </table>
    <?php
}

// Save meta box data
function save_review_meta_boxes($post_id) {
    // Check nonces
    if (!isset($_POST['review_rating_nonce']) || !wp_verify_nonce($_POST['review_rating_nonce'], 'review_rating_nonce')) {
        return;
    }
    
    if (!isset($_POST['review_details_nonce']) || !wp_verify_nonce($_POST['review_details_nonce'], 'review_details_nonce')) {
        return;
    }
    
    // Check if autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // Check permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Save rating
    if (isset($_POST['review_rating'])) {
        update_post_meta($post_id, '_review_rating', sanitize_text_field($_POST['review_rating']));
    }
    
    // Save pros and cons
    if (isset($_POST['review_pros'])) {
        update_post_meta($post_id, '_review_pros', sanitize_textarea_field($_POST['review_pros']));
    }
    
    if (isset($_POST['review_cons'])) {
        update_post_meta($post_id, '_review_cons', sanitize_textarea_field($_POST['review_cons']));
    }
}
add_action('save_post', 'save_review_meta_boxes');

// Add custom CSS for admin
function otakutechie_admin_styles() {
    wp_enqueue_style('otakutechie-admin', get_template_directory_uri() . '/admin-style.css');
}
add_action('admin_enqueue_scripts', 'otakutechie_admin_styles');

// Optimize images for web
function otakutechie_optimize_images($image_data) {
    // Add WebP support
    add_filter('wp_image_editors', 'otakutechie_enable_webp_uploads');
    return $image_data;
}
add_filter('wp_handle_upload_prefilter', 'otakutechie_optimize_images');

function otakutechie_enable_webp_uploads($editors) {
    if (!in_array('WP_Image_Editor_GD', $editors)) {
        $editors[] = 'WP_Image_Editor_GD';
    }
    return $editors;
}

// Add WebP MIME type support
function otakutechie_webp_mime_types($mimes) {
    $mimes['webp'] = 'image/webp';
    return $mimes;
}
add_filter('upload_mimes', 'otakutechie_webp_mime_types');

// Security enhancements
function otakutechie_security_headers() {
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('X-XSS-Protection: 1; mode=block');
    header('Referrer-Policy: strict-origin-when-cross-origin');
}
add_action('send_headers', 'otakutechie_security_headers');

// Remove WordPress version from head
remove_action('wp_head', 'wp_generator');

// Disable XML-RPC
add_filter('xmlrpc_enabled', '__return_false');

// Performance optimizations
function otakutechie_performance_optimizations() {
    // Remove query strings from static resources
    function remove_query_strings($src) {
        $parts = explode('?', $src);
        return $parts[0];
    }
    add_filter('script_loader_src', 'remove_query_strings', 15, 1);
    add_filter('style_loader_src', 'remove_query_strings', 15, 1);
    
    // Defer JavaScript loading
    function defer_parsing_of_js($url) {
        if (is_admin()) return $url;
        if (FALSE === strpos($url, '.js')) return $url;
        if (strpos($url, 'jquery.js')) return $url;
        return str_replace(' src', ' defer src', $url);
    }
    add_filter('script_loader_tag', 'defer_parsing_of_js', 10);
}
add_action('init', 'otakutechie_performance_optimizations');

// Custom login page styling
function otakutechie_login_styles() {
    wp_enqueue_style('otakutechie-login', get_template_directory_uri() . '/login-style.css');
}
add_action('login_enqueue_scripts', 'otakutechie_login_styles');

// Change login logo URL
function otakutechie_login_logo_url() {
    return home_url();
}
add_filter('login_headerurl', 'otakutechie_login_logo_url');

// Change login logo title
function otakutechie_login_logo_title() {
    return get_bloginfo('name');
}
add_filter('login_headertitle', 'otakutechie_login_logo_title');

// Add theme customizer options
function otakutechie_customize_register($wp_customize) {
    // Add color scheme section
    $wp_customize->add_section('otakutechie_colors', array(
        'title' => 'OtakuTechie Colors',
        'priority' => 30,
    ));
    
    // Primary color
    $wp_customize->add_setting('primary_color', array(
        'default' => '#4ecdc4',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_color', array(
        'label' => 'Primary Color',
        'section' => 'otakutechie_colors',
        'settings' => 'primary_color',
    )));
    
    // Secondary color
    $wp_customize->add_setting('secondary_color', array(
        'default' => '#667eea',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'secondary_color', array(
        'label' => 'Secondary Color',
        'section' => 'otakutechie_colors',
        'settings' => 'secondary_color',
    )));
}
add_action('customize_register', 'otakutechie_customize_register');

// Output custom colors
function otakutechie_customize_css() {
    $primary_color = get_theme_mod('primary_color', '#4ecdc4');
    $secondary_color = get_theme_mod('secondary_color', '#667eea');
    ?>
    <style type="text/css">
        :root {
            --primary-color: <?php echo esc_html($primary_color); ?>;
            --secondary-color: <?php echo esc_html($secondary_color); ?>;
        }
    </style>
    <?php
}
add_action('wp_head', 'otakutechie_customize_css');

// Add social media links to customizer
function otakutechie_social_customizer($wp_customize) {
    $wp_customize->add_section('otakutechie_social', array(
        'title' => 'Social Media Links',
        'priority' => 35,
    ));
    
    $social_networks = array(
        'twitter' => 'Twitter',
        'facebook' => 'Facebook',
        'instagram' => 'Instagram',
        'youtube' => 'YouTube',
        'discord' => 'Discord',
        'reddit' => 'Reddit',
    );
    
    foreach ($social_networks as $network => $label) {
        $wp_customize->add_setting($network . '_url', array(
            'default' => '',
            'transport' => 'refresh',
        ));
        
        $wp_customize->add_control($network . '_url', array(
            'label' => $label . ' URL',
            'section' => 'otakutechie_social',
            'type' => 'url',
        ));
    }
}
add_action('customize_register', 'otakutechie_social_customizer');

// Breadcrumb function
function otakutechie_breadcrumbs() {
    if (!is_home()) {
        echo '<nav class="breadcrumbs">';
        echo '<a href="' . home_url() . '">Home</a> &raquo; ';
        
        if (is_category() || is_single()) {
            the_category(' &raquo; ');
            if (is_single()) {
                echo ' &raquo; ';
                the_title();
            }
        } elseif (is_page()) {
            the_title();
        }
        
        echo '</nav>';
    }
}

// Reading time function
function otakutechie_reading_time($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $content = get_post_field('post_content', $post_id);
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200); // 200 words per minute average
    
    return $reading_time . ' min read';
}

// Related posts function
function otakutechie_related_posts($post_id = null, $limit = 3) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $categories = wp_get_post_categories($post_id);
    
    if (empty($categories)) {
        return;
    }
    
    $args = array(
        'category__in' => $categories,
        'post__not_in' => array($post_id),
        'posts_per_page' => $limit,
        'orderby' => 'rand'
    );
    
    return new WP_Query($args);
}

// Add structured data for reviews
function otakutechie_structured_data() {
    if (is_singular(array('anime_review', 'manga_review', 'tech_review'))) {
        $rating = get_post_meta(get_the_ID(), '_review_rating', true);
        if ($rating) {
            ?>
            <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "Review",
                "name": "<?php echo esc_js(get_the_title()); ?>",
                "reviewRating": {
                    "@type": "Rating",
                    "ratingValue": "<?php echo esc_js($rating); ?>",
                    "bestRating": "10"
                },
                "author": {
                    "@type": "Person",
                    "name": "<?php echo esc_js(get_the_author()); ?>"
                },
                "datePublished": "<?php echo get_the_date('c'); ?>"
            }
            </script>
            <?php
        }
    }
}
add_action('wp_head', 'otakutechie_structured_data');

?>