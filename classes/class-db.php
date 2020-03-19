<?php

if ( !defined( 'ABSPATH' ) ) exit;

class PRankin_DB {
    var $wpdb;
    var $tables = array();

    function PRankin_DB () {
        // Get global object to work with DB
        $this->wpdb = $GLOBALS['wpdb'];
        // Table names
        $this->tables['ranking'] = $this->wpdb->prefix . 'post_ranking';
    }

    public function createTables () {
        // Ranking
        $sql = sprintf(
            'CREATE TABLE %s (
                id INT NOT NULL AUTO_INCREMENT
                , post_id BIGINT(20) NOT NULL
                , user_id BIGINT(20) NOT NULL
                , value INT(10) NOT NULL
                , comment TEXT NOT NULL
                , PRIMARY KEY (id) )
            ;',
            $this->tables['ranking']
        );
        $this->wpdb->query($sql);
    }
}
