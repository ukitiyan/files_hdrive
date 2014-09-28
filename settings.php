<?php
/**
 * ownCloud - Files H-Drive
 *
 * @copyright 2014 Begood Technology Corp. <owncloud@begood-tech.com>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */

use \OCA\Files_hdrive\Lib\Config;
OC_Util::checkAdminUser();

OCP\Util::addScript('files_hdrive', 'settings');
OCP\Util::addscript('3rdparty', 'chosen/chosen.jquery.min');
OCP\Util::addStyle('files_hdrive', 'settings');
OCP\Util::addStyle('3rdparty', 'chosen/chosen');

$hdrive = array(
	'mountpoint' => \OC_Appconfig::getValue('files_hdrive', 'mountpoint'),
	'host' => \OC_Appconfig::getValue('files_hdrive', 'host'),
	'share' => \OC_Appconfig::getValue('files_hdrive', 'share'),
	'group' => preg_split('/,/',\OC_Appconfig::getValue('files_hdrive', 'group')),
	'status' => Config::isEnabled()
);

$tmpl = new OCP\Template('files_hdrive', 'settings');
$tmpl->assign('groups', OC_Group::getGroups());
$tmpl->assign('hdrive_dependencies', Config::checkDependencies());
$tmpl->assign('hdrive', $hdrive);

return $tmpl->fetchPage();
