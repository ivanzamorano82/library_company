<?php
/* @var $this ReaderController */
/* @var $data Reader */
?>
        <?php 
        $books = array();
        if($data->Books)
            foreach ($data->Books as $key => $book) {
                $books[] = $book->title;
            }
        ?>
<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_create')); ?>:</b>
	<?php echo CHtml::encode($data->date_create); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_change')); ?>:</b>
	<?php echo CHtml::encode($data->date_change); ?>
	<br />
        <?php if($books): ?>
        <span class="busy">
            <b><?php echo 'На руках следующие книги'; ?>:</b>
            <?php echo CHtml::encode(implode(', ', $books)); ?>
        </span>    
        <br />
        <?php endif; ?>    
</div>