<form action="" method="post">
    <?php wp_nonce_field( 'prank_review') ?>
    <?php for ($i=1; $i<=5; $i++) : ?>
        <label>
            <span class="number"><?php echo $i ?></span>
            <input type="radio" name="prank-value" value="<?php echo $i ?>" required>
        </label>
    <?php endfor ?>
    <label for="prank-comment"><?php _e('Comentario', 'pranking') ?></label>
    <textarea id="prank-comment" name="prank-comment" cols="30" rows="10"></textarea>
    <button type="submit">
        <?php _e('Calificar', 'pranking') ?>
    </button>
</form>
