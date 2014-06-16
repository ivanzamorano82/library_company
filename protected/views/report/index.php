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
<h1>Вывод списка книг, находящихся на руках у читателей, и имеющих не менее трех со-авторов</h1>

<table class="report">
    <thead>
        <td>Книга</td>
        <td>На руках</td>
        <td>Количество авторов</td>
    </thead>
    <?php foreach ($model as $key => $book): ?>
    <tr>
        <td><?php echo $book->title ?></td>
        <td>Да</td>
        <td><?php echo $book->AuthorsCount ?></td>
    </tr>
    <?php endforeach;?>
</table>

