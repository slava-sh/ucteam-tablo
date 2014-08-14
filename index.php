<?php

function preg_matches($pattern, $subject, $set_order = false) {
    $order = $set_order ? PREG_SET_ORDER : PREG_PATTERN_ORDER;
    $ok = preg_match_all($pattern, $subject, $matches, $order);
    return $ok !== 0 && $ok !== false ? $matches : false;
}

function make_empty_empty($items) {
    foreach ($items as &$item) {
        if ($item == '&nbsp;') {
            $item = '';
        }
    }
    return $items;
}

function spaced_group($group) {
    return preg_replace('@(\d+)@', '\1&nbsp;', $group);
}

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

$lesson_name_map = array(
    'Математ'    => 'Математика',
    'Геометр'    => 'Геометрия',
    'Информ'     => 'Информатика',
    'Астроно'    => 'Астрономия',
    'Географ'    => 'География',
    'Литерат'    => 'Литература',
    'Биологи'    => 'Биология',
    'Экономи'    => 'Экономика',
    'Обществ'    => 'Общество',
    'Англ. язык' => 'Английский',
    'Риторик'    => 'Риторика',
    'ИстДрВр'    => 'ИсторияДрВр',
    'ЗарЛит'     => 'Заруба',
    'ВсИстор'    => 'ВсИстория',
);

$cache_time = 10 * 60; // 10 minutes in seconds
$cache_dir = 'cache';
$cache_file = $cache_dir . '/latest.html';

$force_use_cache = true; // $now < new DateTime('23.04.2014 14:00:00');

if (file_exists($cache_file) && ($force_use_cache || filemtime($cache_file) > time() - $cache_time)) {
    $html = file_get_contents($cache_file);
}
else {
    $html = mb_convert_encoding(file_get_contents('http://lyceum.urfu.ru/study/tablo.php'), 'UTF-8', 'cp1251');
    file_put_contents($cache_file, $html, LOCK_EX);
    file_put_contents($cache_dir . '/' . $now->format('y.m.d_D') . '.html', $html, LOCK_EX);
}

$elevens_gone = $now > new DateTime('23.05.2014 00:00:00');

$html_matches = preg_matches('@<h1.*?>(?<header>[^<]*)</h1><table.*?>(?<table><tr>(?<thead>.*?)</tr>(?<tbody>.*?)</table>)@s', $html, true);
$days = array();
foreach ($html_matches as $match) {
    $day = array();
    $day['header'] = split(',', $match['header'], 2)[0];

    $table = array();
    $table['headers'] = make_empty_empty(preg_matches('@<th.*?>(.*?)</th>@s', $match['thead'])[1]);
    array_shift($table['headers']);
    $tbody_matches = preg_matches('@<tr.*?>(.*?)</tr>@s', $match['tbody'])[1];
    foreach ($tbody_matches as $i => $row_match) {
        $row = array();
        $items = make_empty_empty(preg_matches('@<td.*?>(.*?)</td>@s', $row_match)[1]);
        $row['group'] = array_shift($items);
        if ($elevens_gone && $row['group'] == 11) {
            continue;
        }
        $lesson_index = 0;
        foreach ($items as $item) {
            $lesson_index += 1;
            $sublessons = preg_split('@<br.*?>@', $item);
            $lesson = array();
            foreach ($sublessons as $sublesson) {
                $sublesson_match = preg_matches('@<span class=\'aud\'>(?<auditorium>.+?)</span>&nbsp;(?<name>.+)@s', $sublesson, true);
                if ($sublesson_match) {
                    $sublesson = array(
                        'name'       => $sublesson_match[0]['name'],
                        'auditorium' => $sublesson_match[0]['auditorium'],
                    );
                }
                else {
                    $sublesson = array(
                        'name'       => $sublesson,
                    );
                }
                if (isset($lesson_name_map[$sublesson['name']])) {
                    $sublesson['name'] = $lesson_name_map[$sublesson['name']];
                }
                if (empty($sublesson['auditorium'])) {
                    $sublesson['auditorium'] = '';
                }
                $lesson[] = $sublesson;
            }
            $row['lessons'][] = $lesson;
        }
        $table['rows'][$i] = $row;
    }
    $day['table'] = $table;

    $free_auditoriums = array();
    for ($lesson_i = 0; $lesson_i < 7; ++$lesson_i) {
        $auditoriums = array_map('strval', array(
            104, 106, 107, 109, 105,
            200, 201, 211, 212,
            301, 302, 303, 304, 305, 306, 307, 308, 309, 310,
            116, 117, 127, 219, 220, 221, 222, 311, 312, 313, 314, 315
        ));
        $is_free = array();
        foreach ($auditoriums as $i) {
            $is_free[$i] = true;
        }
        foreach ($day['table']['rows'] as $row) {
            foreach ($row['lessons'][$lesson_i] as $sublesson) {
                $is_free[$sublesson['auditorium']] = false;
            }
        }
        $free_auditoriums[$lesson_i] = array();
        foreach ($auditoriums as $auditorium) {
            if ($is_free[$auditorium]) {
                $free_auditoriums[$lesson_i][] = $auditorium;
            }
        }
    }
    $day['free_auditoriums'] = $free_auditoriums;

    $days[] = $day;
}

$lessonsEnd = new DateTime('15:15');
if ($now > $lessonsEnd && count($days) === 2) {
    array_shift($days);
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Табло</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .nobr {
            white-space: nowrap;
        }
        .lessons td, .lessons th.group {
            vertical-align: middle !important;
        }
        th.group {
            text-align: center;
        }
        td.auditorium {
            padding-right: 0 !important;
        }
        td.lesson {
            padding-left: 0 !important;
        }
        td.auditorium > div:after {
            content: '.';
            visibility: hidden;
        }
        tr.highlight {
            background-color: #d9edf7;
        }
        .contacts {
            float: right;
            text-align: right;
        }
        .special {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 2;
            text-align: center;
        }
        .special:before {
            content: '';
            display: inline-block;
            height: 100%;
            vertical-align: middle;
        }
        .special .special-body {
            display: inline-block;
            vertical-align: middle;
            margin-top: -70px;
        }
    </style>
    <link rel="apple-touch-icon-precomposed" href="/tablo/apple-touch-icon.png">
    <meta property="og:title" content="Табло">
    <meta property="og:image" content="http://ucteam.ru/tablo/banner-vk-mo-21.png">
    <meta property="vk:app_id" content="3939277">
    <script src="//yandex.st/jquery/2.0.3/jquery.min.js"></script>
    <script src="//vk.com/js/api/openapi.js?105"></script>
    <script>
        $(function() {
            $('table > tbody.lessons > tr').click(function() {
                $(this).toggleClass('highlight');
            });
            $(decodeURIComponent(location.hash)).addClass('highlight');
        });
    </script>
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
            <p class="hidden">Расписание в СУНЦе УрФУ</p>
            <p class="contacts">Данные с телевизора. Пишите: <a href="mailto:mail@ucteam.ru">mail@ucteam.ru</a></p>
            <p class="social"><span id="vk_like"></span><script>VK.Widgets.Like('vk_like');</script></p>
        </footer>
    </div>
<? endif ?>
</body>
</html>
