<?php
/**
 * ownCloud - Files H-Drive
 *
 * @copyright 2014 Begood Technology Corp. <owncloud@begood-tech.com>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */
namespace OCA\Files_hdrive\Lib;

use \OCA\Files_hdrive\Lib;
use \OC\Files\Storage;

/**
 * Class to configure
 */
class Config {

	/**
	 * save config
	 * @param string $mountpoint
	 * @param string $host
	 * @param string $share
	 * @param string $group
	 * @return bool
	 */
	public static function save($mountpoint, $host, $share, $group) {
		\OC_Appconfig::setValue('files_hdrive', 'mountpoint', $mountpoint);
		\OC_Appconfig::setValue('files_hdrive', 'host', $host);
		\OC_Appconfig::setValue('files_hdrive', 'share', $share);
		\OC_Appconfig::setValue('files_hdrive', 'group', $group);
		return Config::isEnabled();
	}

	/**
	 * check config enabled
	 * @return bool
	 */
	public static function isEnabled() {
		if (!\OC_App::isEnabled('files_hdrive')) {
			return false;
		}
		if (Config::checkDependencies() !== '') {
			return false;
		}

		if (\OC_Appconfig::getValue('files_hdrive', 'host') == null
			|| \OC_Appconfig::getValue('files_hdrive', 'mountpoint') == null
			|| \OC_Appconfig::getValue('files_hdrive', 'share') == null
			|| \OC_Appconfig::getValue('files_hdrive', 'group') == null
		) {
			return false;
		}
		return true;
	}

	/**
	 * check config enabled by user
	 * @param string $uid
	 * @param string $password
	 * @return bool
	 */
	public static function isEnabledByUser($uid, $password) {
		if ($uid == null || $password == null) {
			return false;
		}

		$group = preg_split("/,/", \OC_Appconfig::getValue('files_hdrive', 'group'));
		if (!in_array($group, \OC_Group::getUserGroups($uid))) {
			return false;
		}

		return Config::isEnabled();
	}

	/**
	 * check dependencies
	 * @return string
	 */
	public static function checkDependencies() {
		$dependencies = array();

		if (!Storage\SMB::checkDependencies() !== true) {
			Config::addDependency($dependencies, "\"smbclient\" is not installed. Mounting of CIFS/SMB shares is not possible. Please ask your system administrator to install it.");
		}
		if (!\OC_App::isEnabled('files_external')) {
			Config::addDependency($dependencies, "\"files_external app\" is not installed. Please ask your system administrator to install it.");
		}
		if (!\OC_App::isEnabled('user_ldap')) {
			Config::addDependency($dependencies, "\"user_ldap app\" is not installed. Please ask your system administrator to install and setting it.");
		}

		if (count($dependencies) > 0) {
			return Config::generateDependencyMessage($dependencies);
		}
		return '';
	}

	private static function addDependency(&$dependencies, $message) {
		$dependencies[] = $message;
	}

	private static function generateDependencyMessage($dependencies) {
		$l = new \OC_L10N('files_hdrive');
		$dependencyMessage = '';
		foreach ($dependencies as $message) {
			$dependencyMessage .= '<br />' . $l->t('<b>Note:</b> ') . $l->t($message);
		}
		return $dependencyMessage;
	}
}
