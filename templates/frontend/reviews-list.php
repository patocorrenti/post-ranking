<div>
    <div>
        <span><?php _e('Calificaci&oacute;n', 'pranking') ?>:</span>
        <span><?php echo $reviewTotals['average'] ?></span>
    </div>
    <div>
        (<?php echo sprintf(__('%d reviews', 'pranking'), $reviewTotals['users']) ?>)
    </div>
</div>
<?php foreach($reviews as $review) : ?>
<ul>
    <li>
        <article>
            <div>
                <div>
                    <?php echo $review->value ?>
                </div>
                <div>
                    <?php for($i=0; $i<$review->value; $i++) : ?>
                        @
                    <?php endfor ?>
                </div>
            </div>
            <div>
                <?php _e('Usuario', 'pranking') ?>:
                <?php echo $review->name ?>
            </div>
            <div>
                <?php echo nl2br($review->comment) ?>
            </div>
        </article>
    </li>
</ul>
<?php endforeach ?>
