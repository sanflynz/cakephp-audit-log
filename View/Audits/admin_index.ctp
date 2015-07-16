<div class="audits list">
  <div class="row">
    <div class="col-md-12">
      <div class="page-header">
        <h1>Audits</h1>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
  		<div class="panel-heading">
    	 Audits
  		</div>
  		<div class="panel-body">

	<table class="table table-striped bootstrap-datatable datatable">
		<thead>
		<tr>
			<th><?= $this->Paginator->sort('event');?></th>
			<th><?= $this->Paginator->sort('source_id', 'By');?></th>
			<th><?= $this->Paginator->sort('model', 'Resource');?></th>
			<th><?= $this->Paginator->sort('entity_id', 'Identifier');?></th>
			<th><?= $this->Paginator->sort('delta_count', 'Changes');?></th>
			<th><?= $this->Paginator->sort('created');?></th>
			<th class="actions"><?= __('Actions');?></th>
		</tr>
		</thead>
		<tbody>
	<?php foreach ($audits as $item): ?>
		<tr>
			<td><?= $this->AuditLog->getEvent($item); ?></td>
			<td><?= $this->Html->link(
				$this->AuditLog->getSource($item),
				array(
					'action' => 'index',
					'?' => array(
						'source_id' => $item['Audit']['source_id']
					)
				)
			); ?>&nbsp;</td>
			<td><?= $this->Html->link(
				$item['Audit']['model'],
				array(
					'action' => 'index',
					'?' => array(
						'model' => $item['Audit']['model']
					)
				)
			); ?></td>
			<td><?= $this->Html->link(
				$this->AuditLog->getIdentifier($item),
				array(
					'action' => 'index',
					'?' => array(
						'model' => $item['Audit']['model'],
						'entity_id' => $item['Audit']['entity_id']
					)
				)
			); ?></td>
			<td><?= h($item['Audit']['delta_count']); ?>&nbsp;</td>
			<td><span title="<?= h($item['Audit']['created']); ?>"><?=
				str_replace(
					'on',
					'',
					$this->Time->timeAgoInWords(
						$item['Audit']['created']
					)
				);
			?></span></td>
			<td class="actions">
			<?= $this->Html->link(
				'<i class="halflings-icon dashboard"></i>',
				array(
					'controller' => 'audit_deltas',
					'action' => 'index',
					'?' => array(
						'model' => $item['Audit']['model'],
						'entity_id' => $item['Audit']['entity_id']
					)
				),
				array(
					'class' => 'btn btn-info',
					'escape' => false
				)
			); ?>
			<?= $this->Html->link(
				'<i class="halflings-icon eye-open"></i>',
				array(
					'action' => 'view',
					$item['Audit']['id']
				),
				array(
					'class' => 'btn btn-default',
					'escape' => false
				)
			); ?>
			</td>
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

