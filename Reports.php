		<form method="post">
		<div class="panel-heading">Reports</div>
		<div class="dropdown">
		    <select name="Report">
		    	<option value="DoctorReport">Doctor Report</option>
			    <option value="VisitReport">Visit Report</option>
			    <option value="PatientReport">Patient Report</option>
		    </select>
		    <input type="submit" name="ReportSubmit" value="Filter" />
		 </div>
        </form>

		    <?php
		    if(isset($_POST['ReportSubmit'])){
            $selected_val = $_POST['Report'];  // Storing Selected Value In Variable
		    require_once('SQL.php');
            $sql = new SQL;
            $sql->Execute($selected_val,array());
            $sql->GetTable();
            $sql->CloseConnection();
		    exit;
		    }
		    ?>
