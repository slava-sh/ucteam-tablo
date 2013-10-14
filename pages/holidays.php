<?php

$month = date('F');

?>
<div style="position: absolute; top: 0; bottom: 0; left: 0; right: 0; margin: auto; width: 280px; height: 200px">
    <? if ($month === 'November'): ?>
        <h1>В школу 11 ноября</h1>
    <? elseif ($month === 'January'): ?>
        <h1>В школу 13 января</h1>
    <? elseif ($month === 'March'): ?>
        <h2>В школу в понедельник, 31 марта</h2>
    <? else: ?>
        <h1>Сейчас каникулы</h1>
    <? endif ?>
</div>
