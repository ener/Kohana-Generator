<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Class Core_Generator
 *
 * @author Andrey Verstov <andrey@verstov.ru>
 * @copyright (c) Andrey Verstov <http://verstov.ru>
 *
 */
class Core_Generator
{
	private $_header = "<?php defined('SYSPATH') or die('No direct access allowed.');\n\r";

	public function __construct()
	{

	}

	public function new_model()
	{
		$tables = $this->_get_tables();
		$result = array();
		foreach ($tables as $key => $value) {
			$result[$value] = $value;
		}
		return $result;
	}

	public function create_model($table, $model)
	{
		$columns = $this->_get_columns($table);
		$fields = array();
		foreach ($columns as $key => $column) {
			$fields[$key] = $this->_mysql_field_to_jelly($column);
		}
		$file = View::factory('core/generator/model')
				->set('table', $table)
				->bind('fields', $fields)
				->set('model', $model)
				->render();

		$result = $this->_header . $file;
		return $result;
	}

	public function create_form($model)
	{
		$fields = Jelly::meta($model)->fields();

		$result = View::factory('core/generator/form')
						->set('fields', $fields)
						->set('model', $model)
						->render();


		return $result;
	}

	private function _get_tables()
	{
		return Database::instance()->list_tables();
	}

	private function _get_columns($table)
	{
		return Database::instance()->list_columns($table);
	}

	private function _mysql_field_to_jelly($column)
	{
		$result = array(
			'name' => $column['column_name'],
			'params' => array()
		);
		switch ($column['data_type']) {
			case 'int':
			case 'int unsigned':
				if ($column['key'] == 'PRI') {
					$result['type'] = 'Field_Primary';
				} elseif ($column['key'] == 'MUL') {
					$result['type'] = 'Field_BelongsTo';
				} else {
					$result['type'] = 'Field_Integer';
				}
				break;
			case 'varchar':
			case 'char':
				$result['type'] = 'Field_String';
				break;
			case 'text':
			case 'fulltext':
				$result['type'] = 'Field_Text';
				break;
			case 'float':
			case 'float unsigned':
				$result['type'] = 'Field_Float';
				break;
			case 'tinyint':
				$result['type'] = 'Field_Boolean';
				break;
		}

		if ($column['comment'] != '') {
			$result['params']['label'] = $column['comment'];
		}

		//		if(array_key_exists('character_maximum_length', $column)){
		//			$result['params']['rules']['max_length'] = $column['character_maximum_length'];
		//		}
		return $result;
	}

} // End Core_Generator