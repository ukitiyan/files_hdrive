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

class Hooks {
    public function __construct() {
    }

    /**
     * addMount by HDrive
     * @param array $params
	 * @return bool
     */
    public static function addMount($params) {
        $uid = isset($params['uid']) ? $params['uid'] : null;
        $password = isset($params['password']) ? $params['password'] : null;

        if (!Config::isEnabledByUser($uid, $password)) {
            return false;
        }

        $options = array('host' => \OC_Appconfig::getValue('files_hdrive', 'host'), 'user' => $uid, 'password' => $password, 'share' => \OC_Appconfig::getValue('files_hdrive', 'share'), 'root' => '/'. $uid);
        $status = \OC_Mount_Config::addMountPoint(\OC_Appconfig::getValue('files_hdrive', 'mountpoint'),
            '\\OC\\Files\\Storage\\SMB',
            $options,
            'user',
            $params['uid'],
            true);
    }


    /**
     * removeMount by HDrive
     */
    public static function removeMount() {
        \OC_Mount_Config::removeMountPoint(\OC_Appconfig::getValue('files_hdrive', 'mountpoint'), 'user', \OC_User::getUser(), true);
    }
}
