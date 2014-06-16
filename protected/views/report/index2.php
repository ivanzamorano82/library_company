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
<h1>Вывод списка авторов, чьи книги в данный момент читает более трех читателей</h1>

<table class="report">
    <thead>
        <td>Автор</td>
        <td>Читает (кол/чел)</td>
    </thead>
    <?php foreach ($model as $key => $author): ?>
    <tr>
        <td><?php echo $author->name ?></td>
        <td><?php echo count(Author::model()->with('Readers')->findByPk($author->id)->Readers) ?></td>
    </tr>
    <?php endforeach;?>
</table>

