<div class="page-header">
    <h2><?= t('Attach a document') ?></h2>
</div>

<form action="<?= Helper\u('file', 'save', array('task_id' => $task['id'])) ?>" method="post" enctype="multipart/form-data">
    <?= Helper\form_csrf() ?>
    <input type="file" name="files[]" multiple />
    <div class="form-help"><?= t('Maximum size: ') ?><?= is_integer($max_size) ? Helper\format_bytes($max_size) : $max_size ?></div>
    <div class="form-actions">
        <input type="submit" value="<?= t('Save') ?>" class="btn btn-blue"/>
        <?= t('or') ?>
        <?= Helper\a(t('cancel'), 'task', 'show', array('task_id' => $task['id'])) ?>
    </div>
</form>