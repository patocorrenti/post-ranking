<?php if (count($recentReviews)) : ?>
    <ul class="prank-recent-reviews">
        <?php foreach($recentReviews as $review) : ?>
            <li class="review">
                <div class="image">
                    <a href="<?php echo $review->permalink ?>">
                        <img src="<?php echo get_the_post_thumbnail_url($review->post_id) ?>" alt="">
                    </a>
                </div>
                <div class="data">
                    <div class="user">
                        <?php echo $review->name ?>
                    </div>
                    <div class="title">
                        <a href="<?php echo $review->permalink ?>">
                            <?php echo $review->post_title ?>
                        </a>
                    </div>
                    <div class="value">
                        <div class="graph">
                            <?php for($i=1; $i<=5; $i++) : ?>
                                <svg
                                    class="prank-star <?php if ($i > $review->value) echo 'empty' ?>"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24">
                                    <path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z"/>
                                </svg>
                            <?php endfor ?>
                        </div>
                        <div class="num">
                            <?php echo $review->value ?>
                        </div>
                    </div>
                    <div class="comment">
                        <?php echo nl2br(stripslashes($review->comment)) ?>
                    </div>
                </div>
            </li>
        <?php endforeach ?>
    </ul>
<?php else: ?>
    <p><?php _e('No hay reviews recientes', 'pranking') ?></p>
<?php endif ?>
