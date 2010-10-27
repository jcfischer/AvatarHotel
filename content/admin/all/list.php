---
title: Avatar Hotel -List all
---
          <?php 
            include('../../php/db.php');
            include('../../php/form.php');
			$table = params('table');
			
            if (open_db()) {
              $number_of_rows = list_rows($table, '1');
			  $failure = FALSE;
            } else 
            { $failure = TRUE; }
          
          ?>
          <h1>Listing</h1>
          <?php
            if (!$failure) {
          ?>
          <table id='list'>
            <thead>
			<tr>
              <?php  
				$tabs = odbc_tables($dbConn);
				$tables = array();
				while (odbc_fetch_row($tabs)){
					if (odbc_result($tabs,"TABLE_TYPE")=="TABLE") {
						$table_name = odbc_result($tabs,"TABLE_NAME");
							if ($table_name == $table) {
								$tables["{$table_name}"] = array();
								$cols = odbc_exec($dbConn,'select * from '.$table_name.' order by 1');
								$ncols = odbc_num_fields($cols);
								for ($n=1; $n<=$ncols; $n++) {
									$field_name = odbc_field_name($cols, $n);
									echo "<th>". $field_name ."</th>";
								}
								echo('</tr>');
								echo('</thead>');
								echo('</tbody>');
								while (odbc_fetch_row($cols)) 
								{
								 $i = 0; 
								echo " <tr>\n"; 
								while ($i < $ncols) 
								{ 
								$i++; 
								$fieldData = trim(odbc_result($cols, $i));
								 if ($fieldData == "")
									echo " <td>&nbsp;</td>\n";
								else if ($i==1) {echo ('<td><a href="show.php?table='. $table .'&pk=' . odbc_field_name($cols, 1) . '&id=' . $fieldData . '">' . $fieldData . '</a></td>');}
								 else 
								echo " <td>$fieldData</td>\n"; 
								} 
								echo " </tr>\n";
								 }
								echo('</tbody>'); 
							}
					}
				}
				close_db();
			  ?>
          </table>
          <?php } else { ?>
          <div class='error'>
            <p>
              Could not connect to the database
            </p>
          </div>
          <?php } ?>
        </div>
<p>
   <a href='table_list.php'>Back to Table List</a>
</p>