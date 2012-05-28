<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'View User', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<h1>Update User <?php echo $model->id; ?></h1>

<?php 
	if(Yii::app()->user->checkAccess('admin'))
		echo $this->renderPartial('_form-update-admin', array('model'=>$model)); 
	else
		echo $this->renderPartial('_form-update-user', array('model'=>$model)); 
?>