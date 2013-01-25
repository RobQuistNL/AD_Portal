<?php
/**
 * Config file. Edit as needed. Do NOT add trailing slashes!
 */
define('APP_PATH', realpath(__DIR__.'/../../'));

define('PUBLIC_PATH', APP_PATH . '/public');

define('LANG_FILE', APP_PATH . '/lang/english.php');

define('CONFIG_FILE', APP_PATH . '/config/application.ini');

define('TEMP_DL_FOLDER', APP_PATH . '/vpn-config-files'); //Where the downloadable ZIP's will be stored.

define('BRUTEFORCE_MINUTES', 15); //Timespan, see below.
define('BRUTEFORCE_ATTEMPTS', 10); //Maximum attempts in the given times, before we block the IP temporarily.

//VPN File storage
define('VPN_USERS_PATH', '/etc/openvpn/users.conf.d');
define('VPN_KEYS_PATH', '/etc/openvpn/easy-rsa/keys');