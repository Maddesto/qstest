<?php
/* @var $this UsersController */
/* @var $model Users */


$this->menu=array(
	array('label'=>'List Users', 'url'=>array('index')),
	array('label'=>'Create Users', 'url'=>array('create')),
	array('label'=>'Update Users', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Users', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Users', 'url'=>array('admin')),
);
?>
<div id="toplinks-panel">
	<div id="contact-link" style="float:left">
		<?php echo CHtml::link('Contact Us', '/site/contact'); ?>
	</div>
	<div id="logout-link" style="float:right">
		<?php echo CHtml::link('Logout', '/site/logout'); ?>
	</div>
</div>

<h1><?php echo $model->first_name.' '.$model->surname;?></h1>

	<table width="100%">
			<tr>
				<td>
					<?php echo CHtml::encode($model->getAttributeLabel('username')); ?>:
				</td>
				<td>
					<?php echo CHtml::encode($model->username); ?>
				</td>
			</tr>
			<tr>
				<td>
					<?php echo CHtml::encode($model->getAttributeLabel('email')); ?>:
				</td>
				<td>
					<?php echo CHtml::encode($model->email); ?>
				</td>
			</tr>
			<tr>
				<td>
					<?php echo CHtml::encode($model->getAttributeLabel('gender')); ?>:
				</td>
				<td> 
					<?php $genders = Genders::getGenders();
					echo CHtml::encode($genders[$model->gender]); ?>
				</td>
			</tr>
			<tr>
				<td>
					<?php echo CHtml::encode($model->getAttributeLabel('about')); ?>:
				</td>
				<td>
					<?php echo CHtml::encode($model->about); ?>
				</td>
			</tr>
		</table>
		<div class="row buttons" style="margin-left:30%">
			<?php echo CHtml::Button('Edit',array('ajax', 'onClick' => "$(location).attr('href','/user/update');")); ?>
		</div>
