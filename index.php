<?php

date_default_timezone_set('Asia/Yekaterinburg');

$specials = json_decode(file_get_contents('specials.json'));

$days = array();
foreach (array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat') as $dow) {
    $days[] = json_decode(file_get_contents("cache/last_{$dow}.json"));
}

$special = false;
if (!isset($_GET['skip_special'])) {
    $now = new DateTime();
    foreach ($specials as list($from, $until, $message)) {
        if (new DateTime($from) <= $now && $now <= new DateTime($until)) {
            $special = $message;
            break;
        }
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Табло</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="apple-touch-icon-precomposed" href="/tablo/apple-touch-icon.png">
    <meta property="og:title" content="Табло">
    <meta property="og:image" content="http://ucteam.ru/tablo/banner-vk-mo-21.png">
    <meta property="vk:app_id" content="3939277">
    <script src="//yandex.st/jquery/2.0.3/jquery.min.js"></script>
    <script src="//vk.com/js/api/openapi.js?105"></script>
</head>
<body>
<? if ($special): ?>
    <div class="special">
        <div class="special-body">
            <h1><?= $special ?></h1>
        </div>
    </div>
<? else: ?>
    <div class="container">
        <? foreach ($days as $day): ?>
            <div class="row">
                <div id="<?= $day->id ?>" class="col-xs-12">
                    <h2><?= $day->header ?></h2>
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th></th>
                                <? foreach ($day->table->headers as $header_i => $header): ?>
                                    <th colspan="2"><?= $header ?></th>
                                <? endforeach ?>
                            </tr>
                        </thead>
                        <tbody class="lessons">
                            <? foreach ($day->table->rows as $row): ?>
                                <? if (!$groups || in_array($row->group, $groups, true)): ?>
                                    <tr>
                                        <th class="group"><?= $row->group ?></th>
                                        <? foreach ($row->lessons as $lesson): ?>
                                            <td class="auditorium text-muted">
                                                <? foreach ($lesson as $sublesson): ?>
                                                    <div><?= $sublesson->auditorium ?></div>
                                                <? endforeach ?>
                                            </td>
                                            <td class="lesson">
                                                <? foreach ($lesson as $sublesson): ?>
                                                    <div><?= $sublesson->name ?></div>
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
                                    <? foreach ($day->table->headers as $header_i => $header): ?>
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
                        <? foreach ($day->table->headers as $header_i => $header): ?>
                            <li>
                                <strong><?= $header ?>:</strong> <?= implode(', ', $day->free_auditoriums[$header_i]) ?>
                            </li>
                        <? endforeach ?>
                    </ul>
                </div>
            </div>
        <? endforeach ?>
        <script>
            var now = new Date();
            window.location.hash = ['Mon', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'][now.getDay()];
        </script>
        <footer>
            <p class="hidden">Расписание в СУНЦе УрФУ</p>
            <p class="contacts">Данные с телевизора. Пишите: <a href="mailto:mail@ucteam.ru">mail@ucteam.ru</a></p>
            <p class="social"><span id="vk_like"></span><script>VK.Widgets.Like('vk_like');</script></p>
        </footer>
    </div>
<? endif ?>
</body>
</html>
