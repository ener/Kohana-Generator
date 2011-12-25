<?php defined('SYSPATH') or die('No direct access allowed.');


class Controller_Generator extends Controller
{

	public function action_create_model()
	{

		$generator = new Core_Generator();
		if ($_POST) {
			$table = Arr::get($_POST, 'table');
			$model = Arr::get($_POST, 'model');
			echo $generator->create_model($table, $model);

		} else {
			echo $content = View::factory('core/generator/create_model')->set('tables', $generator->new_model());
		}

	}


	public function action_create_form()
	{

		$generator = new Core_Generator();
		if ($_POST) {
			$model = Arr::get($_POST, 'model');
			echo $generator->create_form($model);

		} else {
			echo $content = View::factory('core/generator/create_form');
		}

	}

} // End Controller_Error