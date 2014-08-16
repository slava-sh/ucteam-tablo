<?php

date_default_timezone_set('Asia/Yekaterinburg');

$config = json_decode(file_get_contents('config.json'));
$config->lesson_name_map = (array) $config->lesson_name_map;

$now = new DateTime();
$elevens_gone = $now > new DateTime($config->no_elevens);

$deinflect_day_of_week = array(
    'понедельник' => 'понедельник',
    'вторник'     => 'вторник',
    'среду'       => 'среда',
    'четверг'     => 'четверг',
    'пятницу'     => 'пятница',
    'субботу'     => 'суббота',
    'воскресенье' => 'воскресенье',
);

$day_of_week_id = array(
    'понедельник' => 'Mon',
    'вторник'     => 'Tue',
    'среда'       => 'Wed',
    'четверг'     => 'Thu',
    'пятница'     => 'Fri',
    'суббота'     => 'Sat',
    'воскресенье' => 'Sun',
);

function preg_matches($pattern, $subject, $set_order = false) {
    $order = $set_order ? PREG_SET_ORDER : PREG_PATTERN_ORDER;
    $ok = preg_match_all($pattern, $subject, $matches, $order);
    return $ok !== 0 && $ok !== false ? $matches : false;
}

if (isset($_GET['file'])) {
    $file = strval($_GET['file']);
    echo "Reading from $file<br>";
    $html = file_get_contents($file);
}
else {
    $html = mb_convert_encoding(file_get_contents('http://lyceum.urfu.ru/study/tablo.php'), 'UTF-8', 'cp1251');
    $cache_file = 'cache/' . $now->format('y.m.d_D') . '.html';
    file_put_contents($cache_file, $html);
    echo "Cached to {$cache_file}<br>";
}

$html = html_entity_decode(str_replace('&nbsp;', ' ', $html));
$html_matches = preg_matches('@<h1.*?>(?<header>[^<]*)</h1><table.*?>(?<table><tr>(?<thead>.*?)</tr>(?<tbody>.*?)</table>)@s', $html, true);
if (!$html_matches) {
    echo 'No schedule found<br>';
    exit();
}
foreach ($html_matches as $match) {
    $day = array();
    $inflected_day_of_week = preg_matches('@Расписание на (.+?),@', $match['header'])[1][0];
    $day['day_of_week'] = $deinflect_day_of_week[$inflected_day_of_week];
    $day['id'] = $day_of_week_id[$day['day_of_week']];

    echo "Processing {$day['id']}<br>";

    $day['table'] = array();
    $tbody_matches = preg_matches('@<tr.*?>(.*?)</tr>@s', $match['tbody'])[1];
    foreach ($tbody_matches as $row_match) {
        $row = array();
        $items = preg_matches('@<td.*?>(.*?)</td>@s', $row_match)[1];
        $row['group'] = preg_replace('@(\d+)@', '\1 ', array_shift($items));
        if ($elevens_gone && $row['group'] == 11) {
            continue;
        }
        foreach ($items as $item) {
            $sublessons = preg_split('@<br.*?>@', $item);
            $lesson = array();
            foreach ($sublessons as $sublesson) {
                $sublesson_match = preg_matches('@(<span class=\'aud\'>(?<auditorium>.+?)</span>)?\s*(?<name>.*)@s', $sublesson, true);
                $sublesson = array(
                    'name'       => trim($sublesson_match[0]['name']),
                    'auditorium' => trim($sublesson_match[0]['auditorium']),
                );
                if (isset($config->lesson_name_map[$sublesson['name']])) {
                    $sublesson['name'] = $config->lesson_name_map[$sublesson['name']];
                }
                $lesson[] = $sublesson;
            }
            $row['lessons'][] = $lesson;
        }
        $day['table'][] = $row;
    }

    $free_auditoriums = array();
    for ($lesson_i = 0; $lesson_i < 7; ++$lesson_i) {
        $is_free = array();
        foreach ($config->auditoriums as $auditorium) {
            $is_free[$auditorium] = true;
        }
        foreach ($day['table'] as $row) {
            foreach ($row['lessons'][$lesson_i] as $sublesson) {
                $is_free[$sublesson['auditorium']] = false;
            }
        }
        $free_auditoriums[$lesson_i] = array();
        foreach ($config->auditoriums as $auditorium) {
            if ($is_free[$auditorium]) {
                $free_auditoriums[$lesson_i][] = $auditorium;
            }
        }
    }
    $day['free_auditoriums'] = $free_auditoriums;

    file_put_contents("cache/last_{$day['id']}.json", json_encode($day));
}
