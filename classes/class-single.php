<?php

if ( !defined( 'ABSPATH' ) ) exit;

class PRanking_Single {

    var $Db;

    function PRanking_Single ($Db) {
        $this->Db = $Db;
        add_action( 'wp_enqueue_scripts', [$this,'enqueue_scripts']);
        add_filter('the_content', [$this, 'renderReviews'], 999);
    }

    public function enqueue_scripts() {
        wp_enqueue_style( 'form', plugins_url('/../assets/custom/css/form.css', __FILE__));
        wp_enqueue_style( 'review-list', plugins_url('/../assets/custom/css/review-list.css', __FILE__));
        wp_enqueue_script( 'post-ranking', plugins_url('/../assets/custom/js/post-ranking.js', __FILE__), array('jquery'));
    }

    function renderReviews ($content) {

        // Validation
        if (!is_single()) {
          return $content;
        }

        // Submit review
        $this->addReview();

        ob_start();
        echo '<div id="reviews">';

        // Get reviews
        $reviews = $this->Db->getPostReviews();
        if (count($reviews)) {
            $reviewTotals = $this->Db->getPostAverage();
            require( dirname(__FILE__) . '/../templates/frontend/reviews-list.php');
        }

        // Review form
        if (is_user_logged_in() && !$this->Db->userReviewedPost())
            require( dirname(__FILE__) . '/../templates/frontend/form.php');

        echo '</div>';
        return $content . ob_get_clean();
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
