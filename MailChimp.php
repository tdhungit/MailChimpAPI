<?php

/**
 * Created by Jacky.
 * User: Jacky
 * E-Mail: jacky@carocrm.com or jacky@youaddon.com
 * Date: 8/5/2015
 * Time: 11:07 AM
 * Project: MailChimpAPI
 * File: MailChimp.php
 */

define('API_ENDPOINT', 'https://<dc>.api.mailchimp.com/3.0/');
define('VERIFY_SSL', false);

require_once 'Libraries/MailChimpBase.php';

/**
 * Class MailChimp
 *
 * @property Campaigns $campaign
 */
class MailChimp extends MailChimpBase
{

    public function __construct($api_key)
    {
        parent::__construct($api_key);

        $this->campaign = $this->load('Campaigns');
    }

}