<?php if (count($rankingList)) : ?>
    <ul class="prank-post_list">
    <?php foreach ($rankingList as $post) : ?>
        <?php $link = get_permalink($post->post_id) ?>
        <li>
            <article class="post_item">
                <a class="image" href="<?php echo $link ?>">
                    <img src="<?php echo get_the_post_thumbnail_url( $post->post_id) ?>" alt="" />
                </a>
                <a class="title" href="<?php echo $link ?>">
                    <?php echo get_the_title($post->post_id) ?>
                </a>
                <div class="average">
                    <?php echo PRanking_DB::roundAverage($post->average) ?>
                </div>
            </article>
        </li>
    <?php endforeach ?>
    </ul>
<?php endif ?>
