<?php

$deinflect_dow = array(
    'понедельник' => 'понедельник',
    'вторник'     => 'вторник',
    'среду'       => 'среда',
    'четверг'     => 'четверг',
    'пятницу'     => 'пятница',
    'субботу'     => 'суббота',
    'воскресенье' => 'воскресенье',
);

$days = get_days();

$group = isset($_GET['group']) ? $_GET['group'] : false;

$group_exists = false;
foreach ($days as $day) {
    foreach ($day['table']['rows'] as $row) {
        if ($row['group'] === $group) {
            $group_exists = true;
            break;
        }
    }
}

$subpage = isset($_GET['free']) ? 'free' : 'schedule';

?>
<? if ($subpage === 'free'): ?>
    <? $day = $days[0]; ?>
    <div class="row">
        <div class="col-xs-12">
            <h4>Где свободно?</h4>
            <ul class="list-unstyled">
                <? foreach ($day['table']['headers'] as $header_i => $header): ?>
                    <li>
                        <strong><?= (int) $header ?>:</strong> <?= implode(', ', $day['free_auditoriums'][$header_i]) ?>
                    </li>
                <? endforeach ?>
            </ul>
        </div>
    </div>
<? elseif ($group_exists): ?>
    <? foreach ($days as $day): ?>
        <div class="row">
            <div class="col-xs-12">
                <h4><?= spaced_group($group) ?>, <?= $deinflect_dow[preg_replace('@Расписание на (.+?),.*@', '\1', $day['header'])] ?></h4>
                <? foreach ($day['table']['rows'] as $row): ?>
                    <? if ($row['group'] === $group): ?>
                        <table class="table table-bordered" style="width: auto">
                            <? $i = 0; foreach ($row['lessons'] as $lesson): ++$i; ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <? foreach ($lesson as $sublesson): ?>
                                        <td colspan="<?= 1 + (2 - count($lesson)) ?>">
                                            <span class="text-muted"><?= $sublesson['auditorium'] ?></span>
                                            <span><?= $sublesson['name'] ?></span>
                                        </td>
                                    <? endforeach ?>
                                </tr>
                            <? endforeach ?>
                        </table>
                    <? endif ?>
                <? endforeach ?>
            </div>
        </div>
    <? endforeach ?>
<? endif ?>
<div class="row">
    <div class="col-xs-12">
        <table>
            <? for ($group_i = 8; $group_i <= 11; ++$group_i): ?>
                <tr>
                    <th class="text-right"><?= $group_i ?>&nbsp;</th>
                    <td>
                        <? foreach ($days as $day): foreach ($day['table']['rows'] as $row): ?>
                            <? if ($row['group'] == $group_i): ?>
                                <a class="btn btn-default btn-xs <? if ($row['group'] === $group): ?>disabled<? endif ?>" href="/tablo/m/<?= $row['group'] ?>/"><?= preg_replace('@\d+@', '', $row['group']) ?></a>
                            <? endif ?>
                        <? endforeach; break; endforeach ?>
                    </td>
                </tr>
            <? endfor ?>
            <tr><td></td><td><a class="btn btn-default btn-xs <? if ($subpage === 'free'): ?>disabled<? endif ?>" href="/tablo/m/free/">Где свободно?</a></td></tr>
        </table>
    </div>
</div>
