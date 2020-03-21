<?php
/*
Plugin Name: Post Ranking
Plugin URI:
Description: Ranquea los posts
Version: 0.2
Author: Pato Correnti
Author URI: http://patocorrenti.com
License: GPL2
Text Domain: pranking
Domain Path: /i18n/languages/
Copyright 2016 PatoCorrenti  (email : patocorrenti@gmail.com)
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if ( ! defined( 'ABSPATH' ) ) exit;

include_once( 'classes/class-pranking.php' );

new PRanking();

// Enable Plugin
register_activation_hook( __FILE__, function () {
    $Db = new PRanking_DB();
    $Db->createTables();
});
