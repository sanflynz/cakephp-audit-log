<?php

App::uses('AuditAppController', 'AuditLog.Controller');

class AuditsController extends AuditLogAppController {

	public $uses = array('AuditLog.Audit');

	public $helpers = array('AuditLog.AuditLog');

    public $components = array(
        'Crud.Crud' => array(
            'actions' => array(
                // The controller action 'index' will map to the IndexCrudAction
                'admin_index' => 'Crud.Index',
                // The controller action 'view' will map to the ViewCrudAction
                'admin_view'  => 'Crud.View'
            )
        ),
        'Search.Prg',
        'Paginator'
    );

	public $presetVars = true;

	public function beforeFilter() {
		parent::beforeFilter();

		$this->Crud->on('beforeLookup', function($event) {
			$this->Paginator->settings['group'] = $this->request->query('id_field');
		});
	}

	public function admin_index() {
		$this->Paginator->settings['fields'] = array(
			'Audit.id',
			'Audit.event',
			'Audit.model',
			'Audit.entity_id',
			'Audit.description',
			'Audit.source_id',
			'Audit.created',
			'Audit.delta_count',
		);
        $request = $this->request;
        $self = $this;

        $this->Prg->commonProcess();
        $this->Paginator->settings['conditions'] = $this->Audit->parseCriteria(
            $this->Prg->parsedParams()
        );
		$this->Crud->on('beforePaginate', function($event) use ($request, $self) {
			if ($model = $request->query('model')) {
				$Instance = ClassRegistry::init($model);

				$displayField = $Instance->displayField;
				$self->Paginator->settings['do_count'] = empty($Instance->noAuditCount);
				$self->Paginator->settings['fields'][] = $model . '.' . $displayField;
				$self->Paginator->settings['joins'][] = array(
					'alias' => $model,
					'table' => $Instance->useTable,
					'conditions' => array(
                        $Instance->alias . '.id = Audit.entity_id'
                    ),
					'type' => 'INNER'
				);

				$self->set(compact('model', 'displayField'));
			}
            $self->Paginator->settings['do_count'] = true;
		});

		return $this->Crud->execute();
	}

	public function admin_view($id) {
		$this->Crud->on('beforeFind', function($event) {
			$event->subject->query['contain'][] = 'AuditDelta';
		});

		return $this->Crud->execute();
	}

}
