<h2><?= Helper\escape($task['title']) ?> (#<?= $task['id'] ?>)</h2>

<h3><?= t('Sub-task updated') ?></h3>

<ul>
    <li><?= t('Title:') ?> <?= Helper\escape($subtask['title']) ?></li>
    <li><?= t('Status:') ?> <?= Helper\escape($subtask['status_name']) ?></li>
    <li><?= t('Assignee:') ?> <?= Helper\escape($subtask['name'] ?: $subtask['username'] ?: '?') ?></li>
    <li>
        <?= t('Time tracking:') ?>
        <?php if (! empty($subtask['time_spent'])): ?>
            <strong><?= Helper\escape($subtask['time_spent']).'h' ?></strong> <?= t('spent') ?>
        <?php endif ?>

        <?php if (! empty($subtask['time_estimated'])): ?>
            <strong><?= Helper\escape($subtask['time_estimated']).'h' ?></strong> <?= t('estimated') ?>
        <?php endif ?>
    </li>
</ul>

<?= Helper\template('notification/footer', array('task' => $task, 'application_url' => $application_url)) ?>