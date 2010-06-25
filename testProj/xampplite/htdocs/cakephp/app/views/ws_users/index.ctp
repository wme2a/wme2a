<div class="wsUsers index">
	<h2><?php __('Ws Users');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('user_label');?></th>
			<th><?php echo $this->Paginator->sort('api_key');?></th>
			<th><?php echo $this->Paginator->sort('privileges');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($wsUsers as $wsUser):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $wsUser['WsUser']['id']; ?>&nbsp;</td>
		<td><?php echo $wsUser['WsUser']['user_label']; ?>&nbsp;</td>
		<td><?php echo $wsUser['WsUser']['api_key']; ?>&nbsp;</td>
		<td><?php echo $wsUser['WsUser']['privileges']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $wsUser['WsUser']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $wsUser['WsUser']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $wsUser['WsUser']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $wsUser['WsUser']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Ws User', true), array('action' => 'add')); ?></li>
	</ul>
</div>