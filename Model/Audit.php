<?php

App::uses('Model', 'Model');

class Audit extends Model {

	public $hasMany = array(
		'AuditDelta' => array(
			'className' => 'AuditLog.AuditDelta'
		)
	);

    public $actsAs = array(
        'Containable',
        'Search.Searchable'
    );

	public $order = array(
		'Audit.id' => 'desc'
	);

    public $filterArgs = array(
        'event'         => array('type' => 'value'),
        'model'         => array('type' => 'value'),
        'source_id' => array('type' => 'value'),
        'entity_id' => array('type' => 'value'),
    );

	public $recursive = -1;

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
