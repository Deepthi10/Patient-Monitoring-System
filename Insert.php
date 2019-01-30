<?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //This is for the doctors insert
                    if (isset($_POST['DoctorInsert'])) {
                    require_once('InsertInto.php');
                    $sql = new InsertInto;
                    $first = $_POST['DFirstName'];
                    $last = $_POST['DLastName'];
                    $spec = $_POST['DSpecialty'];
                    $rate = $_POST['DRating'];
                    $sql->Execute("DoctorInsert",array($first,$last,$spec,$rate));
                    echo "<script> alert('Doctor Inserted');window.location='UploadPage.php'</script>";
                    exit;
                    }
                    
                    //This is for the doctors insert
                    if (isset($_POST['VisitInsert'])) {
                    require_once('InsertInto.php');
                    $sql = new InsertInto;
                    $patientID = $_POST['VPID'];
                    $doctorID = $_POST['VDID'];
                    $DateOfVisit = $_POST['VDOV'];
                    $DateOfCheckIn = $_POST['VDeskCheckIn'];
                    $DateNurseMet = $_POST['VNurseMet'];
                    $DateDoctorMet = $_POST['VDoctorMet'];
                    $DelayReason = $_POST['VDelayReason'];
                    $sql->Execute("VisitInsert",array($patientID,$doctorID,$DateOfVisit,$DateOfCheckIn,$DateNurseMet,$DateDoctorMet,$DelayReason));
                    echo "<script> alert('Visit Inserted');window.location='UploadPage.php'</script>";
                    exit;
                    }
                    
                    //This is for the doctors insert
                    if (isset($_POST['PatientInsert'])) {
                    require_once('InsertInto.php');
                    $sql = new InsertInto;
                    $first = $_POST['PFirstName'];
                    $last = $_POST['PLastName'];
                    $DOB = $_POST['PDOB'];
                    $gender = $_POST['PGender'];
                    $sql->Execute("PatientInsert",array($first,$last,$DOB,$gender));
                    echo "<script> alert('Patient Inserted');window.location='UploadPage.php'</script>";
                    exit;
                    }
	}
?>
