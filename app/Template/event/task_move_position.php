<p class="activity-title">
    <?= e('%s moved the task <a href="?controller=task&amp;action=show&amp;task_id=%d">#%d</a> to the position #%d in the column "%s"', Helper\escape($author), $task_id, $task_id, $task['position'], Helper\escape($task['column_title'])) ?>
</p>
<p class="activity-description">
    <em><?= Helper\escape($task['title']) ?></em>
</p>