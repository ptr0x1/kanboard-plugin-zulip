<h3><img src="<?= $this->url->dir() ?>plugins/Zulip/zulip-icon.png"/>&nbsp;Zulip</h3>
<div class="panel">
    <?= $this->form->label(t('Webhook URL'), 'zulip_webhook_url') ?>
    <?= $this->form->text('zulip_webhook_url', $values) ?>

    <?= $this->form->label(t('Channel/Group/User (Optional)'), 'zulip_webhook_channel') ?>
    <?= $this->form->text('zulip_webhook_channel', $values, array(), array('placeholder="channel"')) ?>

    <p class="form-help"><a href="https://github.com/ptr0x01/kanboard-plugin-zulip#configuration" target="_blank"><?= t('Help on Zulip integration') ?></a></p>

    <div class="form-actions">
        <input type="submit" value="<?= t('Save') ?>" class="btn btn-blue"/>
    </div>
</div>
