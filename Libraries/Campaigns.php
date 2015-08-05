<?php

/**
 * Created by Jacky.
 * User: Jacky
 * E-Mail: jacky@carocrm.com or jacky@youaddon.com
 * Date: 8/5/2015
 * Time: 11:11 AM
 * Project: MailChimpAPI
 * File: Campaigns.php
 */
class Campaigns extends MailChimpBase
{
    /**
     * List all campaigns
     *
     * @return array
     */
    public function getCampaignList()
    {
        return $this->call('GET', 'campaigns');
    }

    /**
     * Create a new campaign
     *
     * @param $campaign
     * @return array
     */
    public function createCampaign($campaign)
    {
        return $this->call('POST', 'campaigns', $campaign);
    }

    /**
     * A summary of an individual campaign's settings and content.
     *
     * @param $id
     * @return array
     */
    public function getCampaign($id)
    {
        return $this->call('GET', "campaigns/{$id}");
    }

    /**
     * Delete a campaign
     *
     * @param $id
     * @return array
     */
    public function deleteCampaign($id)
    {
        return $this->call('DELETE', "campaigns/{$id}");
    }

    /**
     * A specific, editable content area in a specific campaign.
     *
     * @param $id
     * @return array
     */
    public function getCampaignContent($id)
    {
        return $this->call('GET', "campaigns/{$id}/content");
    }

    /**
     * A summary of the comment feedback for a specific campaign.
     *
     * @param $id
     * @return array
     */
    public function getCampaignFeedbackList($id)
    {
        return $this->call('GET', "campaigns/{$id}/feedback");
    }

    /**
     * post a comment feedback
     *
     * @param $id
     * @param $feedback
     * @return array
     */
    public function createCampaignFeedback($id, $feedback)
    {
        return $this->call('POST', "campaigns/{$id}/feedback", $feedback);
    }

    /**
     * A specific feedback message from a specific campaign.
     *
     * @param $id
     * @param $feedback_id
     * @return array
     */
    public function getCampaignFeedback($id, $feedback_id)
    {
        return $this->call('GET', "campaigns/{$id}/feedback/{$feedback_id}");
    }

    /**
     * Delete a comment feedback of campaign
     *
     * @param $id
     * @param $feedback_id
     * @return array
     */
    public function deleteCampaignFeedback($id, $feedback_id)
    {
        return $this->call('DELETE', "campaigns/{$id}/feedback/{$feedback_id}");
    }

    /**
     * A list of reports containing campaigns marked as Sent.
     *
     * @return array
     */
    public function getCampaignReportList()
    {
        return $this->call('GET', "reports");
    }

    /**
     * Report details about a sent campaign.
     *
     * @param $id
     * @return array
     */
    public function getCampaignReport($id)
    {
        return $this->call('GET', "reports/{$id}");
    }
}