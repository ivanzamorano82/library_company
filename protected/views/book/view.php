<?php
/* @var $this BookController */
/* @var $model Book */

$this->breadcrumbs=array(
	'Books'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Book', 'url'=>array('index')),
	array('label'=>'Create Book', 'url'=>array('create')),
	array('label'=>'Update Book', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Book', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Book', 'url'=>array('admin')),
);
?>

<h1>View Book #<?php echo $model->id; ?></h1>
<table class="detail-view">
<?php 
    foreach ($model->attributes as $key => $value) {
        echo '<tr><th>'.$key.'</th>';
        echo '<td>'.$value.'</td></tr>';
    }
    
    if($model->Reader)echo '<tr><th>Читатель</th><td>'.$model->Reader->name.'</td></tr>';  
                
    $x = array();
            foreach ($model->Authors as $author) {
                $x[] = $author->name;
            }
            echo '<tr><th>Авторы</th><td>'.  implode(', ', $x).'</td></tr>';  
?>
</table>

