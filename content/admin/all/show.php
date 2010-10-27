---
  title: Avatar Hotel - Show
---
          <?php 
            include('../../php/db.php');
            include('../../php/form.php');
          
            $id = params('id');
			$table = params('table');
			$pk = params('pk');
            open_db();
            $found = select_row($table, $pk, $id);
          
          ?>
          <h1>Show Details</h1>
          <?php if(!$found == FALSE) { ?>
          <table id='show_details'>
            <thead>
              <th>Field</th>
              <th>Value</th>
            </thead>
            <tbody>
              <?php
					$ncols = odbc_num_fields($dbResult);
					for ($n=1; $n<=$ncols; $n++) {
						$field_name = odbc_field_name($dbResult, $n);
						$fieldData = trim(odbc_result($dbResult, $n));
						echo('<tr>');
						echo "<th>". $field_name ."</th>";
						echo "<th>". $fieldData ."</th>";
						echo('</tr>');
					}
              ?>
            </tbody>
          </table>
          <?php } else { ?>
          <p>
            No Data found
          </p>
          <?php 
            }
            close_db();
          ?>
		  <p>
            <a href="edit.php?table=<?php echo $table ?>&pk=<?php echo $pk ?>&id=<?php echo $id ?>">Edit</a>
          </p>
          <p>
            <a href="delete.php?table=<?php echo $table ?>&pk=<?php echo $pk ?>&id=<?php echo $id ?>">Delete</a>
          </p>
          <p>
            <a href='list.php?id=<?php echo $table ?>'>Back to List</a>
          </p>
		  <p>
            <a href='table_list.php'>Back to Table List</a>
          </p>