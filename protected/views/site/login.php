
<div class="loginform">
	<h1>LOGIN</h1>
	
	
	<div class="form">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'login-form',
		'enableClientValidation'=>false,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
	)); ?>
	<table>
		<tr>
			<td>
				<?php echo $form->label($model,'email'); ?>
			</td>
			<td>
				<?php echo $form->textField($model,'email', array('size'=>25)); ?>
			</td>
			<td>
				<?php echo $form->error($model,'email'); ?>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo $form->label($model,'password'); ?>
			</td>
			<td>
				<?php echo $form->passwordField($model,'password', array('size'=>25)); ?>
			</td>
			<td>
				<?php echo $form->error($model,'password'); ?>
			</td>
		</tr>
		<tr>
			<td>
			</td>
			<td>
			<?php echo CHtml::submitButton('Login'); ?>
					or <?php echo CHtml::link('Register', '/site/register'); ?> a new user
					<br>
					<br>
					&nbsp&nbsp&nbsp&nbsp<?php echo CHtml::link('Contact Us', '/site/contact'); ?>
			</td>
			<td>
			</td>
		</tr>
	</table>
			<?php $this->endWidget(); ?>
	</div>
</div>
