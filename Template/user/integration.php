<h3><img width="48px" src="<?= $this->url->dir() ?>plugins/Zulip/zulip-icon.png"/>&nbsp;Zulip</h3>
<div class="panel">
    <?= $this->form->label(t('Webhook URL'), 'zulip_webhook_url') ?>
    <?= $this->form->text('zulip_webhook_url', $values) ?>

    <?= $this->form->label(t('Zulip Bot (name:API_key)'), 'zulip_webhook_botapi') ?>
    <?= $this->form->text('zulip_webhook_botapi', $values, array(), array('placeholder="kanboard-bot@zulip.com:wxZyTkwvxzq"')) ?>

    <?= $this->form->label(t('Channel'), 'zulip_webhook_channel') ?>
    <?= $this->form->text('zulip_webhook_channel', $values, array(), array('placeholder="channel"')) ?>

    <?= $this->form->label(t('Subject'), 'zulip_webhook_subject') ?>
    <?= $this->form->text('zulip_webhook_subject', $values, array(), array('placeholder="subject"')) ?>

    <p class="form-help"><a href="https://github.com/ptr0x01/kanboard-plugin-zulip#configuration" target="_blank"><?= t('Help on Zulip integration') ?></a></p>

    <div class="form-actions">
        <input type="submit" value="<?= t('Save') ?>" class="btn btn-blue"/>
    </div>
</div>