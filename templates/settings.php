<form id="files_hdrive" class="section">
	<h2><?php p($l->t('Files H-Drive')); ?></h2>
	<?php if (isset($_['hdrive_dependencies']) and ($_['hdrive_dependencies']<>'')) print_unescaped(''.$_['hdrive_dependencies'].''); ?>
	<?php $hdrive = isset($_['hdrive']) ? $_['hdrive'] : "" ?>
	<table id="hdrive" class="grid">
		<thead>
			<tr>
				<th></th>
				<th><?php p($l->t('Folder name')); ?></th>
				<th><?php p($l->t('Host')); ?></th>
				<th><?php p($l->t('Root')); ?></th>
				<th><?php p($l->t('Available for')); ?></th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="status">
					<?php if (isset($hdrive['status'])): ?>
						<span class="<?php p(($hdrive['status']) ? 'success' : 'error'); ?>"></span>
					<?php endif; ?>
				</td>
				<td class="mountpoint"><input type="text" name="mountpoint"
											  value="<?php p(isset($hdrive['mountpoint']) ? $hdrive['mountpoint'] : ''); ?>"
											  data-mountpoint="<?php p(isset($hdrive['mountpoint']) ? $hdrive['mountpoint'] : ''); ?>"
											  placeholder="<?php p($l->t('Folder name')); ?>" />
				</td>
				<td class="host"><input type="text" name="host"
											  value="<?php p(isset($hdrive['host']) ? $hdrive['host'] : ''); ?>"
											  data-mountpoint="<?php p(isset($hdrive['mountpoint']) ? $hdrive['mountpoint'] : ''); ?>"
											  placeholder="<?php p($l->t('Host')); ?>" />
				</td>
				<td class="share"><input type="text" name="share"
											  value="<?php p(isset($hdrive['share']) ? $hdrive['share'] : ''); ?>"
											  data-mountpoint="<?php p(isset($hdrive['share']) ? $hdrive['share'] : ''); ?>"
											  placeholder="<?php p($l->t('Root')); ?>" />
				</td>
				<td class="group"
					align="right"
					data-applicable-groups='<?php if (isset($hdrive['group']))
													print_unescaped(json_encode($hdrive['group'])); ?>'
					>
					<select class="chzn-select"
						multiple style="width:20em;"
						data-placeholder="<?php p($l->t('No group')); ?>">
						<optgroup label="<?php p($l->t('Groups')); ?>">
						<?php foreach ($_['groups'] as $group): ?>
							<option value="<?php p($group); ?>(group)"
							<?php if (isset($hdrive['group']) && in_array($group, $hdrive['group'])): ?>
									selected="selected"
							<?php endif; ?>><?php p($group); ?></option>
						<?php endforeach; ?>
						</optgroup>
					</select>
				</td>
			</tr>
		</tbody>
	</table>
</form>