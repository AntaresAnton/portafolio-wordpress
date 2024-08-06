<aside id="sidebar" class="sidebar-compact">
    <div class="sidebar-inner">
        <div class="author-info">
            <?php
            $author_id = get_the_author_meta('ID');
            $author_avatar = get_avatar($author_id, 100);
            $author_name = get_the_author_meta('display_name');
            $author_bio = get_the_author_meta('description');
            ?>
            <div class="author-avatar">
                <?php echo $author_avatar; ?>
            </div>
            <h3 class="author-name"><?php echo $author_name; ?></h3>
            <p class="author-bio"><?php echo $author_bio; ?></p>
        </div>

        <div class="custom-message">
            <?php
            // You can edit this message in your functions.php or create a custom field
            $custom_message = get_option('sidebar_custom_message', 'Welcome to my blog!');
            echo wpautop($custom_message);
            ?>
        </div>

        <?php if (is_active_sidebar('main-sidebar')) : ?>
            <?php dynamic_sidebar('main-sidebar'); ?>
        <?php endif; ?>
    </div>
</aside>