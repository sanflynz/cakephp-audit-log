<?php

App::uses('Model', 'Model');

class AuditDelta extends Model {

	public $belongsTo = array(
		'Audit' => array(
			'className' => 'AuditLog.Audit',
			'counterCache' => 'delta_count'
		)
	);

	public $actsAs = array(
        'Containable',
        'Search.Searchable'
    );

	public $recursive = -1;

    public $filterArgs = array(
        'source_id' => array(
            'type'  => 'value',
            'field' => 'Audit.source_id',
            'model' => 'Audit',
            'fields' => array(
                'id' => 'source_id',
                'label' => 'source_id',
                'value' => 'source_id'
            )
        ),
        'model' => array(
            'type'  => 'value',
            'field' => 'Audit.model',
            'model' => 'Audit',
            'fields' => array(
                'id' => 'model',
                'label' => 'model',
                'value' => 'model'
            )
        ),
        'entity_id' => array(
            'type'  => 'value',
            'field' => 'Audit.entity_id',
            'model' => 'Audit',
            'fields' => array(
                'id' => 'entity_id',
                'label' => 'entity_id',
                'value' => 'entity_id'
            )
        ),
        'property_name' => array('type' => 'value'),
        'old_value'         => array('type' => 'value'),
        'new_value'         => array('type' => 'value'),
    );
}
