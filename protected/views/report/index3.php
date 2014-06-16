<?php
/* @var $this ReportController */

$this->breadcrumbs=array(
	'Report',
);

$this->menu = array(
    array('label'=>'Отчет1', 'url'=>array('index')),
    array('label'=>'Отчет2', 'url'=>array('index2')),
    array('label'=>'Отчет3', 'url'=>array('index3')),
);
?>
<h1>Вывод пяти случайных книг</h1>

<table class="report">
    <thead>
        <td>Книга</td>
        <td>Читатель</td>
        <td>Автор</td>
    </thead>
    
    <?php foreach ($model as $book): ?>
    <tr>
        <td><?php echo $book->title; ?></td>
        <td><?php echo ($book->Reader) ? $book->Reader->name : '-------------------------';?></td>
    </tr>
    <?php endforeach;?>
</table>

