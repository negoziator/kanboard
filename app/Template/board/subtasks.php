<section id="tooltip-subtasks">
<?php foreach ($subtasks as $subtask): ?>
    <?= Helper\a(
        trim(Helper\template('subtask/icons', array('subtask' => $subtask))) . Helper\escape($subtask['title']),
        'board',
        'toggleSubtask',
        array('task_id' => $subtask['task_id'], 'subtask_id' => $subtask['id'])
    ) ?>

    <?= Helper\escape(empty($subtask['username']) ? '' : ' ['.Helper\get_username($subtask).']') ?>

    <br/>
<?php endforeach ?>
</section>
