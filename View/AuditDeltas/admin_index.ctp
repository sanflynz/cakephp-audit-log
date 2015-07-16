<div class="audits list">
  <div class="row">
    <div class="col-md-12">
      <div class="page-header">
        <h1>Audit log</h1>
      </div>
    </div>
  </div>
  <div class="row">
  	<div class="col-md-12">
      <div class="actions">
        <div class="panel panel-default">
          <div class="panel-heading">Actions</div>
            <div class="panel-body">
              <ul class="nav nav-pills nav-stacked">
                <li><?php
                echo $this->Html->link(
                  '<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;Audits',
                  array(
                  	'controller' => 'audits',
                  	'action' => 'index'
                  ),
                  array('escape' => false)
                ); ?></li>

              </ul>
            </div><!-- end body -->
        </div><!-- end panel -->
      </div><!-- end actions -->
    </div><!-- end col md 3 -->

    <div class="col-md-12">
      <div class="panel panel-default">
  		<div class="panel-heading">
    	 Audit log
  		</div>
  		<div class="panel-body">
	<table class="table table-striped bootstrap-datatable datatable">
		<thead>
		<tr>
			<th><?= $this->Paginator->sort('Audit.created');?></th>
			<th>Resource</th>
			<th><?= $this->Paginator->sort('AuditDelta.property_name');?></th>
			<th><?= $this->Paginator->sort('AuditDelta.old_value');?></th>
			<th><?= $this->Paginator->sort('AuditDelta.new_value');?></th>
			<th><?= $this->Paginator->sort('Audit.id');?></th>
		</tr>
		</thead>
		<tbody>
	<?php foreach ($auditDeltas as $item): ?>
		<tr>
			<td class='center'><?=
				str_replace(
				'on',
				'',
				$this->Time->timeAgoInWords(
					$item['Audit']['created']
				)
			); ?>&nbsp;</td>
			<td class='center'><?= $this->Html->link(
				$item['Audit']['model'] . ' # ' . $item['Audit']['entity_id'],
				array(
					'controller' => 'audits',
					'action' => 'index',
					'?' => array(
						'model' => $item['Audit']['model'],
						'entity_id' => $item['Audit']['entity_id']
					)
				)
			); ?>&nbsp;</td>
			<td class='center'><?=
				h($item['AuditDelta']['property_name']);
			?>&nbsp;</td>
			<td class='center'><?=
				$this->AuditLog->outputValue(
					$item['AuditDelta']['old_value']
				);
			?>&nbsp;</td>
			<td class='center'><?= $this->AuditLog->outputValue(
				$item['AuditDelta']['new_value']
			); ?>&nbsp;</td>
			<td class='center'><?= $this->Html->link(
				$item['Audit']['id'],
				array(
					'controller' => 'audits',
					'action' => 'view',
					$item['Audit']['id']
				)
			); ?>&nbsp;</td>
		</tr>
	<?php endforeach; ?>
		</tbody>
	</table>
	<div class="row-fluid">
		<div class="span12">
			<?= $this->Paginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:start} to {:end} out of {:count}')));?>
		</div>
	</div>
	<?php
        $params = $this->Paginator->params();
        if ($params['pageCount'] > 1) {
        ?>
        <ul class="pagination pagination-sm">
            <?php
                echo $this->Paginator->prev(
                    '&larr; Prev',
                    array('class' => 'prev','tag' => 'li','escape' => false),
                    '<a onclick="return false;">&larr; Prev</a>',
                    array('class' => 'prev disabled','tag' => 'li','escape' => false)
                );
                echo $this->Paginator->numbers(
                    array('separator' => '','tag' => 'li','currentClass' => 'active','currentTag' => 'a')
                );
                echo $this->Paginator->next(
                    'Next &rarr;',
                    array('class' => 'next','tag' => 'li','escape' => false),
                    '<a onclick="return false;">Next &rarr;</a>',
                    array('class' => 'next disabled','tag' => 'li','escape' => false)
                );
            ?>
        </ul>
        <?php } ?>
		</div>
  	  </div>
    </div><!-- end col md 12 -->
  </div><!-- end row -->
</div>
