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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'wordpress');

/** MySQL database password */
define('DB_PASSWORD', 'wordpress');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '|{)2D6-CPB&(-RF@2$!i:k=Ia|[S<8%#+IoC+v2|pn>pa[W?mn4[UStAZ>%&-`zW');
define('SECURE_AUTH_KEY',  'a?g,E([eYl@hqr)+=G{t+%&IUW7ohy%SqSBJ8-gT=Y)vSX(M?A4+|b)eoMAKpTtk');
define('LOGGED_IN_KEY',    'TtZ%bf6]; !M.Hh:4yb|]>i.U;<+kHAf>|#hP=(BnTDrt(<Lh=`c!6$([aZsu@av');
define('NONCE_KEY',        'ZCQsCoMExM}Fg6+ *!<p&RnL|h~T/Z3+FXcZu>>V:BG3Ch2g7 [1AGkD(TT|~Y/f');
define('AUTH_SALT',        'f-:=SFSl%OgB,KqY^*[hKo;} @]tA nd[Q.%0ORFGZA0|+/3z*DIcHT$C-UoJy%U');
define('SECURE_AUTH_SALT', '}<F%P!T:%+*-8ls{fG6,N+ei]+h?8p@Sg#Z6}StwR&buy+8g%~Sxwnpm6]X=HPyB');
define('LOGGED_IN_SALT',   '*G %I|sR;q/Uq#~iw5;|~`}P0}H17&>^YbMZLv|Jk7ml8Hw-eSHtWJ-6DaquUrkE');
define('NONCE_SALT',       'su;!I|`R%wR|WXE{}iOsk%OBt+>c~[2PTg62=p4@v}DWkL*vGoSv.-B*vrY)IKx ');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
