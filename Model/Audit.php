<?php

App::uses('Model', 'Model');

class Audit extends Model {

	public $hasMany = array(
		'AuditDelta' => array(
			'className' => 'AuditLog.AuditDelta'
		)
	);

	public $actsAs = array(
		'Containable'
	);

	public $order = array(
		'Audit.id' => 'desc'
	);

	public $recursive = -1;

	public function setupSearchPlugin() {
		$this->filterArgs = array(
			'event' 		=> array('type' => 'value'),
			'model' 		=> array('type' => 'value'),
			'source_id' => array('type' => 'value'),
			'entity_id' => array('type' => 'value'),
		);

		$this->Behaviors->load('Search.Searchable');
	}

/**
 * Make sure not to include any join's in the COUNT(*) from paginator
 *
 * @param  array $conditions
 * @param  integer $recursive
 * @param  array $extra
 * @return integer
 */
	public function paginateCount($conditions, $recursive, $extra) {
		if (empty($extra['do_count'])) {
			return 10000;
		}

		return $this->find('count', compact('conditions'));
	}

}
