<?php

if ( !defined( 'ABSPATH' ) ) exit;

class PRanking_DB {
    var $wpdb;
    var $tables = array();

    function PRanking_DB () {
        // Get global object to work with DB
        $this->wpdb = $GLOBALS['wpdb'];
        // Table names
        $this->tables['reviews'] = $this->wpdb->prefix . 'post_reviews';
    }

    public function createTables () {
        // Reviews
        $sql = sprintf(
            'CREATE TABLE %s (
                id INT NOT NULL AUTO_INCREMENT
                , post_id BIGINT(20) NOT NULL
                , user_id BIGINT(20) NOT NULL
                , value INT(10) NOT NULL
                , comment TEXT NOT NULL
                , PRIMARY KEY (id) )
            ;',
            $this->tables['reviews']
        );
        $this->wpdb->query($sql);
    }

    function addReview($args){
        $sortedArgs = [
            'post_id' => $args['post_id'],
            'user_id' => $args['user_id'],
            'value' => $args['value'],
            'comment' => $args['comment']
        ];
        $this->wpdb->insert(
            $this->tables['reviews'],
            $sortedArgs,
            [ '%d', '%d', '%d', '%s' ]
        );
    }

    // Check if the current user has already reviewed the current post
    function userReviewedPost () {
        $sql = sprintf (
            "SELECT COUNT(id) FROM %s WHERE post_id = %d AND user_id = %d",
            $this->tables['reviews'], get_the_ID(), get_current_user_id()
        );
        return $this->wpdb->get_var($sql);
    }

}
