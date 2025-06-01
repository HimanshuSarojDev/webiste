<?php get_header(); ?>

<main class="main-content" id="content">
    <h2 class="section-title">Latest Content</h2>
    
    <div class="posts-grid">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article class="post-card">
                <div class="post-thumbnail">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail(); ?>
                    <?php else : ?>
                        <i class="fas fa-tv"></i>
                    <?php endif; ?>
                </div>
                
                <div class="post-content">
                    <?php
                    $categories = get_the_category();
                    if (!empty($categories)) {
                        echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '" class="post-category">' . esc_html($categories[0]->name) . '</a>';
                    }
                    ?>
                    
                    <h3 class="post-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>
                    
                    <div class="post-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                    
                    <a href="<?php the_permalink(); ?>" class="read-more">Read More →</a>
                </div>
            </article>
        <?php endwhile; endif; ?>
    </div>
    
    <!-- Ad Space -->
    <div class="ad-space">
        <p><i class="fas fa-ad"></i> Advertisement Space - Google AdSense</p>
        <small>728x90 Leaderboard Ad</small>
    </div>
</main>

<?php get_footer(); ?>