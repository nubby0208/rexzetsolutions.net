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
class Smc_Main_Controller {

	public function __construct() {
		$this->activate_actions();
	}

	/**
	 * Register hooks
	 */
	private function activate_actions() {
		add_action( 'plugins_loaded', array( $this, 'smc_loaded' ), 20 );
		add_action( 'plugins_loaded', array( $this, 'smc_handle_export_pdf' ), 20 );
		add_action( 'admin_enqueue_scripts', array( $this, 'register_scripts_and_styles' ), 25 );
		add_action( 'admin_init', array( $this, 'router' ) );
	}

	/**
	 * Check whether All in One WP Migration has been loaded
	 *
	 * @return void
	 */
	public function smc_loaded() {
		if ( ! defined( 'AI1WM_PLUGIN_NAME' ) ) {
			if ( is_multisite() ) {
				add_action( 'network_admin_notices', array( $this, 'smc_notice' ) );
			} else {
				add_action( 'admin_notices', array( $this, 'smc_notice' ) );
			}
		} else {
			if ( is_multisite() ) {
				add_action( 'network_admin_menu', array( $this, 'admin_menu' ), 20 );
			} else {
				add_action( 'admin_menu', array( $this, 'admin_menu' ), 20 );
			}
		}
	}

	/**
	 * Display All in one WP Migration notice
	 *
	 * @return void
	 */
	public function smc_notice() {
		?>
		<div class="error">
			<p>
				<?php
				_e(
					'ServMask Client plugin requires <a href="https://wordpress.org/plugins/all-in-one-wp-migration/" target="_blank">All-in-One WP Migration plugin</a> to be activated. ',
					SMC_PLUGIN_NAME
				);
				?>
			</p>
		</div>
		<?php
	}

	/**
	 * Register plugin menu
	 */
	public function admin_menu() {
		add_menu_page(
			'ServMask Client',
			'ServMask Client',
			'export',
			'servmask-client',
			'Smc_Main_Controller::index',
			'',
			'77.295'
		);
	}

	/**
	 * Register scripts and styles
	 */
	public function register_scripts_and_styles( $hook ) {
		if ( stripos( 'toplevel_page_servmask-client', $hook ) === false ) {
			return;
		}

		wp_enqueue_style(
			'semantic-ui',
			'//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.css',
			array(),
			'2.3.1'
		);

		wp_enqueue_script(
			'semantic-ui',
			'//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.js',
			array( 'jquery' ),
			'2.3.1',
			true
		);

		wp_enqueue_script(
			'jquery-easing',
			'//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js',
			array( 'jquery' ),
			'1.3',
			true
		);

		wp_enqueue_script(
			'servmask-client',
			Ai1wm_Template::asset_link( 'js/servmask-client.js', 'SMC' ),
			array( 'jquery' )
		);

		wp_localize_script(
			'servmask-client',
			'servmask_client',
			array(
				'ajax' => array(
					'wp_content_url'          => wp_make_link_relative( admin_url( 'admin-ajax.php?action=smc_wp_content_size' ) ),
					'wp_content_dir_size_url' => wp_make_link_relative( admin_url( 'admin-ajax.php?action=smc_wp_content_dirs_size' ) ),
					'backup_size_url'         => wp_make_link_relative( admin_url( 'admin-ajax.php?action=smc_backup_size' ) ),
				),
			)
		);

	}

	/**
	 * Handle request for cron running
	 */
	public function smc_handle_export_pdf() {
		add_action( 'admin_post_smc_export_pdf', 'Smc_Main_Controller::smc_export_pdf' );
	}

	/**
	 * Run WP cron manually
	 */
	public static function smc_export_pdf() {
		$pdf = new FPDFWrap();

		$pdf->AddPage();

		$pdf->SetFont( 'Arial', 'B', 10 );

		$pdf->Cell( 80 );
		$pdf->Cell( 30, 10, 'ServMask, Inc', 1, 0, 'C' );
		$pdf->Ln( 20 );
		$pdf->SetWidths( array( 90, 100 ) );

		$pdf->SetLineHeight( 7 );

		unset( $_POST['smc_backups'] );

		foreach ( $_POST as $key => $value ) {
			$pdf->Row( array( $key, ! is_array( $value ) ? trim( $value ) : implode( "\n", $value ) ) );
		}

		$pdf->Output();
	}

	/**
	 * Get wp-content dir size
	 */
	public static function smc_wp_content_size() {
		echo json_encode(
			array(
				'wp_content_size' => size_format( smc_get_directory_size( WP_CONTENT_DIR, array( AI1WM_BACKUPS_NAME ) ), 2 ),
			)
		);
		exit;
	}

