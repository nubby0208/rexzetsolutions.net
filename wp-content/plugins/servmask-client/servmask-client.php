<?php
/**
 * Plugin Name: ServMask Client
 * Plugin URI: https://servmask.com/
 * Description: Helper tool used by ServMask Clients
 * Author: ServMask
 * Author URI: https://servmask.com/
 * Version: 1.12
 * Network: True
 *
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

// Plugin Basename
define( 'SMC_PLUGIN_BASENAME', basename( dirname( __FILE__ ) ) . '/' . basename( __FILE__ ) );

// Plugin Path
define( 'SMC_PATH', dirname( __FILE__ ) );

// Plugin Url
define( 'SMC_URL', plugins_url( '', SMC_PLUGIN_BASENAME ) );

set_time_limit(0);

require_once dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'constants.php';
require_once dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'loader.php';
require_once dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'functions.php';

$main_controller = new Smc_Main_Controller();
