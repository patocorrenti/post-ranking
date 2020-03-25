<?php if (count($reviews)) : ?>
    <ul class="prank-recent-reviews">
        <?php foreach($reviews as $review) : ?>
            <li class="review">
                <div class="image">
                    <img src="<?php echo get_the_post_thumbnail_url($review->post_id) ?>" alt="">
                </div>
                <div class="data">
                    <div>
                        <?php echo $review->name ?>
                    </div>
                    <div>
                        <?php echo $review->post_title ?>
                    </div>
                    <div>
                        <?php echo $review->value ?>
                    </div>
                    <div>
                        <?php echo stripslashes($review->comment) ?>
                    </div>
                </div>
            </li>
        <?php endforeach ?>
    </ul>
<?php else: ?>
    <p><?php _e('No hay reviews recientes', 'pranking') ?></p>
<?php endif ?>
