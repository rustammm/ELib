<?php
	require_once('../stuff/config.php');
	permission('super');
?>
<a href = "users/add.php" class = 'button success'>
    <?php echo _("Добавить Пользователя"); ?>
</a>
<table class='dataTable display cell-border sortable'>
<thead>
<tr>
<td><?php echo _("НИК"); ?></td>
<td><?php echo _("СТАТУС"); ?></td>
<td>O1</td>
<td>O2</td>
<td>O3</td>
</tr>
</thead>
<tbody>
<?php
$res = sql_select($con, "users");
while($user = mysqli_fetch_assoc($res)){
	if($user['status'] == 1){
		$user['status'] = _("admin")." <i class = 'icon-star on-right'></i>";
	}else{
		$user['status'] = _("user");
	}
	echo "
	<tr>
	<td width = '25%'>{$user['name']}</td> 
	<td width = '25%'> {$user['status']}</td>
	<td>
	<a class = 'button success' href = \"users/change_status.php?id={$user['id']}&status={$user['status']}\"> "._("ИЗМЕНИТЬ СТАТУС")."
	</a>
	</td>
	<td>
	<a class = 'button info' href = 'users/change_password.php?id={$user['id']}&nick={$user['name']}' > "._("ИЗМЕНИТЬ ПАРОЛЬ")."</font>
	</a>
	</td>
	<td>
	<a class = 'button danger' href = 'users/users_delete.php?id={$user['id']}&nick={$user['name']}' >"._("УДАЛИТЬ")."</font>
	</a>
	</td>
	</tr>
	";
}
?>
</tbody>
</table>