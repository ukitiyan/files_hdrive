<?php
/**
 * ownCloud - Files H-Drive
 *
 * @copyright 2014 Begood Technology Corp. <owncloud@begood-tech.com>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */
/**
 * insert to oc_appconfig
 * ex)
 * insert into oc_appconfig values('files_hdrive', 'host', '172.16.200.84');
 * insert into oc_appconfig values('files_hdrive', 'mountpoint', 'MyDocuments');
 * insert into oc_appconfig values('files_hdrive', 'share', '/R_AllUsers');
 * insert into oc_appconfig values('files_hdrive', 'group', 'Group001');
 */
\OCP\Util::connectHook('OC_User', 'post_login', '\OCA\Files_hdrive\Lib\Hooks', 'addMount');
\OCP\Util::connectHook('OC_User', 'logout', '\OCA\Files_hdrive\Lib\Hooks', 'removeMount');

