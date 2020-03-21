<?php

if ( !defined( 'ABSPATH' ) ) exit;

include_once( dirname(__FILE__) . '/./class-db.php' );
include_once( dirname(__FILE__) . '/./class-single.php' );
include_once( dirname(__FILE__) . '/./class-list.php' );
include_once( dirname(__FILE__) . '/./class-helper.php' );

class PRanking {

    var $Db;

    function PRanking () {
        $this->Db = new PRanking_DB();
        new PRanking_Single($this->Db);
        new PRanking_List($this->Db);
    }

}
