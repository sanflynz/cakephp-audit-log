<div class="usuarios form">
  <div class="row">
    <div class="col-md-12">
      <div class="page-header">
        <strong><?= __('Deal');?></strong>
      </div>
    </div>
  </div>
  <div class="row">
  	<div class="col-md-3">
      <div class="actions">
        <div class="panel panel-default">
          <div class="panel-heading">Ações</div>
            <div class="panel-body">
              <ul class="nav nav-pills nav-stacked">
                <li><?php
                echo $this->Html->link(
                  '<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;Audits',
                  array('action' => 'index'),
                  array('escape' => false)
                ); ?></li>

              </ul>
            </div><!-- end body -->
        </div><!-- end panel -->
      </div><!-- end actions -->
    </div><!-- end col md 3 -->
    <div class="col-md-9">
      <div class="panel panel-default">
  		<div class="panel-heading">
    	 <strong><?= __('Deal');?></strong>
  		</div>
  		<div class="panel-body">

<div class="box span9">
	<div class="box-content">
		<div class="row-fluid">
			<div class="span6">
				<div class="page-header">
					<strong><?= __('Event type'); ?></strong>
				</div>
				<p><?= h($audit['Audit']['event']); ?></p>
			</div>
			<div class="span6">
				<div class="page-header">
					<strong><?= __('Model'); ?></strong>
				</div>
				<p><?= h($audit['Audit']['model']); ?></p>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span6">
				<div class="page-header">
					<strong><?= __('Model id'); ?></strong>
				</div>
				<p><?= h($audit['Audit']['entity_id']); ?></p>
			</div>
			<div class="span6">
				<div class="page-header">
					<strong><?= __('Description'); ?></strong>
				</div>
				<p><?= h($audit['Audit']['description']); ?></p>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span6">
				<div class="page-header">
					<strong><?= __('Source'); ?></strong>
				</div>
				<p><?= h($audit['Audit']['source_id']); ?></p>
			</div>
		</div>
	</div>
</div>
<div class="box span3">
	<div class="box-header well">
		<strong><i class="halflings-icon list"></i><span class="break"></span><?= __('In Time'); ?></strong>
	</div>
	<div class="box-content">
		<div class="row-fluid">
			<div class="span4"><strong><?= __('Created'); ?> </strong></div>
			<div class="span8"><?= $this->Time->format($audit['Audit']['created'], '%c', '-'); ?></div>
		</div>
	</div>
</div>

<div class="box span3">
	<div class="box-header well">
		<strong><i class="halflings-icon list"></i><span class="break"></span><?= __('In Numbers'); ?></strong>
	</div>
	<div class="box-content">
		<div class="row-fluid">
			<div class="span6"><strong><?= __('Id'); ?></strong></div>
			<div class="span6"><?= $audit['Audit']['id']; ?></div>
		</div>
		<div class="row-fluid">
			<div class="span6"><strong><?= __('Deltas'); ?> </strong></div>
			<div class="span6"><?= $this->Number->format($audit['Audit']['delta_count']); ?></div>
		</div>
	</div>
</div>

	<style type="text/css">
	del {
		background-color: #f2dede;
	}

	ins {
		color: #3c763d;
		background-color: #dff0d8;
		text-decoration: none;
		border: 1px solid #d6e9c6;
	}

	table.Differences {
		width: 100%;
		font-weight: normal;
	}

	table.Differences th,
	table.Differences td,
	.table tbody tbody {
		border-top: none;
		font-weight: normal;
	}

	td.Left {
		width: 40%;
		border-right: 1px solid black;
		margin-right: 0px;
	}

	td.Right {
		width: 40%;
		margin-left: 5px;
	}

	tbody.ChangeInsert {
		background-color: #dff0d8;
	}

	tbody.ChangeDelete {
		background-color: #f2dede;
	}

	tbody.ChangeReplace {
		background-color: #fcf8e3;
		border-right: 1px solid black;
	}

	tbody.ChangeInsert th,
	tbody.ChangeDelete th,
	tbody.ChangeReplace th {
		width: 2%;
		background-color: #eee;
		text-align: center;
		border-right: 1px solid black;
		border-left: 1px solid black;
	}

	tbody.ChangeInsert td,
	tbody.ChangeDelete td,
	tbody.ChangeReplace td {
		width: 48%;
	}

	</style>

	<?php if (!empty($audit['AuditDelta'])):?>
	<div class="row-fluid">
		<div class="box span12">
			<div class="box-header well">
				<strong><i class="halflings-icon list"></i><span class="break"></span><?= __('Categorize Logs'); ?></strong>
			</div>
			<div class="box-content">
				<table class="table table-conpact">
				<thead>
					<tr>
						<th><?= __('Field'); ?></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($audit['AuditDelta'] as $it) : ?>
					<tr>
						<td><?= $it['property_name'];?></td>
						<td><?= $this->AuditLog->getDiff($it['property_name'], $it['new_value'], $it['old_value']); ?></td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php endif; ?>
		</div>
  	  </div>
    </div><!-- end col md 12 -->
  </div><!-- end row -->
</div>

