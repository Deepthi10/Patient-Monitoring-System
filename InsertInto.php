<?php
/**
 * This is a class that will allow us to connect to the DB and run queries
 * @version 1.0
 * @author paulus_d
 */
class InsertInto
{
    private $doctorInsert = "Insert Into id3361169_clinical_master.Doctors(`First Name`, `Last Name`, `Specialty`, `Current Rating`) values('[1]','[2]','[3]','[4]')";
    
    private $patientInsert = "INSERT INTO id3361169_clinical_master.Patient(`First Name`, `Last Name`, `DOB`, `Gender`) VALUES ('[1]','[2]','[3]','[4]')";
    
    private $visitInsert = "INSERT INTO id3361169_clinical_master.Visit(`PatientID`, `DoctorID`, `VisitDate`, `DeskCheck_DT`, `NurseMet_DT`, `DocMet_DT`, `DelayReason`) VALUES ('[1]','[2]','[3]','[4]','[5]','[6]','[7]')";

    function Execute($procedure, $parameters){
        require_once('SQL.php');
        $sql =  $this->GetProcedure($procedure, $parameters);
        $sqlObj = new SQL;
        $sqlObj->Insert($sql);
    }
    
    //forms the procedure to run
    function GetProcedure($procedure, $parameter){
        $sql = "";
        switch($procedure){
            case "DoctorInsert":
                $sql = $this->doctorInsert;
                $sql = str_replace("[1]",$parameter[0],$sql);
                $sql = str_replace("[2]",$parameter[1],$sql);
                $sql = str_replace("[3]",$parameter[2],$sql);
                $sql = str_replace("[4]",$parameter[3],$sql);
                break;
            case "VisitInsert":
                $sql = $this->visitInsert;
                $sql = str_replace("[1]",$parameter[0],$sql);
                $sql = str_replace("[2]",$parameter[1],$sql);
                $sql = str_replace("[3]",$parameter[2],$sql);
                $sql = str_replace("[4]",$parameter[3],$sql);
                $sql = str_replace("[5]",$parameter[4],$sql);
                $sql = str_replace("[6]",$parameter[5],$sql);
                $sql = str_replace("[7]",$parameter[6],$sql);
                break;
            case "PatientInsert":
                $sql = $this->patientInsert;
                $sql = str_replace("[1]",$parameter[0],$sql);
                $sql = str_replace("[2]",$parameter[1],$sql);
                $sql = str_replace("[3]",$parameter[2],$sql);
                $sql = str_replace("[4]",$parameter[3],$sql);
                break;
        }
        return $sql;
    }
}
?>
    
