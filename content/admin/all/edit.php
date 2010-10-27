---
      title: Avatar Hotel - Edit
---
<?php 
		include('../../php/db.php');
		include('../../php/form.php');
			$method = $_SERVER['REQUEST_METHOD'];
            $posted = FALSE;
			$table = params('table');
			$pk = params('pk');
			$id = params('id');
            if($method == "POST") {
			$table = params('table');
			$pk = params('pk');
			$id = params('id');
			echo $table;
              if ($table == 'Comment_Types') {
              $values = array(
                'Desc_En' => array('type' => 'string','value' => params('Desc_En')));
				}
				else if ($table == 'Customer_Comments') {
              $values = array(
                'Name_EN' => array('type' => 'string','value' => params('Name_EN')),
                'email' => array('type' => 'string', 'value' => params('email')),
                'Comment_Type_Id' => array('type' => 'number', 'value' => params('Comment_Type_Id')),
                'Subject' => array('type' => 'string', 'value' => params('Subject')),
                'Message' => array('type' => 'string', 'value' => params('Message')));
				}
				else if ($table == 'Customers') {
              $values = array(
                'Name_EN' => array('type' => 'string','value' => params('Name_EN')),
                'email' => array('type' => 'string', 'value' => params('email')),
                'Telephone' => array('type' => 'number', 'value' => params('Telephone')),
                'Country' => array('type' => 'string', 'value' => params('Country')),
                'Club_Id' => array('type' => 'number', 'value' => params('Club_Id')));
				}
				else if ($table == 'Hotel_Rooms') {
              $values = array(
                'Room_Type_Id' => array('type' => 'number','value' => params('Room_Type_Id')),
                'Room_Disp_Num' => array('type' => 'string', 'value' => params('Room_Disp_Num')),
                'Active_Flag' => array('type' => 'number', 'value' => params('Active_Flag')),
                'Note' => array('type' => 'string', 'value' => params('Note')));
				}
				else if ($table == 'Job_Openings') {
              $values = array(
                'Job_Type_Id' => array('type' => 'number','value' => params('Job_Type_Id')),
                'Job_Title' => array('type' => 'string', 'value' => params('Job_Title')),
                'Desc_En' => array('type' => 'string', 'value' => params('Desc_En')),
                'Skills' => array('type' => 'string', 'value' => params('Skills')),
                'Date_Opened' => array('type' => 'string', 'value' => params('Date_Opened')),
				'Date_Closed' => array('type' => 'string', 'value' => params('Date_Closed')));
				}
				else if ($table == 'Job_Types') {
              $values = array(
                'Desc_EN' => array('type' => 'string','value' => params('Desc_EN')));
				}
				else if ($table == 'Reserved_Rooms') {
              $values = array(
                'Reservied_Date' => array('type' => 'string','value' => params('Reservied_Date')),
                'Customer_ID' => array('type' => 'number', 'value' => params('Customer_ID')),
                'Rent_Rate' => array('type' => 'number', 'value' => params('Rent_Rate')));
				}
				else if ($table == 'Room_Types') {
              $values = array(
                'Desc_EN' => array('type' => 'string','value' => params('Desc_EN')));
				}
				
              open_db();
              update_row($table,$pk,$id,$values);
              close_db();
              $posted = TRUE;
            }
          ?>
          <?php if($posted == FALSE) { ?>
          <?php  form_edit($table,$pk,$id); ?>
          <?php } else { ?>
          <p>
            Update complete
          </p>
		  <p>
			<?php echo('<a href="list.php?table=' . $table . '">Bacl to List</a>'); ?>
		 </p>
          <?php } ?>
        </div>
<p>
   <a href='table_list.php'>Back to Table List</a>
</p>