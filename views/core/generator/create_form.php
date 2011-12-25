<?php defined('SYSPATH') or die('No direct script access.'); ?>
<h1>Create form from Jelly model</h1>
<?php echo Form::open(); ?>

<?php echo Form::label('model', 'model name') ?>
<?php echo Form::input('model') ?>
<?php echo Form::submit('submit', 'create form') ?>

<?php Form::close(); ?>
