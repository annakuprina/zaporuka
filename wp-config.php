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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'zaporuka' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );
/**/ */
/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'wt8vxbbq7govvvylddefmsw7cnsx9fg9nxdzygrndulmptay3yiz0l7jesotknzt' );
define( 'SECURE_AUTH_KEY',  'umeuglgiiddjlntpiof6vhmrpvpklg0uo7pkhed80vhg6vipegdf1ai9gxkjajia' );
define( 'LOGGED_IN_KEY',    'wa9nltettzhdetzgcnnscxc06s7eu2irizuzydetpalonvr8luy5chmokdqftcne' );
define( 'NONCE_KEY',        'blaf0klllt6vnqgcwrxd1uz5pjyynxlt4pgstcfym4edn4lxw8fnhp5vkcknksyg' );
define( 'AUTH_SALT',        'zsiuhbybhggcihhcvfhcakgtdztoluhdwfhekysd2vvz9cmizvj2ton5ctzu5wy8' );
define( 'SECURE_AUTH_SALT', 'ux0ja1d1b7h1gyuqioftmujhhbz3kukhpja2h7pbe50ynqpkpqapqq7numwatmiv' );
define( 'LOGGED_IN_SALT',   'byiabr4jvkvstagx8fcejpg7cncihpqpdr8glgjfjzeqxw2sfffeqogailuesb7l' );
define( 'NONCE_SALT',       '17yqaaymw8hdynz3fnivlpfovhgzvqiaw8nmlconhfjc82mkeqmqawtcudks37mr' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp4t_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );
//define( 'WP_DEBUG', true );
//define( 'WP_DEBUG_DISPLAY ', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
