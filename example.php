<?php
/**
 * Created by Jacky.
 * User: Jacky
 * E-Mail: jacky@carocrm.com or jacky@youaddon.com
 * Date: 8/5/2015
 * Time: 10:51 AM
 * Project: MailChimpAPI
 * File: example.php
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'MailChimp.php';

$mail_chimp = new MailChimp('d06f79611da9dc03b72ab11fe8d3c864-us1');

//$result = $mail_chimp->campaign->getList();
$result = $mail_chimp->campaign->getCampaign('a464c30522');

echo '<pre>';
echo 'Result:';
print_r($result);
echo '</pre>';