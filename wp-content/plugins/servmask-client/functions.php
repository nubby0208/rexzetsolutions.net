<?php
/**
 * Copyright (C) 2014-2019 ServMask Inc.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * ███████╗███████╗██████╗ ██╗   ██╗███╗   ███╗ █████╗ ███████╗██╗  ██╗
 * ██╔════╝██╔════╝██╔══██╗██║   ██║████╗ ████║██╔══██╗██╔════╝██║ ██╔╝
 * ███████╗█████╗  ██████╔╝██║   ██║██╔████╔██║███████║███████╗█████╔╝
 * ╚════██║██╔══╝  ██╔══██╗╚██╗ ██╔╝██║╚██╔╝██║██╔══██║╚════██║██╔═██╗
 * ███████║███████╗██║  ██║ ╚████╔╝ ██║ ╚═╝ ██║██║  ██║███████║██║  ██╗
 * ╚══════╝╚══════╝╚═╝  ╚═╝  ╚═══╝  ╚═╝     ╚═╝╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝
 */

/**
 * Return bytes of size string
 *
 * @param  string $size_str
 * @return string
 */
function smc_to_bytes( $size_str ) {
	switch ( substr( $size_str, -1 ) ) {
		case 'M':
		case 'm':
			return (int) $size_str * 1048576;
		case 'K':
		case 'k':
			return (int) $size_str * 1024;
		case 'G':
		case 'g':
			return (int) $size_str * 1073741824;
		default:
			return $size_str;
	}
}

/**
 * Get size of directory
 *
 * @param string $directory
 * @param array  $exclude_filters
 * @return string
 */
function smc_get_directory_size( $directory, $exclude_filters = array() ) {
	$directory = smc_normalize_path( $directory );
	$iterator  = new Smc_Recursive_Directory_Iterator( $directory );

	// Exclude new line file names
	$iterator = new Smc_Recursive_Newline_Filter( $iterator );

	if ( ! empty( $exclude_filters ) ) {
		// Exclude uploads, plugins or themes
		$iterator = new Ai1wm_Recursive_Exclude_Filter( $iterator, apply_filters( 'smc_exclude_content', $exclude_filters ) );
	}

	$size = 0;

	// Recursively iterate over directory
	$iterator = new RecursiveIteratorIterator( $iterator, RecursiveIteratorIterator::LEAVES_ONLY, RecursiveIteratorIterator::CATCH_GET_CHILD );

	foreach ( $iterator as $file ) {
		try {
			$size += $file->getSize();
		} catch ( Exception $e ) {
			// continue
		}
	}

	return $size;
}

/**
 * Get directory names and size of it
 *
 * @return array
 */
function smc_get_wp_content_dirs_and_size( $paths = array() ) {
	$dir_array = array();
	foreach ( $paths as $path ) {
		// 4096 - skip dots
		$iterator = new RecursiveDirectoryIterator( smc_normalize_path( $path ), 4096 );

		foreach ( $iterator as $path ) {
			if ( is_dir( $path ) ) {
				$dir_array[] = sprintf( '%s - %s', smc_normalize_path( $path ), size_format( smc_get_directory_size( $path ), 2 ) );
			}
		}
	}

	return $dir_array;
}

/**
 * Get all active plugin extensions with their dependencies
 *
 * @return array
*/
function smc_get_active_extensions() {
	$active_extensions = array();

	foreach ( smc_get_extensions() as $extension_name_const => $extension ) {
		if ( defined( $extension_name_const ) ) {
			$active_extensions[] = array(
				'label'        => $extension['label'],
				'is_supported' => smc_extensions_loaded( $extension['dependencies'] ),
			);
		}
	}

	return $active_extensions;
}


/**
 * Get latest version of the base plugin
 *
 * @return string
*/
function smc_get_base_plugin_latest_version() {
	$plugin_info = wp_remote_get( 'https://api.wordpress.org/plugins/info/1.0/all-in-one-wp-migration/all-in-one-wp-migration.php' );

	if ( is_array( $plugin_info ) ) {
		$body = unserialize( wp_remote_retrieve_body( $plugin_info ) );

		return $body->version;
	}

	return;
}

