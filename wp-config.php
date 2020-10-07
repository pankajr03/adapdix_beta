<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'adapdix_beta' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          '9-R665sVBksNNhqU}MG@W%F0kyS.P(WO=4w9yJ:|J>gi;j%yd|E(6)$7pG{Eh .R' );
define( 'SECURE_AUTH_KEY',   '~_ hkm/yQdVl4mgP,,E5qqbNE{vbJN<ECcMS&_YH]0~3&A+Qq7=9bm(b==9a_|L/' );
define( 'LOGGED_IN_KEY',     'C-m]mPxE Y(`7l||k~rsX:yM%5KOT|=iI+uNjDU|CY(K|51N5%^hf;nz)K{7J!|-' );
define( 'NONCE_KEY',         '6!2[a?OdWvE5|aUHRNg8~ikt4.G{ca]/(<~ UBGW}K*>W,ClV64WH{wGS18upib`' );
define( 'AUTH_SALT',         'rCf;rBLF|G(MATNH 3+(F5mb2n9j?jW*QI4LaI@H*x_ ,|;<$IQ%qJn`15_6$!iQ' );
define( 'SECURE_AUTH_SALT',  'ODH4gUtIDJc}{RE5Nk[7l]=rn_C7N@zBLhsKeSj9IT]R+fPJ-w.^CLJHTF;:)hwv' );
define( 'LOGGED_IN_SALT',    'Ss`:=b=8LmGxum`dQQ:zF%Y _hURM$Bz^Ga/-,S5D)KdkkpU+AWpv?HYe5@Y)H8&' );
define( 'NONCE_SALT',        'AX0NRiP_umjb.O>nF6tnMi[v_~DT^~WU0t=|*u,d{;Q]jg~x%.q~Fd2FbR9~-~F,' );
define( 'WP_CACHE_KEY_SALT', '>xbR<#_ZXF[nyVy4cJrbcU(4ezeK;[q$y6y#CYv01di7cEV}8=UM-T;O!]lCHjYS' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpbeta_';
/*
define( 'WPMS_ON', true );
define( 'WPMS_SMTP_PASS', 'Chaos2019#' );
*/
//if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')
//$_SERVER['HTTPS'] = 'on';

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
