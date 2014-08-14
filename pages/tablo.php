<?php

$days = get_days();
$groups = isset($_GET['groups']) ? $_GET['groups'] : false;

?>
<h5 class="mobile-link visible-xs"><a href="/tablo/m/">Мобильная версия</a></h5>
<? foreach ($days as $day): ?>
    <div class="row">
        <div class="col-xs-12">
            <h2><?= $day['header'] ?></h2>
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th></th>
                        <? foreach ($day['table']['headers'] as $header_i => $header): ?>
                            <th colspan="2"><?= $header ?></th>
                        <? endforeach ?>
                    </tr>
                </thead>
                <tbody class="lessons">
                    <? foreach ($day['table']['rows'] as $row): ?>
                        <? if (!$groups || in_array($row['group'], $groups, true)): ?>
                            <tr id="<?= $row['group'] ?>">
                                <th class="group"><?= spaced_group($row['group']) ?></th>
                                <? foreach ($row['lessons'] as $lesson): ?>
                                    <td class="auditorium text-muted">
                                        <? foreach ($lesson as $sublesson): ?>
                                            <div><?= $sublesson['auditorium'] ?></div>
                                        <? endforeach ?>
                                    </td>
                                    <td class="lesson">
                                        <? foreach ($lesson as $sublesson): ?>
                                            <div><?= $sublesson['name'] ?></div>
                                        <? endforeach ?>
                                    </td>
                                <? endforeach ?>
                            </tr>
                        <? endif ?>
                    <? endforeach ?>
                </tbody>
                <? if (!$groups || count($groups) > 5): ?>
                    <tfoot>
                        <tr>
                            <th></th>
                            <? foreach ($day['table']['headers'] as $header_i => $header): ?>
                                <th colspan="2"><?= $header ?></th>
                            <? endforeach ?>
                        </tr>
                    </tfoot>
                <? endif ?>
            </table>
        </div>
        <div class="col-xs-12">
            <h3>Где свободно?</h3>
            <ul class="list-unstyled">
                <? foreach ($day['table']['headers'] as $header_i => $header): ?>
                    <li>
                        <strong><?= $header ?>:</strong> <?= implode(', ', $day['free_auditoriums'][$header_i]) ?>
                    </li>
                <? endforeach ?>
            </ul>
        </div>
    </div>
<? endforeach ?>
<footer>
    <p class="social"><span id="vk_like"></span><script>VK.Widgets.Like('vk_like');</script></p>
    <p class="hidden">Расписание в СУНЦе УрФУ</p>
    <p class="contacts">Данные с телевизора. Пишите: <a href="mailto:mail@ucteam.ru">mail@ucteam.ru</a></p>
    <p><a href="/tablo/m/">Табло для телефона</a></p>
</footer>
