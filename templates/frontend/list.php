<?php if($rankingQuery->have_posts()) : ?>
    <ul class="prank-post_list" id="post-list">
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
<?php if(empty($args['no_pagination'])) : ?>
<div class="pagination">
    <?php
        echo paginate_links( array(
            'total'             => $rankingQuery->max_num_pages,
            'current'           => max( 1, get_query_var( 'paged' ) ),
            'format'            => '?paged=%#%#post-list',
            'show_all'          => false,
            'type'              => 'plain',
            'end_size'          => 2,
            'mid_size'          => 1,
            'prev_next'         => true,
            'prev_text'         => sprintf( '<i></i> %1$s', __( 'M&aacute;s recientes', 'pranking' ) ),
            'next_text'         => sprintf( '%1$s <i></i>', __( 'Anteriores', 'pranking' ) ),
            'add_args'          => false,
            'add_fragment'      => '',
        ) );
    ?>
</div>
<?php endif ?>
