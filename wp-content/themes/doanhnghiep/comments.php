<?php 

if (have_comments()) : ?>
    <ul class="post-comments">
        <?php
            wp_list_comments(array(
                'style'       => 'ul',
                'short_ping'  => true,
            ));
        ?>
    </ul>
    <?php
endif;