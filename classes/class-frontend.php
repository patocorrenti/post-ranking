<?php

if ( !defined( 'ABSPATH' ) ) exit;

class PRanking_Frontend {

    var $Db;

    function PRanking_Frontend ($Db) {
        $this->Db = $Db;
        add_filter('the_content', [$this, 'reviewForm']);
    }

    function reviewForm ($content) {

        if (
            !is_user_logged_in()
            || !is_single()
            || $this->Db->userReviewedPost()
        ) {
          return $content;
        }

        ob_start();
        $this->addReview();
        require( dirname(__FILE__) . '/../templates/frontend/form.php');

        return $content . ob_get_clean();
    }

    function addReview () {
        if (
            isset($_POST['prank-value']) && $_POST['prank-value']
            && isset($_POST['prank-comment'])
            && wp_verify_nonce( wp_unslash($_POST['_wpnonce']), 'prank_review')
        ) {
            $args = [
                'post_id' => get_the_ID(),
                'user_id' => get_current_user_id(),
                'value' => $_POST['prank-value'],
                'comment' => $_POST['prank-comment']
            ];
            $this->Db->addReview($args);
        }
    }

}
