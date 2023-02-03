<?php
require_once '../vendor/autoload.php';

use libphonenumber\PhoneNumberUtil;

$phoneUtil = PhoneNumberUtil::getInstance();

getCountryByCharacters($phoneUtil);
function getCountryByCharacters($phoneUtil)
{
    if (isset($_REQUEST['countryCode'])) {
        $prefix = $_REQUEST['countryCode'];
        $thePrefix = $phoneUtil->getCountryCodeForRegion($prefix);
        echo $thePrefix;
    }
}
