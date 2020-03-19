<form action="" method="post" class="prank-review_form">
    <?php wp_nonce_field( 'prank_review') ?>
    <div class="value">
        <?php for ($i=1; $i<=5; $i++) : ?>
            <label>
                <span class="number"><?php echo $i ?></span>
                <input class="input" type="radio" name="prank-value" value="<?php echo $i ?>" required>
            </label>
        <?php endfor ?>
    </div>
    <label for="prank-comment"><?php _e('Comentario', 'pranking') ?></label>
    <textarea id="prank-comment" name="prank-comment" cols="30" rows="10"></textarea>
    <button type="submit">
        <?php _e('Calificar', 'pranking') ?>
    </button>
</form>