/**
 * Get DB total size in MB
 *
 * @return string
*/
function smc_get_db_total_size() {
	global $wpdb;

	$db_name = $wpdb->dbname;

	if ( empty( $wpdb->use_mysqli ) ) {
		$mysql = new Ai1wm_Database_Mysql( $wpdb );
	} else {
		$mysql = new Ai1wm_Database_Mysqli( $wpdb );
	}

	$query = "
		SELECT table_schema 'Db Name',
			ROUND(SUM(data_length + index_length), 2) 'b'
		FROM information_schema.TABLES
		WHERE table_schema = '$db_name'";

	$result = $mysql->fetch_row( $mysql->query( $query ) );
	return $result[1];
}

/**
 * Get DB Info
 *
 * @return array
*/
function smc_get_db_size() {
	global $wpdb;

	$db_name        = $wpdb->dbname;
	$db_tables_size = array();

	if ( empty( $wpdb->use_mysqli ) ) {
		$mysql = new Ai1wm_Database_Mysql( $wpdb );
	} else {
		$mysql = new Ai1wm_Database_Mysqli( $wpdb );
	}

	$query = "
		SELECT table_schema 'Db Name',
			ROUND(SUM(data_length + index_length) / 1024 / 1024, 2) 'mb'
		FROM information_schema.TABLES
		WHERE table_schema = '$db_name'";

	$result = $mysql->fetch_row( $mysql->query( $query ) );

	$db_tables_size[] = "Name - $db_name";
	$db_tables_size[] = sprintf( 'Total size - %s MB', $result[1] );

	$query = "
		SELECT
		     table_schema as `Db Name`,
		     table_name AS `Table Name`,
		     ROUND(((data_length + index_length) / 1024 / 1024), 2) `mb`
		FROM information_schema.TABLES
		WHERE table_schema = '$db_name'
		ORDER BY (data_length + index_length) DESC LIMIT 1";

	$result = $mysql->query( $query );

	while ( $row = $mysql->fetch_row( $result ) ) {
		$db_tables_size[] = sprintf( '%s - %s MB', $row[1], $row[2] );
	}

	return array( 'Db' => $db_tables_size );
}

/**
 * Get database version
 *
 * @return string
*/
function smc_get_db_version() {
	global $wpdb;

	if ( empty( $wpdb->use_mysqli ) ) {
		$mysql = new Ai1wm_Database_Mysql( $wpdb );
	} else {
		$mysql = new Ai1wm_Database_Mysqli( $wpdb );
	}

	return $mysql->version();
}

/**
 * Get error log file if exist from storage folder
 *
 * @return string
*/
function smc_get_storage_error_log() {
	if ( file_exists( AI1WM_ERROR_FILE ) ) {
		return SMC_ERROR_LOG_URL;
	}

	return false;
}

/**
 * Get debug log file if exist
 *
 * @return string
*/
function smc_get_debug_log() {
	if ( file_exists( smc_normalize_path( WP_CONTENT_DIR . DIRECTORY_SEPARATOR . 'debug.log' ) ) ) {
		return content_url() . DIRECTORY_SEPARATOR . 'debug.log';
	}

	return false;
}

/**
 * Get active plugins
 *
 * @return array
*/
function smc_get_active_plugins() {
	$active_plugins = array();

	foreach ( get_plugins() as $plugin => $info ) {
		if ( is_plugin_active( $plugin ) ) {
			array_push( $active_plugins, $info['Name'] );
		}
	}

	return array( 'Active plugins' => $active_plugins );
}

/**
 * Check if extension is loaded
 *
 * @param string $php_extensions
 * @return boolean
*/
function smc_extensions_loaded( $php_extensions ) {
	foreach ( $php_extensions as $php_extension ) {
		if ( ! extension_loaded( $php_extension ) ) {
			return false;
		}
	}

	return true;
}

