<?php if($rankingQuery->have_posts()) : ?>
    <ul class="prank-post_list">
    <?php while ($rankingQuery->have_posts()) : $rankingQuery->the_post(); ?>
        <?php $average = PRanking_Helper::getAverage(get_the_ID()) ?>
        <li>
            <article class="post_item">
                <a class="image" href="<?php the_permalink() ?>">
                    <img src="<?php echo get_the_post_thumbnail_url() ?>" alt="" />
                </a>
                <a class="title" href="<?php the_permalink() ?>">
                    <?php the_title() ?>
                </a>
                <?php if ($average) : ?>
                    <div class="average">
                        <?php echo $average ?>
                    </div>
                <?php endif ?>
            </article>
        </li>
    <?php endwhile ?>
    </ul>
<?php endif ?>
