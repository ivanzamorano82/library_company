<?php
/* @var $this BookController */
/* @var $model Book */
/* @var $form CActiveForm */
?>
            
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'book-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'authors'); ?>
            <select multiple="multiple" size="10" name="Book[authors][]" id="Book_authors">
                <?php 
                $authors = Author::model()->findAll();
                
                $sel =array();
                if(isset($model->id)){
                    $book   = $model->with('Authors')->findByPk($model->id);
                    foreach ($book->Authors as $key => $value) {
                        $sel[] = $value->id; // заполняем массив авторов у текущей книги для выделения при редактировании
                    }
                }
                 foreach (CHtml::listData($authors,'id','name') as $key => $value) {
                     $selected = (in_array($key, $sel)) ? 'selected' : '';
                     echo '<option '.$selected.' value="'.$key.'">'.$value.'</option>';
                 }
                ?>
            </select>
		
		<?php echo $form->error($model,'authors'); ?>
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