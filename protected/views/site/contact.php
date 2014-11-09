
<h1>Contact Us</h1>

<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<table>
		<tr>
			<td width="150px">
				<?php echo $form->label($model,'first_name'); ?>
			</td>
			<td>
				<?php if(!$autorized_user):
						echo $form->textField($model,'first_name');
					  else: 
					    echo CHtml::encode($model->first_name);
					  	echo $form->hiddenField($model, 'first_name');
				      endif; ?>
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
				<?php if(!$autorized_user): 
						echo $form->textField($model,'surname'); 
				 	  else:
				 	  	echo CHtml::encode($model->surname);
				 	  	echo $form->hiddenField($model, 'surname');
				 	  endif;
				 ?>
			</td>
			<td>
				<?php echo $form->error($model,'surname'); ?>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo $form->label($model,'subject'); ?>
			</td>
			<td>
				<?php echo $form->textField($model,'subject',array('size'=>40,'maxlength'=>128)); ?>
			</td>
			<td>
				<?php echo $form->error($model,'subject'); ?>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo $form->label($model,'body'); ?>
			</td>
			<td>
				<?php echo $form->textArea($model,'body',array('rows'=>6, 'cols'=>30)); ?>
			</td>
			<td>
				<?php echo $form->error($model,'body'); ?>
			</td>
		</tr>
		<tr>
			<td>
				<?php $cancel_link = $autorized_user ? '/user/view' : '/';?>
				<?php echo CHtml::Button('Cancel', array('ajax', 'onClick' => "$(location).attr('href','".$cancel_link."');")); ?>
				<?php echo CHtml::submitButton('Submit') ?>
			</td>
			<td>
			</td>
			<td>
			</td>
		</tr>
	</table>	
<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>