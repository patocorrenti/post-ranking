<?php

if ( !defined( 'ABSPATH' ) ) exit;

class PRanking_Frontend {

    var $Db;

    function PRanking_Frontend ($Db) {
        $this->Db = $Db;
        add_filter('the_content', [$this, 'renderReviews']);
    }

    function renderReviews ($content) {

        // Validation
        if (!is_single()) {
          return $content;
        }

        // Submit review
        $this->addReview();

        ob_start();
        // Get reviews
        $reviews = $this->Db->getPostReviews();
        if (count($reviews)) {
            $reviewTotals = $this->Db->getPostAverage();
            require( dirname(__FILE__) . '/../templates/frontend/reviews-list.php');
        }

        // Review form
        if (is_user_logged_in() && !$this->Db->userReviewedPost())
            require( dirname(__FILE__) . '/../templates/frontend/form.php');

        return $content .  ob_get_clean();
    }

    function addReview () {
        if (
            isset($_POST['prank-value']) && $_POST['prank-value']
            && isset($_POST['prank-comment'])
            && wp_verify_nonce( wp_unslash($_POST['_wpnonce']), 'prank_review')
        ) {
            $args = [
                'value' => $_POST['prank-value'],
                'comment' => $_POST['prank-comment']
            ];
            $this->Db->addReview($args);
        }
    }

}
