---
title: Avatar Hotel - Delete Job
---
<?php 
	include('../../php/db.php');
	include('../../php/form.php');
	$table = params('table');
	$pk = params('pk');
	$id = params('id');
	delete_row($table,$pk,$id); 
?>
<p>
<a href='list.php?table=<?php echo $table ?>'>Back to List</a>
</p>
<p>
<a href='table_list.php'>Back to Table List</a>
</p>