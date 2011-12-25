<?php defined('SYSPATH') or die('No direct script access.'); ?>

class Model_<?php echo $model ?> extends Jelly_Model {
    /**
     * <?php echo $model ?> Model for Jelly ORM
     * @static
     * @param Jelly_Meta $meta
     * @return void
     */
	public static function initialize(Jelly_Meta $meta) {
		$meta->table('<?php echo $table ?>')
			->fields(array(
			//Yours model here
	<?php foreach($fields as $field): ?>
	            '<?php echo $field['name'] ?>' => new <?php echo $field['type'] ?>(
					<?php if(!empty($field['params'])):?>array(
						<?php foreach($field['params'] as $param => $value): ?>
							'<?php echo $param ?>' => '<?php echo $value ?>',
						<?php endforeach; ?>)
					<?php endif;?>
				),
	<?php endforeach; ?>
		));
	}
}