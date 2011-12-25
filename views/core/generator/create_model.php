<?php defined('SYSPATH') or die('No direct script access.'); ?>
<h1>Create Jelly model from table</h1>
<?php echo Form::open(); ?>

<?php echo Form::label('model', 'model name') ?>
<?php echo Form::input('model') ?>
<?php echo Form::label('table', 'select table') ?>
<?php echo Form::select('table', $tables) ?>
<?php echo Form::submit('submit', 'create model') ?>

<?php Form::close(); ?>
