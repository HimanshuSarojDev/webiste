<?php get_header(); ?>

<main class="main-content">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article class="single-post">
            <header class="post-header">
                <h1><?php the_title(); ?></h1>
            </header>
            
            <div class="post-content-single">
                <?php the_content(); ?>
            </div>
        </article>
    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>