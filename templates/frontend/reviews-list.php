<div class="prank-review_totals">
    <div class="average">
        <?php echo $reviewTotals['average'] ?>
    </div>
    <div class="users">
        (<?php echo sprintf(__('%d reviews', 'pranking'), $reviewTotals['users']) ?>)
    </div>
</div>
<?php foreach($reviews as $review) : ?>
<ul class="prank-review_list">
    <li>
        <article class="review">
            <div class="value">
                <div class="graph">
                    <?php for($i=0; $i<$review->value; $i++) : ?>
                        <svg
                            class="prank-star"
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
            <div class="user">
                <span class="label"><?php _e('Usuario', 'pranking') ?>:</span>
                <span class="name"><?php echo $review->name ?></span>
            </div>
            <div>
                <?php echo nl2br($review->comment) ?>
            </div>
        </article>
    </li>
</ul>
<?php endforeach ?>
