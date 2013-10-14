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

$page = isset($_GET['mobile']) ? 'mobile' : 'tablo';
if (!isset($_GET['skip_special'])) {
    foreach ($specialDays as $day) {
        if ($day[0] <= $now && $now <= $day[1]) {
            $page = $day[2];
            break;
        }
    }
}

include('common.php');

ob_start();
include('pages/' . $page . '.php');
$contents = ob_get_clean();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Табло</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
    <? if ($page === 'tablo'): ?>
        <style>
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
    <? endif ?>
    <? if ($page === 'mobile'): ?>
        <style>
            .container {
                margin-top: 10px;
            }
        </style>
    <? endif ?>
    <link rel="apple-touch-icon-precomposed" href="/tablo/apple-touch-icon.png">
    <meta property="og:title" content="Табло">
    <meta property="og:image" content="http://ucteam.ru/tablo/banner-vk-mo-21.png">
    <meta property="vk:app_id" content="3939277">
    <? if ($page !== 'mobile'): ?>
        <script src="//yandex.st/jquery/2.0.3/jquery.min.js"></script>
    <? endif ?>
    <? if ($page === 'tablo'): ?>
        <script>
            $(function() {
                $('table > tbody.lessons > tr').click(function() {
                    $(this).toggleClass('highlight');
                });
                $(decodeURIComponent(location.hash)).addClass('highlight');
            });
        </script>
    <? endif ?>
    <? if ($page !== 'mobile'): ?>
        <script src="//vk.com/js/api/openapi.js?105"></script>
    <? endif ?>
</head>
<body>
    <div class="container">
        <? if ($page === 'tablo'): ?>
            <h5 class="mobile-link visible-xs"><a href="/tablo/m/">Мобильная версия</a></h5>
        <? endif ?>

        <?= $contents ?>

        <footer>
            <? if ($page === 'tablo'): ?>
                <p class="social"><span id="vk_like"></span><script>VK.Widgets.Like('vk_like');</script></p>
            <? else: ?>
                <br>
            <? endif ?>
            <? if ($page !== 'mobile'): ?>
                <? if ($page === 'tablo'): ?>
                    <p class="hidden">Расписание в СУНЦе УрФУ</p>
                    <p class="contacts">Данные с телевизора. Пишите: <a href="mailto:mail@ucteam.ru">mail@ucteam.ru</a></p>
                    <p><a href="/tablo/m/">Табло для телефона</a></p>
                <? endif ?>
            <? else: ?>
                <p>Пишите: <a href="mailto:mail@ucteam.ru">mail@ucteam.ru</a></p>
            <? endif ?>
        </footer>
    </div>
    <!-- Yandex.Metrika counter --><script type="text/javascript">var yaParams = { tablo: true, page: 'tablo/<?= $page ?>' };</script><script type="text/javascript">(function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter22576558 = new Ya.Metrika({id:22576558, clickmap:true, accurateTrackBounce:true,params:window.yaParams||{ }}); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks");</script><noscript><div><img src="//mc.yandex.ru/watch/22576558" style="position:absolute; left:-9999px;" alt="" /></div></noscript><!-- /Yandex.Metrika counter -->
</body>
</html>
