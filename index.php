<?php

date_default_timezone_set('Asia/Yekaterinburg');

$specialDays = array(
    array('03.11.2013', '09.11.2013', 'holidays'),
    array('13.12.2013', '14.12.2013', 'olympic_flame'),
    array('21.12.2013', '28.12.2013', 'session'),
    array('29.12.2013', '11.01.2014', 'holidays'),
    array('22.03.2014', '29.03.2014', 'holidays'),
    array('02.06.2014', '11.06.2014', 'session'),
    array('12.06.2014', '12.06.2014', 'russia_day'),
    array('13.06.2014', '14.06.2014', 'session'),
    array('15.06.2014', '30.08.2014', 'summer'),
);

foreach ($specialDays as &$day) {
    $day[0] = new DateTime($day[0]);
    $day[1] = new DateTime($day[1]);
    $day[1]->setTime(23, 59, 59);
}
unset($day);

$now = new DateTime();

if (!isset($_GET['skip_special'])) {
//     foreach ($specialDays as $day) {
//         if ($day[0] <= $now && $now <= $day[1]) {
//             $page = $day[2];
//             break;
//         }
//     }
}

include('common.php');

ob_start();
include('pages/tablo.php');
$contents = ob_get_clean();

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
        .mobile-link {
            margin-bottom: -10px;
        }
        .contacts {
            float: right;
            text-align: right;
        }
    </style>
    <link rel="apple-touch-icon-precomposed" href="/tablo/apple-touch-icon.png">
    <meta property="og:title" content="Табло">
    <meta property="og:image" content="http://ucteam.ru/tablo/banner-vk-mo-21.png">
    <meta property="vk:app_id" content="3939277">
    <script src="//yandex.st/jquery/2.0.3/jquery.min.js"></script>
    <script>
        $(function() {
            $('table > tbody.lessons > tr').click(function() {
                $(this).toggleClass('highlight');
            });
            $(decodeURIComponent(location.hash)).addClass('highlight');
        });
    </script>
    <script src="//vk.com/js/api/openapi.js?105"></script>
</head>
<body>
    <div class="container">
        <h5 class="mobile-link visible-xs"><a href="/tablo/m/">Мобильная версия</a></h5>

        <?= $contents ?>

        <footer>
            <p class="social"><span id="vk_like"></span><script>VK.Widgets.Like('vk_like');</script></p>
            <p class="hidden">Расписание в СУНЦе УрФУ</p>
            <p class="contacts">Данные с телевизора. Пишите: <a href="mailto:mail@ucteam.ru">mail@ucteam.ru</a></p>
            <p><a href="/tablo/m/">Табло для телефона</a></p>
        </footer>
    </div>
</body>
</html>
