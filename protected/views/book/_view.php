<?php
/* @var $this BookController */
/* @var $data Book */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_create')); ?>:</b>
	<?php echo CHtml::encode($data->date_create); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_change')); ?>:</b>
	<?php echo CHtml::encode($data->date_change); ?>
	<br />
        
        <b><?php echo CHtml::encode($data->getAttributeLabel('Authors.author_id')); ?>:</b>
	<?php
            $x = array();
            foreach ($data->Authors as $author) {
                $x[] = $author->name;
            }
            echo CHtml::encode(implode(', ', $x)); 
        ?>
	<br />

</div>