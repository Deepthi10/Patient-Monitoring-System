<?php

/**
 * This is a class that will allow us to connect to the DB and run queries
 * @version 1.0
 * @author paulus_d
 */
class SQL
{
    private $hostname = "Localhost";
    private $database = "id3361169_clinical_master";
    private $username = "id3361169_webuser";
    private $password = "Group";
    public $table;
    
    private $DoctorReport = "select * from id3361169_clinical_master.Doctors";
	private $VisitReport = "select * from id3361169_clinical_master.Visit";
	private $PatientReport = "select * from id3361169_clinical_master.Patient";
	private $FrontReport = "SELECT concat(Doctors.`First Name`, ' ', Doctors.`Last Name`) as 'Doctor Name', Doctors.Specialty, Doctors.`Current Rating`, Temp.PatientCount from id3361169_clinical_master.Doctors inner join (select Visit.DoctorID, count(Visit.PatientID) as PatientCount from id3361169_clinical_master.Visit group by Visit.DoctorID) as Temp on Doctors.`Doctor ID` = Temp.DoctorID";
	
	private $login = "SELECT * FROM id3361169_clinical_master.Login WHERE UserName = '{USERNAME}' and Password = '{PASSWORD}'";
	

    //public function __construct(){

    //}

    function Execute($procedure, $parameters){
        $sql = $this->GetProcedure($procedure, $parameters);
        //printf($sql);
        $link = $this->MakeConnection();

        /* check connection */
        if (mysqli_connect_errno()) {
             printf("Connect failed: %s\n", mysqli_connect_error());
                exit();
            }
        /* Select queries return a resultset */
        $this->table = mysqli_query($link, $sql);
    }
    
    function Insert($procedure){
        $link = $this->MakeConnection();

        /* check connection */
        if (mysqli_connect_errno()) {
             printf("Connect failed: %s\n", mysqli_connect_error());
                exit();
            }
        /* Select queries return a resultset */
        $stmt = mysqli_prepare($link, $procedure);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    
    function MakeConnection(){
        return mysqli_connect($this->hostname, $this->username, $this->password);
    }
    
    //Gets the rows
    function GetRows(){
        return mysqli_fetch_all($this->table,MYSQLI_NUM);
    }
	
	//Gets the row count
	function IsUserNamePasswordValid(){
		if (mysqli_num_rows($this->table) > 0){
			return true;
		}
		return false;
	}
    
    //Gets the columns    
    function GetColumns(){
        return mysqli_fetch_fields($this->table);
    }
    
    //forms the procedure to run
    function GetProcedure($procedure, $parameter){
        $sql = "";
        switch($procedure){
            case "DoctorReport":
                $sql = $this->DoctorReport;
                break;
            case "VisitReport":
                $sql = $this->VisitReport;
                break;
            case "PatientReport":
                $sql = $this->PatientReport;
                break;
            case "FrontReport":
                $sql = $this->FrontReport;
                break;
			case "Login":
				$sql = $this->login;
				$sql = str_replace("{USERNAME}",$parameter[0],$sql);
				$sql = str_replace("{PASSWORD}",$parameter[1],$sql);
				break;
        }
        return $sql;
    }
    
    /* free result set */  
    function CloseConnection(){
        mysqli_free_result($result);
    }
    
    function GetTable(){
       echo "<table class=\"table\" id=\"dataTable\">";
        echo  "<tr>";
        $fields = $this->GetColumns();
        $FieldCount = 0;
        foreach ($fields as $val)
            {
            echo "<th>";
            echo $val->name;
            echo "</th>";
            $FieldCount++;
            }
        
        $RowArray = $this->GetRows();
        foreach ($RowArray as $row)
            {
                echo "<tr>";
                    for($j=0;$j<$FieldCount;$j++){
                        echo "<td>";
                        echo $row[$j];
                        echo "</td>";
                }
                echo "</tr>";
            }
        echo "</tr>";
    echo "</table>";
    }
}
?>