function smc_get_extensions() {
	return array(
		'AI1WMZE_PLUGIN_NAME' => array(
			'label'        => 'Microsoft Azure Storage extension works',
			'dependencies' => array(
				'curl',
				'libxml',
				'simplexml',
			),
		),
		'AI1WMAE_PLUGIN_NAME' => array(
			'label'        => 'Backblaze B2 extension works',
			'dependencies' => array(
				'curl',
			),
		),
		'AI1WMVE_PLUGIN_NAME' => array(
			'label'        => 'Backup plugin works',
			'dependencies' => array(
				'ftp',
				'curl',
				'bcmath',
				'libxml',
				'simplexml',
			),
		),
		'AI1WMBE_PLUGIN_NAME' => array(
			'label'        => 'Box extension works',
			'dependencies' => array(
				'curl',
			),
		),
		'AI1WMIE_PLUGIN_NAME' => array(
			'label'        => 'DigitalOcean Spaces extension works',
			'dependencies' => array(
				'curl',
				'libxml',
				'simplexml',
			),
		),
		'AI1WMXE_PLUGIN_NAME' => array(
			'label'        => 'Direct extension works',
			'dependencies' => array(
				'curl',
			),
		),
		'AI1WMDE_PLUGIN_NAME' => array(
			'label'        => 'Dropbox extension works',
			'dependencies' => array(
				'curl',
			),
		),
		'AI1WMTE_PLUGIN_NAME' => array(
			'label'        => 'File extension works',
			'dependencies' => array(),
		),
		'AI1WMFE_PLUGIN_NAME' => array(
			'label'        => 'FTP extension works',
			'dependencies' => array(
				'ftp',
			),
		),
		'AI1WMCE_PLUGIN_NAME' => array(
			'label'        => 'Google Cloud Storage extension works',
			'dependencies' => array(
				'curl',
			),
		),
		'AI1WMGE_PLUGIN_NAME' => array(
			'label'        => 'Google Drive extension works',
			'dependencies' => array(
				'curl',
			),
		),
		'AI1WMRE_PLUGIN_NAME' => array(
			'label'        => 'Amazon Glacier extension works',
			'dependencies' => array(
				'curl',
			),
		),
		'AI1WMEE_PLUGIN_NAME' => array(
			'label'        => 'Mega extension works',
			'dependencies' => array(
				'curl',
				'bcmath',
			),
		),
		'AI1WMME_PLUGIN_NAME' => array(
			'label'        => 'Multisite extension works',
			'dependencies' => array(),
		),
		'AI1WMOE_PLUGIN_NAME' => array(
			'label'        => 'OneDrive extension works',
			'dependencies' => array(
				'curl',
				'libxml',
			),
		),
		'AI1WMPE_PLUGIN_NAME' => array(
			'label'        => 'pCloud extension works',
			'dependencies' => array(
				'curl',
			),
		),
		'AI1WMNE_PLUGIN_NAME' => array(
			'label'        => 'S3 Client extension works',
			'dependencies' => array(
				'curl',
				'libxml',
				'simplexml',
			),
		),
		'AI1WMSE_PLUGIN_NAME' => array(
			'label'        => 'Amazon S3 extension works',
			'dependencies' => array(
				'curl',
				'libxml',
				'simplexml',
			),
		),
		'AI1WMUE_PLUGIN_NAME' => array(
			'label'        => 'Unlimited extension works',
			'dependencies' => array(),
		),
		'AI1WMLE_PLUGIN_NAME' => array(
			'label'        => 'URL extension works',
			'dependencies' => array(
				'curl',
			),
		),
		'AI1WMWE_PLUGIN_NAME' => array(
			'label'        => 'WebDav extension works',
			'dependencies' => array(
				'curl',
				'libxml',
				'simplexml',
			),
		),
	);
}

function smc_normalize_path( $path ) {
	$path = str_replace( '\\', '/', $path );
	$path = preg_replace( '|(?<=.)/+|', '/', $path );
	if ( ':' === substr( $path, 1, 1 ) ) {
		$path = ucfirst( $path );
	}
	return $path;
}

function smc_check_expression( $expr ) {
	if ( $expr ) {
		return 'Yes';
	}

	return 'No';
}

function smc_got_url_rewrite() {
	if ( iis7_supports_permalinks() ) {
		return true;
	} elseif ( ! empty( $GLOBALS['is_nginx'] ) ) {
		return true;
	}

	return apache_mod_loaded( 'mod_rewrite', false );
}
