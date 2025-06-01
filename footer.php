<footer class="site-footer">
    <div class="footer-content">
        <div class="footer-section">
            <h3><?php bloginfo('name'); ?></h3>
            <p><?php bloginfo('description'); ?></p>
        </div>
        
        <div class="footer-section">
            <h3>Anime Content</h3>
            <ul>
                <li><a href="<?php echo home_url('/anime-reviews'); ?>">Anime Reviews</a></li>
                <li><a href="<?php echo home_url('/manga-reviews'); ?>">Manga Reviews</a></li>
                <li><a href="#">Trailer Analysis</a></li>
                <li><a href="#">Seasonal Guides</a></li>
            </ul>
        </div>
        
        <div class="footer-section">
            <h3>Tech Content</h3>
            <ul>
                <li><a href="<?php echo home_url('/tech-reviews'); ?>">Tech Reviews</a></li>
                <li><a href="#">Software Guides</a></li>
                <li><a href="#">Mobile Apps</a></li>
                <li><a href="#">Gaming Tech</a></li>
            </ul>
        </div>
        
        <div class="footer-section">
            <h3>Site Info</h3>
            <ul>
                <li><a href="<?php echo home_url('/about'); ?>">About Us</a></li>
                <li><a href="<?php echo home_url('/contact'); ?>">Contact</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Terms of Service</a></li>
            </ul>
        </div>
    </div>
    
    <div class="footer-bottom">
        <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?> - All rights reserved.</p>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>