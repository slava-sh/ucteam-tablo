<?php

date_default_timezone_set('Asia/Yekaterinburg');

$specials = json_decode(file_get_contents('specials.json'));

$days = array();
foreach (array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat') as $dow) {
    $days[] = json_decode(file_get_contents("cache/last_{$dow}.json"));
}

$page = 'tablo';
$special = false;
if (!isset($_GET['skip_special'])) {
    $now = new DateTime();
    foreach ($specials as list($from, $until, $message)) {
        if (new DateTime($from) <= $now && $now <= new DateTime($until)) {
            $page = 'special';
            $special = $message;
            break;
        }
    }
}

include('common.php');
ob_start();
include("pages/{$page}.php");
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
    <div class="container">
        <?= $contents ?>
    </div>
</body>
</html>