	/**
	 * Get backup size
	 */
	public static function smc_backup_size() {
		$exclude_filters = array_merge( array( AI1WM_BACKUPS_NAME ), ai1wm_plugin_filters() );
		echo json_encode(
			array(
				'backup_size' => size_format( smc_get_directory_size( WP_CONTENT_DIR, $exclude_filters ) + intval( smc_get_db_total_size() ), 2 ),
			)
		);
		exit;
	}


	/**
	 * Get directories inside wp-content dir and their size
	 */
	public static function smc_wp_content_dirs_size() {
		$upload_dir = wp_upload_dir();

		echo json_encode( array( 'wp_content_dirs_size' => smc_get_wp_content_dirs_and_size( array( smc_normalize_path( WP_CONTENT_DIR ), smc_normalize_path( $upload_dir['basedir'] ) ) ) ) );
		exit;
	}

	/**
	 * Display the main page of the plugin
	 */
	public static function index() {
		$configs   = array();
		$configs[] = new Smc_Config( 'Site url', get_site_url(), true );
		$configs[] = new Smc_Config( 'Home url', get_home_url(), true );

		$configs[] = new Smc_Config( 'PHP Version', phpversion(), version_compare( phpversion(), '5.2.17', '>=' ) );
		$configs[] = new Smc_Config( 'MySQL Version', smc_get_db_version(), true );
		$configs[] = new Smc_Config( 'WP Version', get_bloginfo( 'version' ), get_bloginfo( 'version' ) );
		$configs[] = new Smc_Config( 'Base plugin current version', AI1WM_VERSION, true );
		$configs[] = new Smc_Config( 'Base plugin latest version', smc_get_base_plugin_latest_version(), true );

		$ini_all = ini_get_all();

		$memory_limit = ini_get( 'memory_limit' );
		if ( ! $memory_limit ) {
			$memory_limit = $ini_all['memory_limit']['global_value'];
		}

		$memory_limit_bytes = smc_to_bytes( $memory_limit );
		$configs[]          = new Smc_Config( 'memory_limit', $memory_limit, $memory_limit_bytes >= 256 * 1048576 );

		$max_execution_time = ini_get( 'max_execution_time' );
		if ( ! $max_execution_time ) {
			$max_execution_time = $ini_all['max_execution_time']['global_value'];
		}

		$configs[] = new Smc_Config(
			'max_execution_time',
			$max_execution_time,
			$max_execution_time >= 30 || $max_execution_time === 0
		);

		$configs[] = new Smc_Config(
			'mysql.connect_timeout',
			ini_get( 'mysql.connect_timeout' ) ? ini_get( 'mysql.connect_timeout' ) : 0,
			true
		);

		$configs[] = new Smc_Config( '64 Bit (Supports files > 2GB?)', smc_check_expression( PHP_INT_SIZE > 4 ), PHP_INT_SIZE > 4 );

		ob_start();
		phpinfo();
		$contents = ob_get_contents();
		ob_end_clean();

		if ( function_exists( 'apache_get_modules' ) ) {
			$configs[] = new Smc_Config(
				'mod_rewrite Enabled',
				smc_check_expression( in_array( 'mod_rewrite', apache_get_modules() ) ),
				in_array( 'mod_rewrite', apache_get_modules() )
			);
		} elseif ( strpos( $contents, 'mod_rewrite' ) !== false ) {
			$configs[] = new Smc_Config( 'mod_rewrite Enabled', 'Yes', true );
		} else {
			$web_server = explode( '/', $_SERVER['SERVER_SOFTWARE'] );
			$configs[]  = new Smc_Config( 'Web server', $web_server[0], true );
		}

		$configs[] = new Smc_Config( 'cURL Enabled', smc_check_expression( extension_loaded( 'curl' ) ), extension_loaded( 'curl' ) );
		if ( extension_loaded( 'curl' ) ) {
			$curl_version = curl_version();
			if ( $curl_version ) {
				$configs[] = new Smc_Config( 'cURL Version', $curl_version['version'], true );
			}
		}
		$configs[] = new Smc_Config( 'WP_DEBUG Enabled', smc_check_expression( WP_DEBUG ), WP_DEBUG );
		$configs[] = new Smc_Config( 'FTP Enabled', smc_check_expression( extension_loaded( 'ftp' ) ), extension_loaded( 'ftp' ) );
		$configs[] = new Smc_Config( 'OpenSSL Enabled', smc_check_expression( extension_loaded( 'openssl' ) ), extension_loaded( 'openssl' ) );
		$configs[] = new Smc_Config( 'BC Math Enabled', smc_check_expression( extension_loaded( 'bcmath' ) ), extension_loaded( 'bcmath' ) );
		$configs[] = new Smc_Config( 'Mcrypt Enabled', smc_check_expression( extension_loaded( 'mcrypt' ) ), extension_loaded( 'mcrypt' ) );
		$configs[] = new Smc_Config( 'Libxml Enabled', smc_check_expression( extension_loaded( 'libxml' ) ), extension_loaded( 'libxml' ) );
		$configs[] = new Smc_Config( 'URL Rewrite Enabled', smc_check_expression( smc_got_url_rewrite() ), smc_got_url_rewrite() );
		$configs[] = new Smc_Config( 'Db info', smc_get_db_size(), true );
		$configs[] = new Smc_Config( 'Permissions of WP_CONTENT_DIR', substr( sprintf( '%o', fileperms( WP_CONTENT_DIR ) ), -4 ), true );

		if ( function_exists( 'posix_getgrgid' ) ) {
			$system_group        = $system_user = 'unknown';
			$group_info          = posix_getgrgid( posix_getegid() );
			$user_info           = posix_getpwuid( posix_geteuid() );
			$wproot_group        = posix_getgrgid( filegroup( ABSPATH ) );
			$wproot_user         = posix_getpwuid( fileowner( ABSPATH ) );
			$wp_content_group    = posix_getgrgid( filegroup( WP_CONTENT_DIR ) );
			$wp_content_user     = posix_getpwuid( fileowner( WP_CONTENT_DIR ) );
			$ai1wm_backups_group = posix_getgrgid( filegroup( AI1WM_BACKUPS_PATH ) );
			$ai1wm_backups_user  = posix_getpwuid( fileowner( AI1WM_BACKUPS_PATH ) );
			if ( $group_info ) {
				$system_group = $group_info['name'];
			}
			if ( $user_info ) {
				$system_user = $user_info['name'];
			}
			if ( $wproot_group ) {
				$wproot_group = $wproot_group['name'];
			}
			if ( $wproot_user ) {
				$wproot_user = $wproot_user['name'];
			}
			if ( $wp_content_group ) {
				$wp_content_group = $wp_content_group['name'];
			}
			if ( $wp_content_user ) {
				$wp_content_user = $wp_content_user['name'];
			}
			if ( $ai1wm_backups_group ) {
				$ai1wm_backups_group = $ai1wm_backups_group['name'];
			}
			if ( $ai1wm_backups_user ) {
				$ai1wm_backups_user = $ai1wm_backups_user['name'];
			}
			$configs[] = new Smc_Config( 'System group:user', $system_group . ':' . $system_user, true );
			$configs[] = new Smc_Config( 'WP-root group:user', $wproot_group . ':' . $wproot_user, $wproot_group === $system_group && $wproot_user === $system_user );
			$configs[] = new Smc_Config( 'WP-content group:user', $wp_content_group . ':' . $wp_content_user, $wp_content_group === $system_group && $wp_content_user === $system_user );
			$configs[] = new Smc_Config( 'AI1WM-backups group:user', $ai1wm_backups_group . ':' . $ai1wm_backups_user, $ai1wm_backups_group === $system_group && $ai1wm_backups_user === $system_user );
		} else {
			$configs[] = new Smc_Config( 'System group:user', 'Unable to get info', false );
		}

		$configs[]  = new Smc_Config( 'Size of Storage folder', size_format( smc_get_directory_size( AI1WM_STORAGE_PATH ), 2 ), true );
		$configs[]  = new Smc_Config( 'Active plugins', smc_get_active_plugins(), true );
		$configs[]  = new Smc_Config( 'Active theme', get_template(), true );
		$configs[]  = new Smc_Config( 'wp-content path', smc_normalize_path( WP_CONTENT_DIR ), true );
		$configs[]  = new Smc_Config( 'wp-plugins path', smc_normalize_path( WP_PLUGIN_DIR ), true );
		$configs[]  = new Smc_Config( 'wp-themes path', smc_normalize_path( get_template_directory() ), true );
		$upload_dir = wp_upload_dir();
		$configs[]  = new Smc_Config( 'wp-upload path', smc_normalize_path( $upload_dir['basedir'] ), true );
		$configs[]  = new Smc_Config( 'ai1wm-backups path', smc_normalize_path( AI1WM_BACKUPS_PATH ), true );

		Ai1wm_Template::render(
			'config-list',
			array(
				'configs'   => $configs,
				'debug_log' => smc_get_debug_log(),
				'error_log' => smc_get_storage_error_log(),
			),
			SMC_TEMPLATES_PATH
		);
	}

	/**
	 * Register initial router
	 *
	 * @return void
	 */
	public function router() {
		add_action( 'wp_ajax_smc_wp_content_size', 'Smc_Main_Controller::smc_wp_content_size' );
		add_action( 'wp_ajax_smc_wp_content_dirs_size', 'Smc_Main_Controller::smc_wp_content_dirs_size' );
		add_action( 'wp_ajax_smc_backup_size', 'Smc_Main_Controller::smc_backup_size' );
	}
}
