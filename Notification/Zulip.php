<?php

namespace Kanboard\Plugin\Zulip\Notification;

use Kanboard\Core\Base;
use Kanboard\Core\Notification\NotificationInterface;
use Kanboard\Model\TaskModel;

/**
 * Zulip Notification
 *
 * @package  notification
 * @author   Peter Fejer
 */
class Zulip extends Base implements NotificationInterface
{
    /**
     * Send notification to a user
     *
     * @access public
     * @param  array     $user
     * @param  string    $eventName
     * @param  array     $eventData
     */
    public function notifyUser(array $user, $eventName, array $eventData)
    {
        $webhook = $this->userMetadataModel->get($user['id'], 'zulip_webhook_url', $this->configModel->get('zulip_webhook_url'));
        $channel = $this->userMetadataModel->get($user['id'], 'zulip_webhook_channel');
        $api_key = $this->userMetadataModel->get($user['id'], 'zulip_webhook_botapi');
        $subject = $this->userMetadataModel->get($user['id'], 'zulip_webhook_subject');
        if (! empty($webhook)) {
            if ($eventName === TaskModel::EVENT_OVERDUE) {
                foreach ($eventData['tasks'] as $task) {
                    $project = $this->projectModel->getById($task['project_id']);
                    $eventData['task'] = $task;
                    $this->sendMessage($webhook, $channel, $project, $eventName, $eventData, $api_key, $subject);
                }
            } else {
                $project = $this->projectModel->getById($eventData['task']['project_id']);
                $this->sendMessage($webhook, $channel, $project, $eventName, $eventData, $api_key, $subject);
            }
        }
    }

    /**
     * Send notification to a project
     *
     * @access public
     * @param  array     $project
     * @param  string    $event_name
     * @param  array     $event_data
     */
    public function notifyProject(array $project, $event_name, array $event_data)
    {
        $webhook = $this->projectMetadataModel->get($project['id'], 'zulip_webhook_url', $this->configModel->get('zulip_webhook_url'));
        $channel = $this->projectMetadataModel->get($project['id'], 'zulip_webhook_channel');
        $api_key = $this->projectMetadataModel->get($project['id'], 'zulip_webhook_botapi');
        $subject = $this->projectMetadataModel->get($project['id'], 'zulip_webhook_subject');
        $filters = $this->projectMetadataModel->get($project['id'], 'zulip_webhook_eventfilter');

        if (! empty($webhook)) {
          if (! empty($filters)){
            $filter_array = explode(",", strtolower(trim($filters)));
            if (in_array(strtolower($event_name), $filter_array)) {
              $this->sendMessage($webhook, $channel, $project, $event_name, $event_data, $api_key, $subject);
            }
          } else {
            $this->sendMessage($webhook, $channel, $project, $event_name, $event_data, $api_key, $subject);
          }
        }
    }

    /**
     * Get message to send
     *
     * @access public
     * @param  array     $project
     * @param  string    $event_name
     * @param  array     $event_data
     * @param  string    $channel
     * @param  string    $subject
     * @return array
     */
    public function getMessage(array $project, $event_name, array $event_data, $channel, $subject)
    {
        if ($this->userSession->isLogged()) {
            $author = $this->helper->user->getFullname();
            $title = $this->notificationModel->getTitleWithAuthor($author, $event_name, $event_data);
        } else {
            $title = $this->notificationModel->getTitleWithoutAuthor($event_name, $event_data);
        }

        $message = '**['.$project['name']."]** ";

        if ($this->configModel->get('application_url') !== '') {
            $message .= t("[".$event_data['task']['title']."]");
            $message .= '(';
            $message .= $this->helper->url->to('TaskViewController', 'show', array('task_id' => $event_data['task']['id'], 'project_id' => $project['id']), '', true);
            $message .= ')'."\n";
        }

        $message .= $title."\n";

        return array(
            'type' => "stream",
            'to' => $channel,
            'subject' => $subject,
            'content' => $message,
        );
    }

    /**
     * Send message to Zulip
     *
     * @access private
     * @param  string    $webhook
     * @param  string    $channel
     * @param  array     $project
     * @param  string    $event_name
     * @param  array     $event_data
     * @param  string    $channel
     * @param  string    $subject
     */
    private function sendMessage($webhook, $channel, array $project, $event_name, array $event_data, $api_key, $subject)
    {
        $payload = $this->getMessage($project, $event_name, $event_data, $channel, $subject);
        $headers = array(
          'Authorization: Basic '. base64_encode($api_key)
        );

        $this->httpClient->postFormAsync($webhook, $payload, $headers);
    }
}
