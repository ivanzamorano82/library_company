<?php
/* @var $this BookController */
/* @var $model Book */
/* @var $form CActiveForm */
?>
            
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'book-form',
	'enableAjaxValidation'=>true,
//        'enableClientValidation'=>true,
//	'clientOptions'=>array(
//		'validateOnSubmit'=>true,
//	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'authorArray'); ?>
            <?php echo $form->dropDownList($model, 'authorArray', CHtml::listData(Author::model()->findAll(), 'id', 'name'), array('multiple' => 'multiple', 'size' => '10' )) ?>
		<?php echo $form->error($model,'authorArray'); ?>
	</div>
        
        <div class="row">
            <?php echo $form->labelEx($model,'reader_id'); ?>
            <?php echo $form->dropDownList($model, 'reader_id', CHtml::listData(Reader::model()->findAll(), 'id','name'), array('empty'=>'(нет читателя)')) ?>
            <?php echo $form->error($model,'reader_id'); ?>
        </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->