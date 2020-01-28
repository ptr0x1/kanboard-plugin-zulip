<h3><img width="48px" src="<?= $this->url->dir() ?>plugins/Zulip/zulip-icon.png"/>&nbsp;Zulip</h3>
<div class="panel">
    <?= $this->form->label(t('Webhook URL'), 'zulip_webhook_url') ?>
    <?= $this->form->text('zulip_webhook_url', $values) ?>

    <?= $this->form->label(t('Zulip Bot (BOT_email:API_key)'), 'zulip_webhook_botapi') ?>
    <?= $this->form->text('zulip_webhook_botapi', $values, array(), array('placeholder="kanboard-bot@zulip.com:wxZyTkwvxzq"')) ?>

    <?= $this->form->label(t('Message Type'), 'zulip_message_type') ?>
    <?= $this->form->select('zulip_message_type', array('' => '','stream' => 'stream', 'private' => 'private'), $values, array(), array('placeholder="private/stream"')) ?>

    <?= $this->form->label(t('Channel (for Stream)'), 'zulip_webhook_channel') ?>
    <?= $this->form->text('zulip_webhook_channel', $values, array(), array('placeholder="channel"')) ?>

    <?= $this->form->label(t('Subject (for Stream)'), 'zulip_webhook_subject') ?>
    <?= $this->form->text('zulip_webhook_subject', $values, array(), array('placeholder="subject"')) ?>

    <?= $this->form->label(t('Email of user to be notified (for Private)'), 'zulip_webhook_email') ?>
    <?= $this->form->text('zulip_webhook_email', $values, array(), array('placeholder="user@zulip.com"')) ?>

    <?= $this->form->label(t('Event filters (Optional)'), 'zulip_webhook_eventfilter') ?>
    <?= $this->form->text('zulip_webhook_eventfilter', $values, array(), array('placeholder="task.move.column,task.create"')) ?>

    <p class="form-help"><a href="https://github.com/ptr0x01/kanboard-plugin-zulip#configuration" target="_blank"><?= t('Help on Zulip integration') ?></a></p>

    <div class="form-actions">
        <input type="submit" value="<?= t('Save') ?>" class="btn btn-blue"/>
    </div>
</div>
