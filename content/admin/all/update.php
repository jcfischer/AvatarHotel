---
title: Avatar Hotel - Update
---
<?php 
	include('../../php/db.php');
    include('../../php/form.php');
	$table = params('table');
	$pk = params('pk');
	$id = params('id');
	form_edit($table,$pk,$id);
?>