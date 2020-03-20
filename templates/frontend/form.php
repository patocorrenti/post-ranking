<form action="#reviews" method="post" class="prank-review_form">
    <?php wp_nonce_field( 'prank_review') ?>
    <label for="prank-comment"><?php _e('Puntaje', 'pranking') ?>:</label>
    <div class="value" id="prank-value">
        <?php for ($i=1; $i<=5; $i++) : ?>
            <label data-value="<?php echo $i ?>" class="empty">
                <svg
                    class="prank-star"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24">
                    <path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z"/>
                </svg>
                <span class="number"><?php echo $i ?></span>
                <input class="input" type="radio" name="prank-value" value="<?php echo $i ?>" required>
            </label>
        <?php endfor ?>
    </div>
    <label for="prank-comment"><?php _e('Comentario', 'pranking') ?>:</label>
    <textarea id="prank-comment" name="prank-comment" cols="30" rows="10"></textarea>
    <button type="submit">
        <?php _e('Calificar', 'pranking') ?>
    </button>
</form>
