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

define( 'SMC_VERSION', '1.12' );
define( 'SMC_PLUGIN_NAME', 'servmask-client' );

define( 'SMC_LIB_PATH', SMC_PATH . DIRECTORY_SEPARATOR . 'lib' );
define( 'SMC_CONTROLLER_PATH', SMC_LIB_PATH . DIRECTORY_SEPARATOR . 'controller' );
define( 'SMC_TEMPLATES_PATH', SMC_LIB_PATH . DIRECTORY_SEPARATOR . 'view' );
define( 'SMC_VENDOR_PATH', SMC_LIB_PATH . DIRECTORY_SEPARATOR . 'vendor' );
if ( defined( 'AI1WM_PLUGIN_NAME' ) && defined( 'AI1WM_ERROR_NAME' ) ) {
	define( 'SMC_ERROR_LOG_URL', sprintf( '%s/%s/%s/%s', plugins_url(), AI1WM_PLUGIN_NAME, 'storage', AI1WM_ERROR_NAME ) );
}

