<?php echo '<?php defined(\'SYSPATH\') or die(\'No direct access allowed.\'); ?>;
<?php if ($errors): ?>
<?php foreach ($errors as $error): ?>
	<ul class="error">
		<?php foreach ($error as $_error): ?>
		<li><?php echo $_error?></li>
		<?php endforeach;?>
	</ul>
	<?php endforeach; ?>
<?php endif; ?>

<?php echo Form::open(NULL, array(\'id\' => \'' . $model . '\')) ?>' . "\n"; ?>
<?php foreach($fields as $field):?>
<?php
	if(!is_null($field->label)){
		$label = "'" . $field->label . "'";

	} else {
		$label = 'false';
	}
?>
<?php switch(get_class($field)) {
	case 'Field_Text':
	echo "\t" . '<?php echo Core_Forms::text_area(\'' . $field->name . '\', $'.$model . '->' . $field->name . ', ' . $label . ', $errors, false);?>;' . "\n";
	break;

	case 'Field_String':
	case 'Field_Float':
	case 'Field_Integer':
		echo "\t" . '<?php echo Core_Forms::text_input(\'' . $field->name . '\', $'.$model . '->' . $field->name . ', ' . $label . ', $errors, false);?>;' . "\n";
		break;

	case 'Field_Boolean':
		echo "\t" . '<?php echo Core_Forms::checkbox(\'' . $field->name . '\', $'.$model . '->' . $field->name . ', ' . $label . ', $errors, false);?>;' . "\n";
		break;
 } ?>
<?php endforeach;?>
<?php echo '<?php echo Form::close() ?>'; ?>

