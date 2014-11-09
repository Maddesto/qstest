<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>


<script type="text/javascript">
function validateListing(form, data, hasError)
{   
	if(hasError)
    {
                
    }
    else
    {
                if($('#step-1').css('display') != 'none')
                {
                        $('#step-1').hide();
                        $('#step-2').show();
                }
                else if($('#step-2').css('display') != 'none')
                {
                        $('#step-2').hide();
                        $('#step-3').show();
                        var vals = $('#users-register-form').serializeArray();
                        $('#surname').html($('#Users_surname').val());
                        $('#username').html($('#Users_username').val());
                        $('#first_name').html($('#Users_first_name').val());
                        $('#email').html($('#Users_email').val());
                        $('#gender').html($('#Users_gender').val() == 'm'? 'Man' : 'Woman');
                        $('#about').html($('#Users_about').val());
                }
                else if($('#step-3').css('display') != 'none')
                {
                	$(location).attr('href','/user/view');
                }

        }
}
$(document).ready(function(){
	$("#cancel-button").click(function(){
		$(location).attr('href','/');
	});
	$("#back-1").click(function(){
		$('#step-2').hide();
		$('#step-1').show();
	})
	$("#back-2").click(function(){
		$('#step-3').hide();
		$('#step-2').show();
	})	
});
</script>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-register-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableClientValidation'=>false,
    'enableAjaxValidation'=>true,
    'clientOptions'=>array(
     	'validateOnChange'=>false,
     	'validateOnSubmit'=>true,
		'afterValidate'=>'js:validateListing',
    	'successCssClass' =>''
	),
        
)); ?>

	<?php //echo $form->errorSummary($model); ?>
	<div id="step-1" style="display:block;">
		<table>
			<tr>
				<td>
					<?php echo $form->label($model,'username'); ?>	
				</td>
				<td>
					<?php echo $form->textField($model,'username'); ?>
				</td>
				<td>
					<?php echo $form->error($model,'username'); ?>
				</td>
			</tr>
			<tr>
				<td>
					<?php echo $form->label($model,'email'); ?>
				</td>
				<td>
					<?php echo $form->textField($model,'email'); ?>
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
					<?php echo $form->passwordField($model,'password'); ?>
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
					<?php echo $form->passwordField($model,'repeat_password'); ?>
				</td>
				<td>
					<?php echo $form->error($model,'repeat_password'); ?>
				</td>
			</tr>
		</table>
		<div class="row buttons">
				<?php echo CHtml::Button('Cancel', array('id' => 'cancel-button')); ?>
				<?php echo CHtml::submitButton('Next', array('name'=>'submit-1')); ?>
		</div>
	</div>
	<div id="step-2" style="display:none;">
		<table>
			<tr>
				<td>
					<?php echo $form->label($model,'first_name'); ?>
				</td>
				<td>
					<?php echo $form->textField($model,'first_name'); ?>
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
					<?php echo $form->textField($model,'surname'); ?>
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
			<?php echo CHtml::Button('Back', array('id' => 'back-1')); ?>
			<?php echo CHtml::submitButton('Next', array('name' => 'submit-2')); ?>
		</div>
	</div>
	
	<div id="step-3" style="display:none;">
		<div>
			<h1><span id="first_name"></span> <span id="surname"></span></h1>
		</div>
		<table>
			<tr>
				<td>
					<?php echo CHtml::encode($model->getAttributeLabel('username')); ?>
				</td>
				<td>
					<span id="username"></span>
				</td>
			</tr>
			<tr>
				<td>
					<?php echo CHtml::encode($model->getAttributeLabel('email')); ?>
				</td>
				<td>
					<span id="email"></span>
				</td>
			</tr>
			<tr>
				<td>
					<?php echo CHtml::encode($model->getAttributeLabel('gender')); ?>
				</td>
				<td>
					<span id="gender"></span>
				</td>
			</tr>
			<tr>
				<td>
					<?php echo CHtml::encode($model->getAttributeLabel('about')); ?>
				</td>
				<td>
					<span id="about"></span>
				</td>
			</tr>
		</table>
		<div class="row buttons">
			<?php echo CHtml::Button('Back', array('id' => 'back-2')); ?>
			<?php echo CHtml::submitButton('Finish', array('name' => 'finish')); ?>
		</div>
	</div>


<?php $this->endWidget(); ?>

</div><!-- form -->