<?php

App::uses('AuditAppController', 'AuditLog.Controller');

class AuditDeltasController extends AuditLogAppController {

	public $uses = array('AuditLog.AuditDelta');

	public $helpers = array('AuditLog.AuditLog');

	public $presetVars = true;

    public $components = array(
        'Crud.Crud' => array(
            'actions' => array(
                // The controller action 'index' will map to the IndexCrudAction
                'admin_index' => 'Crud.Index'
            )
        ),
        'Search.Prg',
        'Paginator'
    );

	public function admin_index()
    {
		if ($this->request->query('id_field') === 'property_name') {
			$this->Paginator->settings['group'] = 'property_name';
		}

		$this->Paginator->settings['order'] = array(
			'Audit.created' => 'asc'
		);

		$this->Paginator->settings['contain'] = array(
			'Audit' => array(
				'fields' => array(
					'Audit.id',
					'Audit.event',
					'Audit.model',
					'Audit.entity_id',
					'Audit.description',
					'Audit.source_id',
					'Audit.created',
					'Audit.delta_count'
				)
			)
		);
        $this->Prg->commonProcess();
        $this->Paginator->settings['conditions'] = $this->AuditDelta->parseCriteria(
            $this->Prg->parsedParams()
        );
        return $this->Crud->execute();

	}

}
