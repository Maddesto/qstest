<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>
<table>


<tr><td></td></tr></table>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
	<table>
		<tr>
			<td>
				<?php echo $form->label($model,'username'); ?>
			</td>
			<td>
				<?php echo $form->textField($model,'username',array('size'=>30,'maxlength'=>30)); ?>
			</td>
			<td>
				<?php echo $form->error($model,'username'); ?>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo $form->labelEx($model,'password'); ?>
			</td>
			<td>
				<?php echo $form->passwordField($model,'password',array('size'=>30,'maxlength'=>30, 'value'=>'')); ?>
			</td>
			<td>
				<?php echo $form->error($model,'password'); ?>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo $form->label($model,'repeat_password'); ?>
			</td>
			<td>
				<?php echo $form->passwordField($model,'repeat_password',array('size'=>30,'maxlength'=>30, 'value'=>'')); ?>
			</td>
			<td>
				<?php echo $form->error($model,'repeat_password'); ?>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo $form->label($model,'email'); ?>
			</td>
			<td>
				<?php echo $form->textField($model,'email',array('size'=>30,'maxlength'=>30)); ?>
			</td>
			<td>
				<?php echo $form->error($model,'email'); ?>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo $form->label($model,'first_name'); ?>
			</td>
			<td>
				<?php echo $form->textField($model,'first_name',array('size'=>30,'maxlength'=>30)); ?>
			</td>
			<td>
				<?php echo $form->error($model,'first_name'); ?>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo $form->label($model,'surname'); ?>
			</td>
			<td>
				<?php echo $form->textField($model,'surname',array('size'=>30,'maxlength'=>30)); ?>
			</td>
			<td>
				<?php echo $form->error($model,'surname'); ?>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo $form->label($model,'gender'); ?>
			</td>
			<td>
				<?php echo $form->dropDownList($model,'gender', Genders::getGenders()); ?>
			</td>
			<td>
				<?php echo $form->error($model,'gender'); ?>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo $form->label($model,'about'); ?>
			</td>
			<td>
				<?php echo $form->textArea($model,'about',array('rows'=>6, 'cols'=>30)); ?>
			</td>
			<td>
				<?php echo $form->error($model,'about'); ?>
			</td>
		</tr>
	</table>
	<div class="row buttons">
		<?php echo CHtml::Button('Cancel',array('ajax', 'onClick' => "$(location).attr('href','/user/view/');")); ?>
		<?php echo CHtml::submitButton('Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->