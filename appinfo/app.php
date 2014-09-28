<?php
/**
 * ownCloud - Files H-Drive
 *
 * @copyright 2014 Begood Technology Corp. <owncloud@begood-tech.com>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */
\OCP\Util::connectHook('OC_User', 'post_login', '\OCA\Files_hdrive\Lib\Hooks', 'addMount');
\OCP\Util::connectHook('OC_User', 'logout', '\OCA\Files_hdrive\Lib\Hooks', 'removeMount');

OCP\App::registerAdmin('files_hdrive', 'settings');
