<?php
	require_once('../models/dbConnection.php');
	require_once('../models/mail.php');

	function adminLoginCheck($id, $pass){
		$conn = getConnection();
		$sql = "select * from admin where ID = '$id' and Password = '$pass'";
		$res = mysqli_query($conn, $sql);
		return $res;
	}

	function clientLoginCheck($id, $pass){
		$conn = getConnection();
		$sql = "select * from client where ID = '$id' and Password = '$pass'";
		$res = mysqli_query($conn, $sql);
		return $res;
	}

	function lawyerLoginCheck($id, $pass){
		$conn = getConnection();
		$sql = "select * from lawyer where ID = '$id' and Password = '$pass'";
		$res = mysqli_query($conn, $sql);
		return $res;
	}

	function checkClientID($id){
		$conn = getConnection();
		$sql = "select * from client where ID = '$id'";
		$res = mysqli_query($conn, $sql);
		$numRows = mysqli_num_rows($res);
		return $numRows;
	}

	function makeClientID($num){
		return "C-".$num;
	}

	function generateClientID(){
		$conn = getConnection();

		$i = 1;
		while(checkClientID(makeClientID($i)) != 0){
			$i = $i + 1;
		}
		return "C-".$i;
	}

	// function generateClientID(){
	// 	$conn = getConnection();
	// 	$sql = "select * from client order by cast(substring(ID, 3) as unsigned) desc limit 1";
	// 	$res = mysqli_query($conn, $sql);
	// 	$prevID = "";
	// 	$newIDNum = 0;
	// 	while($result = $res->fetch_assoc())
	// 		$prevID = $result['ID'];

	// 	if(is_null($prevID)){
	// 		$newIDNum = 1;
	// 	}
	// 	else{
	// 		$idParts = explode('-', $prevID);
	// 		$idNum = (int)$idParts[1];
	// 		$newIDNum = $idNum + 1;
	// 	}

	// 	$newID = "C-" . (string)$newIDNum;
	// 	return $newID;
	// }
	function checkLawyerID($id){
		$conn = getConnection();
		$sql = "select * from lawyer where ID = '$id'";
		$res = mysqli_query($conn, $sql);
		$numRows = mysqli_num_rows($res);
		return $numRows;
	}

	function makeLawyerID($num){
		return "L-".$num;
	}

	function generateLawyerID(){
		$conn = getConnection();

		$i = 1;
		while(checkLawyerID(makeLawyerID($i)) != 0){
			$i = $i + 1;
		}
		return "L-".$i;
	}

	// function generateLawyerID(){
	// 	$conn = getConnection();
	// 	$sql = "select * from lawyer order by cast(substring(ID, 3) as unsigned) desc limit 1";
	// 	$res = mysqli_query($conn, $sql);
	// 	$prevID = "";
	// 	$newIDNum = 0;
	// 	while($result = $res->fetch_assoc())
	// 		$prevID = $result['ID'];

	// 	if(is_null($prevID)){
	// 		$newIDNum = 1;
	// 	}
	// 	else{
	// 		$idParts = explode('-', $prevID);
	// 		$idNum = (int)$idParts[1];
	// 		$newIDNum = $idNum + 1;
	// 	}

	// 	$newID = "L-" . (string)$newIDNum;
	// 	return $newID;
	// }

	function clientReg($name, $id, $email, $cno, $pass){
		$conn = getConnection();
		$sql = "insert into client values ('$name', '$id', '$email', '$cno', '$pass')";
		$res = mysqli_query($conn, $sql);
		return $res;
	}

	function clientRegEmailCheck($email){
		$conn = getConnection();
		$sql = "select * from client where Email = '$email'";
		$res = mysqli_query($conn, $sql);
		$numRows = mysqli_num_rows($res);
		return $numRows;
	}

	function lawyerRegEmailCheck($email, $bcNo){
		$conn = getConnection();
		$sql = "select * from lawyer where Email = '$email' or BCN = '$bcNo'";
		$res = mysqli_query($conn, $sql);
		$numRows = mysqli_num_rows($res);
		return $numRows;
	}

	function lawyerRequestEmailCheck($email, $bcNo){
		$conn = getConnection();
		$sql = "select * from request where Email = '$email' or BCN = '$bcNo'";
		$res = mysqli_query($conn, $sql);
		$numRows = mysqli_num_rows($res);
		return $numRows;
	}

	function lawyerReg($name, $email, $bcNo, $cNo, $pass, $cfph){
		$conn = getConnection();
		$sql = "insert into request values('$name', '$bcNo', '$email', '$pass', '$cNo', '$cfph')";
		$res = mysqli_query($conn, $sql);
		return $res;
	}

	function loadClientTable(){
		$conn = getConnection();
		$sql = "select * from client";
		$res = mysqli_query($conn, $sql);
		return $res;
	}

	function loadLawyerTable(){
		$conn = getConnection();
		$sql = "select * from lawyer";
		$res = mysqli_query($conn, $sql);
		return $res;
	}

	function loadRequestTable(){
		$conn = getConnection();
		$sql = "select * from request";
		$res = mysqli_query($conn, $sql);
		return $res; 
	}

	function removeLawyer($id){
		$conn = getConnection();
		$sql = "delete from lawyer where ID = '$id'";
		$res = mysqli_query($conn, $sql);
		return $res;
	}

	function removeClient($id){
		$conn = getConnection();
		$sql = "delete from client where ID = '$id'";
		$res = mysqli_query($conn, $sql);
		return $res;
	}

	function searchClient($text) {
    // Get database connection
    $conn = getConnection();
    
    // Prepare the query with placeholders
    $sql = "SELECT * FROM client
            WHERE LOWER(Name) LIKE LOWER(CONCAT('%', ?, '%'))
               OR LOWER(ID) LIKE LOWER(CONCAT('%', ?, '%'))
               OR LOWER(Email) LIKE LOWER(CONCAT('%', ?, '%'))
               OR LOWER(Contact) LIKE LOWER(CONCAT('%', ?, '%'))";
    
    // Prepare the statement
    $stmt = $conn->prepare($sql);
    
    // Check if the statement was prepared successfully
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    
    // Bind parameters (the same $text variable for all placeholders)
    $stmt->bind_param('ssss', $text, $text, $text, $text);
    
    // Execute the statement
    $stmt->execute();
    
    // Get the result
    $result = $stmt->get_result();
    
    // Return the result
    return $result;
	}

	function searchLawyer($text) {
    // Get database connection
    $conn = getConnection();
    
    // Prepare the query with placeholders
    $sql = "SELECT * FROM lawyer
            WHERE LOWER(Name) LIKE LOWER(CONCAT('%', ?, '%'))
               OR LOWER(ID) LIKE LOWER(CONCAT('%', ?, '%'))
               OR LOWER(Email) LIKE LOWER(CONCAT('%', ?, '%'))
               OR LOWER(Contact) LIKE LOWER(CONCAT('%', ?, '%'))";
    
    // Prepare the statement
    $stmt = $conn->prepare($sql);
    
    // Check if the statement was prepared successfully
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    
    // Bind parameters (the same $text variable for all placeholders)
    $stmt->bind_param('ssss', $text, $text, $text, $text);
    
    // Execute the statement
    $stmt->execute();
    
    // Get the result
    $result = $stmt->get_result();
    
    // Return the result
    return $result;
	}

	function searchLawyerRequest($text) {
    // Get database connection
    $conn = getConnection();
    
    // Prepare the query with placeholders
    $sql = "SELECT * FROM request
            WHERE LOWER(Name) LIKE LOWER(CONCAT('%', ?, '%'))
               OR LOWER(BCN) LIKE LOWER(CONCAT('%', ?, '%'))
               OR LOWER(Email) LIKE LOWER(CONCAT('%', ?, '%'))
               OR LOWER(ContactNumber) LIKE LOWER(CONCAT('%', ?, '%'))";
    
    // Prepare the statement
    $stmt = $conn->prepare($sql);
    
    // Check if the statement was prepared successfully
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    
    // Bind parameters (the same $text variable for all placeholders)
    $stmt->bind_param('ssss', $text, $text, $text, $text);
    
    // Execute the statement
    $stmt->execute();
    
    // Get the result
    $result = $stmt->get_result();
    
    // Return the result
    return $result;
	}

	// function searchClient($text){
	// 	$conn = getConnection();
	// 	$sql = "select * from client 
	// 			WHERE LOWER(Name) LIKE LOWER('%', '$text', '%')
   	// 			OR LOWER(ID) LIKE LOWER('%', '$text', '%')
   	// 			OR LOWER(Email) LIKE LOWER('%', '$text', '%')
   	// 			OR LOWER(ContactNumber) LIKE LOWER('%', '$text', '%')";
	// 	$res = mysqli_query($conn, $sql);
	// 	return $res;
	// }
	function loadClientDetails($id){
		$conn = getConnection();
		$sql = "select * from client where ID = '$id'";
		$res = mysqli_query($conn, $sql);
		return $res;
	}

	function loadLawyerDetails($id){
		$conn = getConnection();
		$sql = "select * from lawyer where ID = '$id'";
		$res = mysqli_query($conn, $sql);
		return $res;
	}

	function updateClientDetails($id, $name, $email, $contact, $pass){
		$conn = getConnection();
		$sql = "update client set Name = '$name', Email = '$email', Contact = '$contact', Password = '$pass' where ID = '$id'";
		$res = mysqli_query($conn, $sql);
		return $res;
	}

	function updateLawyerDetails($id, $name, $email, $contact, $cfph, $pass){
		$conn = getConnection();
		$sql = "update lawyer set Name = '$name', Email = '$email', Contact = '$contact', CFPH = '$cfph', Password = '$pass' where ID = '$id'";
		$res = mysqli_query($conn, $sql);
		return $res;
	}

	function makeConfirmationMailBody($name, $id){
    return "Dear $name,<br><br>
    We are thrilled to confirm your successful registration on our platform, <b>E-LawyerBD</b>, where we connect skilled legal professionals like you with clients in need of expert guidance.<br><br>
    Congratulations on becoming part of our growing legal network!<br><br>
    To help you get started, here is your unique User ID: <b>$id</b>. Please keep this information secure, as it will be needed for all your login and profile-related activities.<br><br>
    As a member of our platform, you can now:<br>
    <ul>
    <li>Access potential clients seeking legal services in various fields.</li>
    <li>Showcase your expertise through your profile.</li>
    <li>Manage appointments, consultations, and much more through our user-friendly dashboard.</li>
    </ul><br>
    Should you have any questions or need assistance with your account, feel free to reach out to our support team at <b>01632109954</b>.<br><br>
    We look forward to seeing you thrive on E-LawyerBD and helping clients with your expert legal services.<br><br>
    Welcome aboard!<br><br>
    Best regards,<br>
    <b>Mohiuddin Mohi</b><br>
    <b>Head of Administration & Founder</b><br>
    <b>E-LawyerBD</b><br>
    <b>mohiuddin@elawyerbd.com</b>";
}

	function makeRejectionMailBody($name){
    return "Dear $name,<br><br>
Thank you for your recent application to join our platform, <b>E-LawyerBD</b>. After careful consideration, we regret to inform you that we are unable to proceed with your application at this time.<br><br>
We receive a large number of applications from talented professionals, and while we value your expertise, we have determined that your profile does not align with our current requirements.<br><br>
Please know that this decision is not a reflection of your qualifications or experience. We encourage you to apply again in the future, as our needs may evolve and we regularly review new applications.<br><br>
We appreciate your interest in joining <b>E-LawyerBD</b>, and we wish you all the best in your professional endeavors.<br><br>
Kind regards,<br>
<b>Mohiuddin Mohi</b><br>
<b>Head of Administration & Founder</b><br>
<b>E-LawyerBD</b><br>
<b>mohiuddin@elawyerbd.com</b>";
}
	function makeDeclineMailBody($lawyerName, $clientName){
		return "Dear $clientName,<br><br>
            Thank you for choosing E-LawyerBD for your legal needs. We regret to inform you that your recent request to hire <b>$lawyerName</b> has been declined.<br><br>
            This decision may be due to the lawyer’s current workload, unavailability, or other professional reasons. We understand that this may not be the outcome you were hoping for, and we sincerely apologize for any inconvenience caused.<br><br>
            If you would like, we can connect you with other qualified lawyers who can assist with your case. Please let us know if you'd like us to proceed with this option, or feel free to browse our website to explore more legal professionals available for hire.<br><br>
            Thank you for understanding, and please feel free to reach out if you have any questions.<br><br>
            Warm regards,<br>
            <b>Mohiuddin Mohi</b><br>
			<b>Head of Administration & Founder</b><br>
			<b>E-LawyerBD</b><br>
			<b>mohiuddin@elawyerbd.com</b>";
	}

	function makeApprovalMailBody($lawyerName, $clientName){
		return "Dear $clientName,<br><br>
        We are pleased to inform you that your request for a consultancy session with <b>$lawyerName</b> has been accepted.<br><br>
        Please log in to your client portal and navigate to the <b>History</b> section to view the lawyer’s contact details, including their email address and phone number. You can use these details to get in touch and schedule your consultancy session at your convenience.<br><br>
        If you need any assistance or have questions, feel free to reply to this email or contact our support team.<br><br>
        Thank you for choosing E-LawyerBD. We wish you a productive and successful consultation!<br><br>
        Warm regards,<br>
        <b>Mohiuddin Mohi</b><br>
		<b>Head of Administration & Founder</b><br>
		<b>E-LawyerBD</b><br>
		<b>mohiuddin@elawyerbd.com</b>";
	}


	function selectRequest($bcn){
		$conn = getConnection();
		$sql = "select * from request where BCN = '$bcn'";
		$res = mysqli_query($conn, $sql);
		return $res;
	}

	function rejectRequest($bcn){
		$conn = getConnection();
		$sql = "delete from request where BCN = '$bcn'";
		$res = mysqli_query($conn, $sql);
		return $res;
	}

	function removeFromRequest($bcn){
		$conn = getConnection();
		$sql = "delete from request where BCN = '$bcn'";
		mysqli_query($conn, $sql);
	}

	function confirmRequest($id, $name, $bcn, $email, $pass, $contact, $cfph, $rating){
		$conn = getConnection();
		$sql = "insert into lawyer values('$name', '$id', '$bcn', '$email', '$pass', '$contact', '$cfph', $rating)";
		$res = mysqli_query($conn, $sql);
		if($res) removeFromRequest($bcn);
		return $res;
	}

	function clientSearchLawyer(){
		$conn = getConnection();
		$sql = "select * from lawyer";
		$res = mysqli_query($conn, $sql);
		return $res;
	}

	function sendRequest($clientID, $lawyerID){
		$conn = getConnection();
		$sql = "insert into consultancy_request values ('$clientID', '$lawyerID')";
		$res = mysqli_query($conn, $sql);
		return $res;
	}

	function pendingRequestCheck($clientID, $lawyerID){
		$conn = getConnection();
		$sql = "select * from consultancy_request where Client_ID = '$clientID' and Lawyer_ID = '$lawyerID'";
		$res = mysqli_query($conn, $sql);
		$numRow = mysqli_num_rows($res);
		return $numRow;
	}

	function loadPendingTable($id){
		$conn = getConnection();
		$sql = "select * from consultancy_request where Client_ID = '$id'";
		$res = mysqli_query($conn, $sql);
		return $res;
	}

	function loadPendingLawyer($id){
		$conn = getConnection();
		$sql = "select * from lawyer where ID = '$id'";
		$res = mysqli_query($conn, $sql);
		return $res;
	}

	function loadHistory($id){
		$conn = getConnection();
		$sql = "select * from consultancy where Client_ID = '$id'";
		$res = mysqli_query($conn, $sql);
		return $res;
	}

	function loadConsultancyHistory($id){
		$conn = getConnection();
		$sql = "select * from consultancy where Lawyer_ID = '$id'";
		$res = mysqli_query($conn, $sql);
		return $res;
	}

	function checkRating($id){
		$conn = getConnection();
		$sql = "select * from consultancy where Consultancy_ID = '$id'";
		$res = mysqli_query($conn, $sql);
		return $res;
	}

	function checkConsultancyID($id){
		$conn = getConnection();
		$sql = "select * from consultancy where Consultancy_ID = '$id'";
		$res = mysqli_query($conn, $sql);
		$numRows = mysqli_num_rows($res);
		return $numRows;
	}

	function makeConsultancyID($num){
		return "CSL-".$num;
	}

	function generateConsultancyID(){
		$conn = getConnection();

		$i = 1;
		while(checkConsultancyID(makeConsultancyID($i)) != 0){
			$i = $i + 1;
		}
		return "CSL-".$i;
	}

	function rate($id, $rating){
		$conn = getConnection();
		$sql = "update consultancy set Rating = $rating where Consultancy_ID = '$id'";
		$res = mysqli_query($conn, $sql);
		return $res;
	}

	function loadLawyerConsultancy($id){
		$conn = getConnection();
		$sql = "select * from consultancy where Lawyer_ID = '$id'";
		$res = mysqli_query($conn, $sql);
		return $res;
	}

	function loadConsultancyList(){
		$conn = getConnection();
		$sql = "select * from consultancy";
		$res = mysqli_query($conn, $sql);
		return $res;
	}

	function deleteConsultancy($id){
		$conn = getConnection();
		$sql = "delete from consultancy where Consultancy_ID = '$id'";
		$res = mysqli_query($conn, $sql);
		return $res;
	}

	function loadConsultancyRequests($id){
		$conn = getConnection();
		$sql = "select * from consultancy_request where Lawyer_ID = '$id'";
		$res = mysqli_query($conn, $sql);
		return $res;
	}

	function rejectConsultancy($lawyerID, $clientID){
		$conn = getConnection();
		$sql = "delete from consultancy_request where Lawyer_ID = '$lawyerID' and Client_ID = '$clientID'";
		$res = mysqli_query($conn, $sql);
		return $res;
	}

	function removeConsultancy($lID, $cID){
		$conn = getConnection();
		$sql = "delete from consultancy_request where Lawyer_ID = '$lID' and Client_ID = '$cID'";
		$res = mysqli_query($conn, $sql);
	}

	function acceptConsultancy($conID, $cName, $cID, $lName, $lID, $date, $cfph, $rating){
		$conn = getConnection();
		$sql = "insert into consultancy values ('$conID', '$cName', '$cID', '$lName', '$lID', '$date', '$cfph', $rating)";
		$res = mysqli_query($conn, $sql);
		return $res;
	}

	function collectRating($id){
		$conn = getConnection();
		$sql = "select * from consultancy where Lawyer_ID = '$id'";
		$res = mysqli_query($conn, $sql);
		return $res;
	}

	function generateRating($res){
		$rating = 0;
		$count = 0;
		while($r = $res->fetch_assoc()){
			$rating = $rating + (float)$r['Rating'];
			$count = $count + 1;
		}
		return (float)($rating/$count);
	}

	function pushRating($id, $rating){
		$conn = getConnection();
		$sql = "update lawyer set Rating = $rating where ID = '$id'";
		mysqli_query($conn, $sql);
	}
?>