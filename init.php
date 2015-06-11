<?php
/*
Plugin Name:    SafeCode
Description:    Add snippets and custom functions, safe and secure.
Author:         Hassan Derakhshandeh
Version:        0.1.1
Author URI:     http://shazdeh.me/

		This program is free software; you can redistribute it and/or modify
		it under the terms of the GNU General Public License as published by
		the Free Software Foundation; either version 2 of the License, or
		(at your option) any later version.

		This program is distributed in the hope that it will be useful,
		but WITHOUT ANY WARRANTY; without even the implied warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
		GNU General Public License for more details.

		You should have received a copy of the GNU General Public License
		along with this program; if not, write to the Free Software
		Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

defined( 'ABSPATH' ) or die( '-1' );

class SafeCode {

	function __construct() {
		add_action( 'admin_menu', array( &$this, 'admin_menu' ) );
		add_action( 'plugins_loaded', array( &$this, 'exec_safecode' ) );
	}

	function admin_menu() {
		$page = add_options_page( 'SafeCode', 'SafeCode', 'manage_options', 'safecode', array( &$this, 'options_page' ) );
		add_action( "load-{$page}", array( &$this, 'save' ) );
	}

	function options_page() {
		require_once( trailingslashit( dirname( __FILE__ ) ) . 'views/admin.php' );
	}

	function save() {
		if( isset( $_POST['custom-functions'] ) ) {
			check_admin_referer( 'safecode_update' );
			update_option( 'safecode', stripcslashes( $_POST['custom-functions'] ) );
			$location = "options-general.php?page=safecode&updated=1&scrollto=" . ( isset( $_REQUEST['scrollto'] ) ? (int) $_REQUEST['scrollto'] : 0 );
			header( "Location: $location" );
		}
	}

	function exec_safecode() {
		$user_functions = get_option( 'safecode' );
		$user_functions = trim( $user_functions );
		$user_functions = trim( $user_functions, '<?php' );
		if( $user_functions ) {
			if( false === @eval( $user_functions ) ) {
				// error
			}
		}
	}
}
$safecode = new SafeCode;