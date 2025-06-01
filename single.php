<?php get_header(); ?>

<article class="single-post">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <header class="post-header">
            <h1><?php the_title(); ?></h1>
            <div class="post-meta">
                <span>By <?php the_author(); ?></span> | 
                <span><?php the_date(); ?></span> | 
                <span>
                    <?php
                    $categories = get_the_category();
                    if (!empty($categories)) {
                        echo esc_html($categories[0]->name);
                    }
                    ?>
                </span>
            </div>
        </header>
        
        <div class="post-content-single">
            <?php the_content(); ?>
        </div>
        
        <!-- Ad Space -->
        <div class="ad-space">
            <p><i class="fas fa-ad"></i> Advertisement Space</p>
            <small>300x250 Medium Rectangle</small>
        </div>
        
    <?php endwhile; endif; ?>
</article>

<?php get_footer(); ?>