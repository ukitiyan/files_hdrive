<?php

use \OCA\Files_hdrive\Lib\Config;

OCP\JSON::checkAppEnabled('files_hdrive');
OCP\JSON::callCheck();
OCP\JSON::checkAdminUser();

$mountpoint = $_POST['mountpoint'];
$host = $_POST['host'];
$share = $_POST['share'];
$group= $_POST['group'];

$status = Config::save($mountpoint, $host, $share, $group);
OCP\JSON::success(array('data' => array('message' => $status)));
