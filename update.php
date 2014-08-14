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

$now = new DateTime();
$elevens_gone = $now > new DateTime('23.05.2014 00:00:00');

$html = mb_convert_encoding(file_get_contents('http://lyceum.urfu.ru/study/tablo.php'), 'UTF-8', 'cp1251');
file_put_contents($cache_file, $html, LOCK_EX);
file_put_contents($cache_dir . '/' . $now->format('y.m.d_D') . '.html', $html, LOCK_EX);

$html = file_get_contents($cache_file);
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
        $row['group'] = preg_replace('@(\d+)@', '\1 ', array_shift($items));
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

echo json_encode($days);
