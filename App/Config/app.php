<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v3.0.0
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
namespace App\Config;

use Cake\Core\Configure;

/**
 * CakePHP Debug Level:
 *
 * Production Mode:
 * 	0: No error messages, errors, or warnings shown. Flash messages redirect.
 *
 * Development Mode:
 * 	1: Errors and warnings shown, model caches refreshed, flash messages halted.
 * 	2: As in 1, but also with full debug messages and SQL output.
 *
 * In production mode, flash messages redirect after a time interval.
 * In development mode, you need to click the flash message to continue.
 */
	Configure::write('debug', 2);

/**
 * The root namespace your application uses.  This should match
 * the top level directory.
 */
	$namespace = 'App';

/**
 * Configure basic information about the application.
 *
 * - namespace - The namespace to find app classes under.
 * - encoding - The encoding used for HTML + database connections.
 * - base - The base directory the app resides in. If false this
 *   will be auto detected.
 * - webroot - The webroot directory.
 * - www_root - The file path to webroot.
 * - baseUrl - To configure CakePHP *not* to use mod_rewrite and to
 *   use CakePHP pretty URLs, remove these .htaccess
 *   files:
 *      /.htaccess
 *      /app/.htaccess
 *      /app/webroot/.htaccess
 *   And uncomment the baseUrl key below.
 * - imageBaseUrl - Web path to the public images directory under webroot.
 * - cssBaseUrl - Web path to the public css directory under webroot.
 * - jsBaseUrl - Web path to the public js directory under webroot.
 */
	Configure::write('App', [
		'namespace' => $namespace,
		'encoding' => 'UTF-8',
		'base' => false,
		'dir' => APP_DIR,
		'webroot' => WEBROOT_DIR,
		'www_root' => WWW_ROOT,
		'baseUrl' => false,
		//'baseUrl' => env('SCRIPT_NAME'),
		'imageBaseUrl' => 'img/',
		'cssBaseUrl' => 'css/',
		'jsBaseUrl' => 'js/'
	]);

/**
 * To configure CakePHP to use a particular domain URL
 * for any URL generation inside the application, set the following
 * configuration variable to the http(s) address to your domain.
 * In most cases the code below will generate the correct hostname.
 * However, you can manually define the hostname to resolve any issues.
 */
$s = null;
if (env('HTTPS')) {
	$s = 's';
}

$httpHost = env('HTTP_HOST');
if (isset($httpHost)) {
	Configure::write('App.fullBaseUrl', 'http' . $s . '://' . $httpHost);
}
unset($httpHost, $s);

/**
 * Uncomment this line and correct your server timezone to fix
 * any date & time related errors.
 */
	//date_default_timezone_set('UTC');

/**
 * Setup Security and hashing related values.
 * The level of CakePHP security.
 *
 * - salt - A random string used in security hashing methods.
 *   The salt value is also used as the encryption key. You should treat it
 *   as extremely sensitive data.
 */
	Configure::write('Security.salt', 'DYhG93b0qyJfIxfs2guVoUubWwvniR2G0FgaC9mi');

/**
 * Apply timestamps with the last modified time to static assets (js, css, images).
 * Will append a querystring parameter containing the time the file was modified. This is
 * useful for invalidating browser caches.
 *
 * Set to `true` to apply timestamps when debug > 0. Set to 'force' to always enable
 * timestamping regardless of debug value.
 */
	//Configure::write('Asset.timestamp', true);

/**
 * The classname and database used in CakePHP's
 * access control lists.
 */
	Configure::write('Acl', [
		'database' => 'default',
		'classname', 'DbAcl',
	]);

/**
 * Configure an autoloader for the App namespace.
 *
 * Use App\Controller\AppController as a test to see if composer
 * support is being used.
 */
if (!class_exists('App\Controller\AppController')) {
	(new \Cake\Core\ClassLoader($namespace, dirname(APP)))->register();
}

/**
 * Configure the mbstring extension to use the correct encoding.
 */
$encoding = Configure::read('App.encoding');
mb_internal_encoding($encoding);

unset($httpHost, $s, $namespace, $encoding);