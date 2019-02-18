<?php

namespace Kanboard\Plugin\Zulip;

use Kanboard\Core\Translator;
use Kanboard\Core\Plugin\Base;

/**
 * Zulip Plugin
 *
 * @package  zulip
 * @author   Frederic Guillot
 */
class Plugin extends Base
{
    public function initialize()
    {
        $this->template->hook->attach('template:config:integrations', 'zulip:config/integration');
        $this->template->hook->attach('template:project:integrations', 'zulip:project/integration');
        $this->projectNotificationTypeModel->setType('zulip', t('Zulip'), '\Kanboard\Plugin\Zulip\Notification\Zulip');
    }

    public function onStartup()
    {
        Translator::load($this->languageModel->getCurrentLanguage(), __DIR__.'/Locale');
    }

    public function getPluginDescription()
    {
        return 'Receive notifications on Zulip';
    }

    public function getPluginAuthor()
    {
        return 'Peter Fejer';
    }

    public function getPluginVersion()
    {
        return '1.0.0';
    }

    public function getPluginHomepage()
    {
        return 'https://github.com/ptr0x01/kanboard-plugin-zulip';
    }

    public function getCompatibleVersion()
    {
        return '>=1.0.37';
    }
}
