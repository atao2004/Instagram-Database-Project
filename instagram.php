<!--refer to oracle-template.php from https://github.students.cs.ubc.ca/CPSC304/CPSC304_PHP_Project
-->

<?php
// The preceding tag tells the web server to parse the following text as PHP
// rather than HTML (the default)

// The following 3 lines allow PHP errors to be displayed along with the page
// content. Delete or comment out this block when it's no longer needed.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Set some parameters

// Database access configuration
$config["dbuser"] = "ora_edmondye";			// change "cwl" to your own CWL
$config["dbpassword"] = "a32019416";	// change to 'a' + your student number
$config["dbserver"] = "dbhost.students.cs.ubc.ca:1522/stu";
$db_conn = NULL;	// login credentials are used in connectToDB()
 

$success = true;	// keep track of errors so page redirects only if there are no errors

$show_debug_alert_messages = False; // show which methods are being triggered (see debugAlertMessage())

// The next tag tells the web server to stop parsing the text as PHP. Use the
// pair of tags wherever the content switches to PHP
?>

<html>

<head>
	<title>CPSC 304 Instagram Project</title>
</head>

<body>
	<div style= "height:100px; background-color: 7B68EE;">
	<h1 style = "color: White; font-size: 4rem"> Instagram DataBase Project </h1>
	</div>


	<h2 style = "color: RebeccaPurple">Reset</h2>
	<p>If you wish to reset the tables press on the reset button. If this is the first time you're running this page, please use reset</p>

	<form method="POST" action="instagram.php">
		<!-- "action" specifies the file or page that will receive the form data for processing. As with this example, it can be this same file. -->
		<input type="hidden" id="resetTablesRequest" name="resetTablesRequest">
		<p >
		<input type="submit" value="Reset" name="reset" style="
            background-color: PaleVioletRed; 
            border: none; 
            color: white; 
            padding: 6px 8px; 
            text-align: center; 
            display: inline-block; 
            font-size: 16px; 
            margin: 1px 0.5px; 
            cursor: pointer; 
            border-radius: 10px; 
            transition-duration: 0.4 s; 
        " onmouseover="this.style.backgroundColor='#C71585'" /* on hover */
        onmouseout="this.style.backgroundColor='#DB7093'" /* when not hovered */
        >
		</p>
	</form>

	<hr />

	<h2 style = "color: RebeccaPurple">Create Users</h2>
	<p>If this is your first time using the database, please identify yourself by creating a user</p>
	<form method="POST" action="instagram.php">
		<input type="hidden" id="CreateUserRequest" name="CreateUserRequest">
		User ID (INT): <input type="text" name="userID">
		Gender: <select name="gender">
                <option value="M">Male</option>
                <option value="F">Female</option>
                <option value="O">Other</option>
            </select>
		Generation: <select name="generation">
                <option value="Boomer">Boomer</option>
                <option value="X">X</option>
                <option value="Z">Z</option>
				<option value="Millenial">Millenial</option>
				<option value="Alpha">Alpha</option>
            </select>
		Name: <input type="text" name = "fullName">
		Age: <input type="text" name = "age"> <br /><br />
		Birthdate: <input type="date" name="birthdate">


		<input type="submit" value="Create" name="createSubmit" 
		style="
            background-color: PaleVioletRed; 
            border: none; 
            color: white; 
            padding: 6px 8px; 
            text-align: center; 
            display: inline-block; 
            font-size: 16px; 
            margin: 1px 0.5px; 
            cursor: pointer; 
            border-radius: 10px; 
            transition-duration: 0.4 s; 
        " onmouseover="this.style.backgroundColor='#C71585'" /* on hover */
        onmouseout="this.style.backgroundColor='#DB7093'" /* when not hovered */></p>
	</form>

	<hr />

	<h2 style = "color: RebeccaPurple">Delete Users</h2>
	<p>Enter UserID to delete.</p>

	<form method="POST" action="instagram.php">
		<input type="hidden" id="deleteQueryRequest" name="deleteQueryRequest">
		UserID: <input type="text" name="UserID"> <br /><br />

		<input type="submit" value="Delete" name="deleteSubmit"
		style="
            background-color: PaleVioletRed; 
            border: none; 
            color: white; 
            padding: 6px 8px; 
            text-align: center; 
            display: inline-block; 
            font-size: 16px; 
            margin: 1px 0.5px; 
            cursor: pointer; 
            border-radius: 10px; 
            transition-duration: 0.4 s; 
        " onmouseover="this.style.backgroundColor='#C71585'" /* on hover */
        onmouseout="this.style.backgroundColor='#DB7093'" /* when not hovered */
		></p>
	</form>
	<hr />

	<h2 style = "color: RebeccaPurple">Insert Post</h2>
	<p>Create a Post for a user by specifying the values below</p>
	<form method="POST" action="instagram.php">
		<input type="hidden" id="CreatePostRequest" name="CreatePostRequest">
		Post ID (INT): <input type="text" name="PostID">
		Location: <input type="text" name = "location">
		Postdate: <input type="date" name="postDate">
		User ID (INT): <input type="text" name="userID">

		<input type="submit" value="Create" name="createPostSubmit"
		style="
            background-color: PaleVioletRed; 
            border: none; 
            color: white; 
            padding: 6px 8px; 
            text-align: center; 
            display: inline-block; 
            font-size: 16px; 
            margin: 1px 0.5px; 
            cursor: pointer; 
            border-radius: 10px; 
            transition-duration: 0.4 s; 
        " onmouseover="this.style.backgroundColor='#C71585'" /* on hover */
        onmouseout="this.style.backgroundColor='#DB7093'" /* when not hovered */
		></p>
	</form>

	<hr />


	<h2 style = "color: RebeccaPurple">Update Name in Users </h2>
	<p>The values are case sensitive and if you enter in the wrong case, the update statement will not do anything.</p>

	<form method="POST" action="instagram.php">
		<input type="hidden" id="updateQueryRequest" name="updateQueryRequest">
		Old Name: <input type="text" name="oldName"> <br /><br />
		New Name: <input type="text" name="newName"> <br /><br />

		<input type="submit" value="Update" name="updateSubmit"
		style="
            background-color: PaleVioletRed; 
            border: none; 
            color: white; 
            padding: 6px 8px; 
            text-align: center; 
            display: inline-block; 
            font-size: 16px; 
            margin: 1px 0.5px; 
            cursor: pointer; 
            border-radius: 10px; 
            transition-duration: 0.4 s; 
        " onmouseover="this.style.backgroundColor='#C71585'" /* on hover */
        onmouseout="this.style.backgroundColor='#DB7093'" /* when not hovered */
		></p>
	</form>
	<hr />

	<h2 style = "color: RebeccaPurple">Update Location in Posts </h2>
	<p>The values are case sensitive and if you enter in the wrong case, the update statement will not do anything.</p>

	<form method="POST" action="instagram.php">
		<input type="hidden" id="updatePostQueryRequest" name="updatePostQueryRequest">
		PostID: <input type="text" name="postID"> <br /><br />
		New Location: <input type="text" name="newLocation"> <br /><br />

		<input type="submit" value="UpdatePost" name="updatePostSubmit"
		style="
            background-color: PaleVioletRed; 
            border: none; 
            color: white; 
            padding: 6px 8px; 
            text-align: center; 
            display: inline-block; 
            font-size: 16px; 
            margin: 1px 0.5px; 
            cursor: pointer; 
            border-radius: 10px; 
            transition-duration: 0.4 s; 
        " onmouseover="this.style.backgroundColor='#C71585'" /* on hover */
        onmouseout="this.style.backgroundColor='#DB7093'" /* when not hovered */
		></p>
	</form>

	<hr />

	<h2 style = "color: RebeccaPurple">Selection in User</h2>
	<p>Please specify the conditions you want to use</p>
	<p>For example, age > ..., fullName = 'name you want to search', userID = '', generation = '...', birthdate = '...'</p>

	<form method="POST" action="instagram.php">
    <input type="hidden" id="selectionQueryRequest" name="selectionQueryRequest">
    
    Condition: <input type="text" name="condition"> <br /><br />
    
    <input type="submit" value="Select" name="selectSubmit"
	style="
            background-color: PaleVioletRed; 
            border: none; 
            color: white; 
            padding: 6px 8px; 
            text-align: center; 
            display: inline-block; 
            font-size: 16px; 
            margin: 1px 0.5px; 
            cursor: pointer; 
            border-radius: 10px; 
            transition-duration: 0.4 s; 
        " onmouseover="this.style.backgroundColor='#C71585'" /* on hover */
        onmouseout="this.style.backgroundColor='#DB7093'" /* when not hovered */
	>
</form>

<hr />

	<h2 style = "color: RebeccaPurple">Projection in User</h2>
	<p>Please select the attributes you want to display</p>

	<form method="POST" action="instagram.php">
    <input type="hidden" id="projectionQueryRequest" name="projectionQueryRequest">
    
    User Id: <input type="checkbox" name="userid" value="yes"><br>
    Gender: <input type="checkbox" name="gender" value="yes"><br>
	Generation: <input type="checkbox" name="generation" value="yes"><br>
    Name: <input type="checkbox" name="fullname" value="yes"><br>
    Age: <input type="checkbox" name="age" value="yes"><br>
    Birthdate: <input type="checkbox" name="birthdate" value="yes"><br>

    <input type="submit" value="Project" name="projectSubmit"
	style="
            background-color: PaleVioletRed; 
            border: none; 
            color: white; 
            padding: 6px 8px; 
            text-align: center; 
            display: inline-block; 
            font-size: 16px; 
            margin: 1px 0.5px; 
            cursor: pointer; 
            border-radius: 10px; 
            transition-duration: 0.4 s; 
        " onmouseover="this.style.backgroundColor='#C71585'" /* on hover */
        onmouseout="this.style.backgroundColor='#DB7093'" /* when not hovered */>
</form>

<hr />



<h2 style = "color: RebeccaPurple">Find the Fullname of the user that make posts in certain location (Join)</h2>
	<form method="Post" action="instagram.php">
		<input type="hidden" id="joinUserRequest" name="joinUserRequest">
		<label for="location">Location:</label>
    	<input type="text" id="location" name="location"><br>
		<input type="submit" name="joinUser" style="
            background-color: PaleVioletRed; 
            border: none; 
            color: white; 
            padding: 6px 8px; 
            text-align: center; 
            display: inline-block; 
            font-size: 16px; 
            margin: 1px 0.5px; 
            cursor: pointer; 
            border-radius: 10px; 
            transition-duration: 0.4 s; 
        " onmouseover="this.style.backgroundColor='#C71585'" /* on hover */
        onmouseout="this.style.backgroundColor='#DB7093'" /* when not hovered */></p>
	</form>

	<hr />


<h2 style = "color: RebeccaPurple">Count the Number of Users in Each Generation (Aggregation + Group by)</h2>
	<form method="GET" action="instagram.php">
		<input type="hidden" id="countUserRequest" name="countUserRequest">
		<input type="submit" name="countUser" style="
            background-color: PaleVioletRed; 
            border: none; 
            color: white; 
            padding: 6px 8px; 
            text-align: center; 
            display: inline-block; 
            font-size: 16px; 
            margin: 1px 0.5px; 
            cursor: pointer; 
            border-radius: 10px; 
            transition-duration: 0.4 s; 
        " onmouseover="this.style.backgroundColor='#C71585'" /* on hover */
        onmouseout="this.style.backgroundColor='#DB7093'" /* when not hovered */></p>
	</form>

	<hr />

<h2 style = "color: RebeccaPurple">Display Users That Have Posted At Least Twice At Any Location  (Aggregation + Having)</h2>
	<form method="GET" action="instagram.php">
		<input type="hidden" id="aggregationHaving" name="aggregationHaving">
		<input type="submit" name="countUserWithAtLeast2" style="
            background-color: PaleVioletRed; 
            border: none; 
            color: white; 
            padding: 6px 8px; 
            text-align: center; 
            display: inline-block; 
            font-size: 16px; 
            margin: 1px 0.5px; 
            cursor: pointer; 
            border-radius: 10px; 
            transition-duration: 0.4 s; 
        " onmouseover="this.style.backgroundColor='#C71585'" /* on hover */
        onmouseout="this.style.backgroundColor='#DB7093'" /* when not hovered */></p>
	</form>

	<hr />

<h2 style = "color: RebeccaPurple">Find the Youngest Person in Each Generation</h2>
	<form method="GET" action="instagram.php">
		<input type="hidden" id="nestedAggregationHaving" name="nestedAggregationHaving">
		<input type="submit" name="countYoungestUserWithAtLeast2" style="
            background-color: PaleVioletRed; 
            border: none; 
            color: white; 
            padding: 6px 8px; 
            text-align: center; 
            display: inline-block; 
            font-size: 16px; 
            margin: 1px 0.5px; 
            cursor: pointer; 
            border-radius: 10px; 
            transition-duration: 0.4 s; 
        " onmouseover="this.style.backgroundColor='#C71585'" /* on hover */
        onmouseout="this.style.backgroundColor='#DB7093'" /* when not hovered */></p>
	</form>

	<hr />

<h2 style = "color: RebeccaPurple"> Find the userID that make all the post in Toronto</h2>
	<form method="GET" action="instagram.php">
		<input type="hidden" id="division" name="division">
		<input type="submit" name="divisionsubmit" style="
            background-color: PaleVioletRed; 
            border: none; 
            color: white; 
            padding: 6px 8px; 
            text-align: center; 
            display: inline-block; 
            font-size: 16px; 
            margin: 1px 0.5px; 
            cursor: pointer; 
            border-radius: 10px; 
            transition-duration: 0.4 s; 
        " onmouseover="this.style.backgroundColor='#C71585'" /* on hover */
        onmouseout="this.style.backgroundColor='#DB7093'" /* when not hovered */></p>
	</form>

	<hr />


<h2 style = "color: RebeccaPurple">Count the Tuples in Users</h2>
	<form method="GET" action="instagram.php">
		<input type="hidden" id="countTupleRequest" name="countTupleRequest">
		<input type="submit" name="countTuples" style="
            background-color: PaleVioletRed; 
            border: none; 
            color: white; 
            padding: 6px 8px; 
            text-align: center; 
            display: inline-block; 
            font-size: 16px; 
            margin: 1px 0.5px; 
            cursor: pointer; 
            border-radius: 10px; 
            transition-duration: 0.4 s; 
        " onmouseover="this.style.backgroundColor='#C71585'" /* on hover */
        onmouseout="this.style.backgroundColor='#DB7093'" /* when not hovered */></p>
	</form>

	<hr />

	<div style="display: flex; justify-content: space-around; align-items: center; margin-bottom: 20px;">
    <div>
        <h2 style="color: RebeccaPurple">Display Users</h2>
        <form method="GET" action="instagram.php">
            <input type="hidden" id="displayUsersRequest" name="displayUsersRequest">
            <input type="submit" name="displayUsers" value="Display Users" style="
                background-color: PaleVioletRed; 
                border: none; 
                color: white; 
                padding: 6px 8px; 
                text-align: center; 
                display: inline-block; 
                font-size: 16px; 
                margin: 1px 0.5px; 
                cursor: pointer; 
                border-radius: 10px; 
                transition-duration: 0.4s;
            " onmouseover="this.style.backgroundColor='#C71585'" /* on hover */
            onmouseout="this.style.backgroundColor='#DB7093'" /* when not hovered */>
        </form>
    </div>

    <div>
        <h2 style="color: RebeccaPurple">Display Posts</h2>
        <form method="GET" action="instagram.php">
            <input type="hidden" id="displayPostsRequest" name="displayPostsRequest">
            <input type="submit" name="displayMadePosts" value="Display Posts" style="
                background-color: PaleVioletRed; 
                border: none; 
                color: white; 
                padding: 6px 8px; 
                text-align: center; 
                display: inline-block; 
                font-size: 16px; 
                margin: 1px 0.5px; 
                cursor: pointer; 
                border-radius: 10px; 
                transition-duration: 0.4s;
            " onmouseover="this.style.backgroundColor='#C71585'" /* on hover */
            onmouseout="this.style.backgroundColor='#DB7093'" /* when not hovered */>
        </form>
    </div>
</div>

<hr />





	<?php
	// The following code will be parsed as PHP

	function debugAlertMessage($message)
	{
		global $show_debug_alert_messages;

		if ($show_debug_alert_messages) {
			echo "<script type='text/javascript'>alert('" . $message . "');</script>";
		}
	}

	function executePlainSQL($cmdstr)
	{ //takes a plain (no bound variables) SQL command and executes it
		//echo "<br>running ".$cmdstr."<br>";
		global $db_conn, $success;

		$statement = oci_parse($db_conn, $cmdstr);
		//There are a set of comments at the end of the file that describe some of the OCI specific functions and how they work

		if (!$statement) {
			echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
			$e = OCI_Error($db_conn); // For oci_parse errors pass the connection handle
			echo htmlentities($e['message']);
			$success = False;
		}

		$r = oci_execute($statement, OCI_DEFAULT);
		if (!$r) {
			echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
			$e = oci_error($statement); // For oci_execute errors pass the statementhandle
			echo htmlentities($e['message']);
			$success = False;
		}

		return $statement;
	}

	function executeBoundSQL($cmdstr, $list)
	{
		/* Sometimes the same statement will be executed several times with different values for the variables involved in the query.
		In this case you don't need to create the statement several times. Bound variables cause a statement to only be
		parsed once and you can reuse the statement. This is also very useful in protecting against SQL injection.
		See the sample code below for how this function is used */

		global $db_conn, $success;
		$statement = oci_parse($db_conn, $cmdstr);

		if (!$statement) {
			echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
			$e = OCI_Error($db_conn);
			echo htmlentities($e['message']);
			$success = False;
		}

		foreach ($list as $tuple) {
			foreach ($tuple as $bind => $val) {
				//echo $val;
				//echo "<br>".$bind."<br>";
				oci_bind_by_name($statement, $bind, $val);
				unset($val); //make sure you do not remove this. Otherwise $val will remain in an array object wrapper which will not be recognized by Oracle as a proper datatype
			}

			$r = oci_execute($statement, OCI_DEFAULT);
			if (!$r) {
				echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
				$e = OCI_Error($statement); // For oci_execute errors, pass the statementhandle
				echo htmlentities($e['message']);
				echo "<br>";
				$success = False;
			}
		}
	}

	function printResult($result)
	{ 
		echo "<br>Retrieved data from table Users:<br>";
		//  table inline styles
		echo "<table border='1' cellpadding='10' style='border-collapse: collapse; width: 100%;'>";
		//  header row 
		echo "<tr style='background-color: #D8BFD8;'>";
		echo "<th>UserID</th><th>Gender</th><th>Generation</th><th>FullName</th><th>Age</th><th>Birthdate</th>";
		echo "</tr>";

		$i = 0;

	
	
		// Fetch each record in the result set
		while ($row = OCI_Fetch_Array($result, OCI_ASSOC)) {
			echo "<tr style='background-color: " . ($i++ % 2 === 0 ? "#DDA0DD" : "#E6E6FA") . ";'>";
			echo "<td>" . htmlspecialchars($row["USERID"]) . "</td>";
			echo "<td>" . htmlspecialchars($row["GENDER"]) . "</td>";
			echo "<td>" . htmlspecialchars($row["GENERATION"]) . "</td>";
			echo "<td>" . htmlspecialchars($row["FULLNAME"]) . "</td>";
			echo "<td>" . htmlspecialchars($row["AGE"]) . "</td>";
			echo "<td>" . htmlspecialchars($row["BIRTHDATE"]) . "</td>";
			echo "</tr>";
		}
	

		echo "</table>";


	}

	function connectToDB()
	{
		global $db_conn;
		global $config;

		// Your username is ora_(CWL_ID) and the password is a(student number). For example,
		// ora_platypus is the username and a12345678 is the password.
		// $db_conn = oci_connect("ora_cwl", "a12345678", "dbhost.students.cs.ubc.ca:1522/stu");
		$db_conn = oci_connect($config["dbuser"], $config["dbpassword"], $config["dbserver"]);

		if ($db_conn) {
			debugAlertMessage("Database is Connected");
			return true;
		} else {
			debugAlertMessage("Cannot connect to Database");
			$e = OCI_Error(); // For oci_connect errors pass no handle
			echo htmlentities($e['message']);
			return false;
		}
	}

	function disconnectFromDB()
	{
		global $db_conn;

		debugAlertMessage("Disconnect from Database");
		oci_close($db_conn);
	}

	function handleUpdateRequest()
	{
		global $db_conn;

		$old_name = $_POST['oldName'];
		$new_name = $_POST['newName'];

		// you need the wrap the old name and new name values with single quotations
		$stmt = executePlainSQL("UPDATE Users SET fullName='" . $new_name . "' WHERE fullName='" . $old_name . "'");
		if ($stmt) {
			oci_commit($db_conn);
			echo "Update operation successful!";
		} else {
			$e = oci_error($db_conn);
			echo "Error: " . htmlentities($e['message']);
		}
	}

	function handleDeleteRequest()
	{
		global $db_conn;

		$UserID = $_POST['UserID'];

		// you need the wrap the old name and new name values with single quotations
		$stmt = executePlainSQL("DELETE FROM Users WHERE userID='" . $UserID . "'");
		    // Check for errors
			// Check if any rows were affected (deleted)
$rowCount = oci_num_rows($stmt);

if ($rowCount > 0) {
    oci_commit($db_conn);
    echo "Delete operation successful!";
} elseif ($rowCount === 0) {
    // No rows were deleted, meaning the UserID does not exist
    echo "Error: User with UserID = $UserID does not exist.";
} else {
    // An error occurred during execution
    $e = oci_error($stmt);
    echo "Error: " . htmlentities($e['message']);
}
		//oci_commit($db_conn);
	}

	function handleDeletePostRequest()
	{
		global $db_conn;

		$name = $_POST['PostID'];

		// you need the wrap the old name and new name values with single quotations
		$stmt = executePlainSQL("DELETE FROM Post WHERE fullName='" . $name . "'");
		    // Check for errors
			if ($stmt) {
				oci_commit($db_conn);
				echo "Delete operation successful!";
			} else {
				$e = oci_error($db_conn);
				echo "Error: " . htmlentities($e['message']);
			}
		//oci_commit($db_conn);
	}

	function handleResetRequest()
	{
		global $db_conn;
		// Drop old tables
		executePlainSQL("DROP TABLE Accountowns");
		executePlainSQL("DROP TABLE Hashtag");
		executePlainSQL("DROP TABLE Comments");
		//executePlainSQL("DROP TABLE MadePost");
		executePlainSQL("DROP TABLE Posts");
		executePlainSQL("DROP TABLE Users");


		// Create new table
		echo "<br> creating new table Hashtag<br>";
		// create table for Hashtag
		executePlainSQL("CREATE TABLE Hashtag (
			hashID int PRIMARY KEY,
			hashName VARCHAR(100))");
		echo "<br> creating new table Users<br>";
		// create table for User
		executePlainSQL("CREATE TABLE Users(
			userID INTEGER,
			gender VARCHAR(3),
			generation VARCHAR(10),
			fullName VARCHAR(30),
			age INTEGER,
			birthdate DATE,
			PRIMARY KEY (userID) 
		  )");
		  echo "<br> creating new table Posts<br>";
		  // create table for Posts
		  executePlainSQL("CREATE TABLE Posts(
			  PostID INTEGER,
			  location VARCHAR(100),
			  postDate DATE,
			  userID INTEGER,
			  PRIMARY KEY (PostID),
			  FOREIGN KEY (userID) REFERENCES Users(userID) ON DELETE CASCADE
			)");
		executePlainSQL("INSERT 
		INTO Users(userID, gender, generation, fullName, age, birthdate) 
		VALUES (1111, 'F', 'Boomer',  'Emily Davis', 35, TO_DATE('1988-02-19', 'YYYY-MM-DD'))
		");
		executePlainSQL("INSERT 
		INTO Users(userID, gender, generation, fullName, age, birthdate) 
		VALUES (4444, 'M', 'Boomer',  'Siri', 22, TO_DATE('2002-06-19', 'YYYY-MM-DD'))
		");
		executePlainSQL("INSERT 
		INTO Users(userID, gender, generation, fullName, age, birthdate) 
		VALUES (5555, 'M', 'Alpha',  'Jessie', 17, TO_DATE('2006-02-19', 'YYYY-MM-DD'))
		");

		executePlainSQL("INSERT 
		INTO Users(userID, gender, generation, fullName, age, birthdate) 
		VALUES (2222, 'F', 'Millenial',  'Zoey Ma', 19, TO_DATE('2004-04-19', 'YYYY-MM-DD'))
		");
		executePlainSQL("INSERT 
		INTO Users(userID, gender, generation, fullName, age, birthdate) 
		VALUES (3333, 'M', 'Z',  'Siri', 18, TO_DATE('2005-07-05', 'YYYY-MM-DD'))
		");
		executePlainSQL("INSERT 
		INTO Users(userID, gender, generation, fullName, age, birthdate) 
		VALUES (6666, 'M', 'Millenial',  'Travis Scott', 35, TO_DATE('1995-02-19', 'YYYY-MM-DD'))
		");
		executePlainSQL("INSERT 
		INTO Users(userID, gender, generation, fullName, age, birthdate) 
		VALUES (7777, 'M', 'Alpha',  'Small Child', 35, TO_DATE('2012-02-19', 'YYYY-MM-DD'))
		");
		echo "<br> creating new table Accountowns<br>";
		// create table for Account
		executePlainSQL("CREATE TABLE Accountowns(
			userName VARCHAR(100),
			displayName VARCHAR(100),
			numFollowing INTEGER,
			numFollowers INTEGER,
			numPosts INTEGER,
			userID INTEGER,
			PRIMARY KEY (userName, userID),
			FOREIGN KEY (userID) REFERENCES Users(userID) ON DELETE CASCADE
		  )");
		  executePlainSQL("INSERT 
		  INTO Posts(PostID, location, postDate, userID) 
		  VALUES (2001, 'Vancouver', TO_DATE('2023-12-05', 'YYYY-MM-DD'),  2222)
		  ");
		  executePlainSQL("INSERT 
		  INTO Posts(PostID, location, postDate, userID) 
		  VALUES (2002, 'Vancouver', TO_DATE('2024-04-04', 'YYYY-MM-DD'),  2222)
		  ");
		  executePlainSQL("INSERT 
		  INTO Posts(PostID, location, postDate, userID) 
		  VALUES (2003, 'Vancouver', TO_DATE('2024-04-04', 'YYYY-MM-DD'),  3333)
		  ");
		  executePlainSQL("INSERT 
		  INTO Posts(PostID, location, postDate, userID) 
		  VALUES (2004, 'Toronto', TO_DATE('2024-04-04', 'YYYY-MM-DD'),  2222)
		  ");
		  executePlainSQL("INSERT 
		  INTO Posts(PostID, location, postDate, userID) 
		  VALUES (2005, 'Calgary', TO_DATE('2024-04-04', 'YYYY-MM-DD'),  4444)
		  ");
		  executePlainSQL("INSERT 
		  INTO Posts(PostID, location, postDate, userID) 
		  VALUES (2006, 'Calgary', TO_DATE('2024-08-04', 'YYYY-MM-DD'),  4444)
		  ");

		// create table for MadeComments
		// executePlainSQL("CREATE TABLE MadePosts(
		// 	userID INTEGER,
		// 	postID INTEGER,
		// 	PRIMARY KEY (postID),
		// 	FOREIGN KEY (userID) REFERENCES Users(userID), 
		// 	FOREIGN KEY (postID) REFERENCES Posts(PostID)
		//   )");
		echo "<br> creating new table Comments<br>";
		// create table for Comments
		executePlainSQL("CREATE TABLE Comments(
			commentText VARCHAR(100),
			commentID INTEGER,
			commmentDate DATE,
			userID INTEGER,
			postID INTEGER,
			PRIMARY KEY (commentID),
			FOREIGN KEY (userID) REFERENCES Users(userID)  ON DELETE CASCADE,
			FOREIGN KEY (postID) REFERENCES Posts(PostID)  ON DELETE CASCADE
		  )");


	}

	function handleCreateUserRequest()
	{
		global $db_conn;

		//Getting the values from user and insert data into the table
	    $tuple = array(
			":bind1" => $_POST['userID'],
			":bind2" => $_POST['gender'],
			":bind3" => $_POST['generation'], // Include generation 
			":bind4" => $_POST['fullName'],
			":bind5" => $_POST['age'],
			":bind6" => $_POST['birthdate']
		);

		$alltuples = array(
			$tuple
		);

		$sql = "INSERT INTO Users(userID, gender, generation, fullName, age, birthdate)
				Values (:bind1, :bind2, :bind3, :bind4, :bind5, TO_DATE(:bind6, 'YYYY-MM-DD'))";


		executeBoundSQL($sql, $alltuples);
		oci_commit($db_conn);
		echo "<br>Create User successfully !<br>";

	}

	function handleCreatePostRequest()
	{
		global $db_conn;

		//Getting the values from user input and insert data into the post table
	    $tuple = array(
			":bind1" => $_POST['PostID'],
			":bind2" => $_POST['location'],
			":bind3" => $_POST['postDate'], 
			":bind4" => $_POST['userID'],
		);

		$alltuples = array(
			$tuple
		);

		$sql = "INSERT INTO Posts(PostID, location, postDate, userID)
				Values (:bind1, :bind2, TO_DATE(:bind3, 'YYYY-MM-DD'), :bind4)";



		executeBoundSQL($sql, $alltuples);
		oci_commit($db_conn);
		if ($sql) {
			oci_commit($db_conn);
			echo "Operation successful!";
		} else {
			$e = oci_error($db_conn);
			echo "Error: " . htmlentities($e['message']);
		}

	}


	function handleProjection() {
		global $db_conn;
	
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['projectionQueryRequest'])) {
			// Define a mapping of form input names to friendly display names
			$attributeDisplayNames = [
				'USERID' => 'UserID',
				'GENDER' => 'Gender',
				'GENERATION' => 'Generation',
				'FULLNAME' => 'FullName',
				'AGE' => 'Age',
				'BIRTHDATE' => 'Birthdate'
			];
	
			// Array to store selected attributes' database column names
			$selectedAttributes = [];
			// Array to store selected attributes' friendly display names for the header
			$selectedDisplayNames = [];
	
			// Check each checkbox to see if it was checked and add to arrays
			foreach ($attributeDisplayNames as $dbColumn => $displayName) {
				$formInputName = strtolower($dbColumn); // Assuming form input names are lowercase versions of column names
				if (isset($_POST[$formInputName]) && $_POST[$formInputName] == 'yes') {
					$selectedAttributes[] = $dbColumn;
					$selectedDisplayNames[] = $displayName;
				}
			}
	
			if (!empty($selectedAttributes)) {
				$columns = implode(", ", $selectedAttributes);
				$sql = "SELECT $columns FROM Users";
	
				$stmt = oci_parse($db_conn, $sql);
				if (!oci_execute($stmt)) {
					$e = oci_error($stmt);
					echo "Error executing statement: " . htmlentities($e['message']);
					return;
				}
	

				echo "<br>Retrieved data from table Users:<br>";
               echo "<table style='border-collapse: collapse; width: 100%;'>";
				echo "<tr style='background-color: #F0FFF0;'>";

				foreach ($selectedDisplayNames as $displayName) {
    echo "<th style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>" . htmlspecialchars($displayName) . "</th>";
}

echo "</tr>";

while ($row = oci_fetch_assoc($stmt)) {
    echo "<tr style='background-color: #ffffff;'>"; // Alternate row color if needed
    foreach ($selectedAttributes as $attribute) {
        echo "<td style='border: 1px solid #dddddd; text-align: left; padding: 8px;'>" . htmlspecialchars($row[$attribute]) . "</td>";
    }
    echo "</tr>";
}

echo "</table>";
	
				oci_free_statement($stmt);
			} else {
				echo "No attributes selected.";
			}
		}
	}
	

	function handleCountRequest()
	{
		global $db_conn;

		$result = executePlainSQL("SELECT Count(*) FROM Users");
		if (($row = oci_fetch_row($result)) != false) {
			echo '<div style="background-color: #B0E0E6; padding: 8px; margin-bottom: 8px;">';
			echo "<br> The number of tuples in Users: " . $row[0] . "<br>";
			echo '</div>';
		}
	}

	function handleCountUserRequest()
	{
		global $db_conn;

		$result = executePlainSQL("SELECT Generation, COUNT(UserID) AS UserCount FROM Users GROUP BY Generation ORDER BY Generation");

		while ($row = oci_fetch_array($result, OCI_ASSOC)) {
			echo '<div style="background-color:#FFF0F5; padding: 8px; margin-bottom: 8px;">';
            echo "Generation: " . $row['GENERATION'] . " - User Count: " . $row['USERCOUNT'];
            echo '</div>';
		}
	}

	function handleAggregationHavingRequest()
{
    global $db_conn;

    // $sql = "SELECT Generation, COUNT(UserID) AS UserCount 
    //         FROM Users 
    //         GROUP BY Generation 
    //         HAVING COUNT(UserID) > 10"; 
    $result = executePlainSQL("SELECT p.location, u.userID, u.fullName
	FROM Users u, Posts p
	WHERE u.userID = p.userID
	GROUP BY  p.location, u.userID, u.fullName
	HAVING COUNT(p.PostID) >= 2");
				if ($result) {
					oci_commit($db_conn);
					echo "Operation successful!";
				} else {
					$e = oci_error($db_conn);
					echo "Error: " . htmlentities($e['message']);
				}

    while ($row = oci_fetch_array($result, OCI_ASSOC)) {
		echo '<div style="background-color: #B0E0E6; padding: 10px; margin-bottom: 10px;">';
        echo "<br> UserID: " . $row['USERID'] . " - Name: " . $row['FULLNAME'] . " - Location: " . $row['LOCATION'] . "<br>";
		echo '</div>';
    }
}
    function handleNestedAggregationWithGroupBy(){
		global $db_conn;

		$result = executePlainSQL("SELECT generation, fullName, age
                                   FROM Users
 									WHERE (generation, age) IN (SELECT generation, MIN(age)
																 FROM Users
																 GROUP BY generation)");
		
		while ($row = oci_fetch_array($result, OCI_ASSOC)) {
			echo '<div style="background-color: #B0E0E6; padding: 10px; margin-bottom: 10px;">';
            echo "Generation: " . $row['GENERATION'] ." - Name: " . $row['FULLNAME'] . " - Age: " . $row['AGE'];
            echo '</div>';
		}

	}

	function handleDisplayUsersRequest()
	{
		global $db_conn;
		$result = executePlainSQL("SELECT * FROM Users");
		printResult($result);
	}

	function handleDisplayPostsRequest()
	{
		global $db_conn;
		$result = executePlainSQL("SELECT * FROM Posts");
		printPostResult($result);
	}

	function printPostResult($result)
	{ 
        echo "<br>Retrieved data from table Posts:<br>";
	
		echo "<table border='1' cellpadding='10' style='border-collapse: collapse; width: 100%;'>";
		// Define header row with styles
		echo "<tr style='background-color: #4682B4;'>";
		echo "<th>PostID</th><th>Location</th><th>PostDate</th><th>UserID</th>";
		echo "</tr>";
	
		// Initialize row counter for zebra striping
		$i = 0;
	
		// Fetch each record in the result set
		while ($row = OCI_Fetch_Array($result, OCI_ASSOC)) {
			// Define data rows with zebra striping for better readability
			echo "<tr style='background-color: " . ($i++ % 2 === 0 ? "#ADD8E6" : "#B0C4DE") . ";'>";
			echo "<td>" . htmlspecialchars($row["POSTID"]) . "</td>";
			echo "<td>" . htmlspecialchars($row["LOCATION"]) . "</td>";
			echo "<td>" . htmlspecialchars($row["POSTDATE"]) . "</td>";
			echo "<td>" . htmlspecialchars($row["USERID"]) . "</td>";
			echo "</tr>";
		}
	
		// End the table
		echo "</table>";

	}

	function handleSelectionRequest() {
		global $db_conn;
		// default value for the selection

		$whereCondition = $_POST['condition'];

    if (empty($whereCondition)) {
        echo "<p>Please enter a condition.</p>";
        return;
    }

    $sql = "SELECT * FROM Users WHERE " . $whereCondition;
    $result = executePlainSQL($sql);

    if (!oci_execute($result)) {
        $e = oci_error($result);
        echo "Error executing statement: " . htmlentities($e['message']);
        return;
    }

    printResult($result);
}


	function handleJoinRequest() {
		global $db_conn;
	
		$location = $_POST['location'];

		$result = executePlainSQL("SELECT u.fullName, p.location
		FROM Users u, Posts p
		WHERE u.userID = p.userID 
		AND p.location = '" . $location . "'");


	while ($row = oci_fetch_array($result, OCI_ASSOC)) {
		echo "<br> Fullname: " . $row['FULLNAME'] . " - Location: " . $row['LOCATION'] . "<br>";
	}
	if (!oci_num_rows($result)) {
		echo "<p>No Results Found</p>"; 
	}	
}
	function handleUpdatePostRequest()
	{
		global $db_conn;
		$postID = $_POST['postID'];
		$new_location = $_POST['newLocation'];

		// you need the wrap the old name and new name values with single quotations
		$stmt = executePlainSQL("UPDATE Posts SET location='" . $new_location . "' WHERE postID='" . $postID . "'");
		if ($stmt) {
			oci_commit($db_conn);
			echo "Update operation successful!";
		} else {
			$e = oci_error($db_conn);
			echo "Error: " . htmlentities($e['message']);
		}
	}
	function handleDivisionRequest() {
		global $db_conn;

		$result = executePlainSQL("SELECT u.userID
		FROM Users u
		WHERE NOT EXISTS (
			SELECT p1.postID
			FROM Posts p1
			WHERE p1.location = 'Toronto'
			AND NOT EXISTS (SELECT p2.postID
			FROM Posts p2
			WHERE p1.postID = p2.postID
			AND p2.userID = u.userID)
			)");

	while ($row = oci_fetch_array($result, OCI_ASSOC)) {
		echo "<br> UserID: " . $row['USERID'] . "<br>";
	}
	if (!oci_num_rows($result)) {
		echo "<p>No Results Found</p>"; 
	}

	}




	// HANDLE ALL POST ROUTES
	// A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
	function handlePOSTRequest()
	{
		if (connectToDB()) {
			if (array_key_exists('resetTablesRequest', $_POST)) {
				handleResetRequest();
			} else if (array_key_exists('updateQueryRequest', $_POST)) {
				handleUpdateRequest();
			} else if (array_key_exists('deleteQueryRequest', $_POST)) {
					handleDeleteRequest();
			} else if (array_key_exists('CreateUserRequest', $_POST)) {
				handleCreateUserRequest();
			} else if (array_key_exists('projectionQueryRequest', $_POST)){
				handleProjection();
			} else if (array_key_exists('CreatePostRequest', $_POST)){
				handleCreatePostRequest();
			} else if (array_key_exists('deletePostRequest', $_POST)) {
				handleDeletePostRequest();
			} elseif (array_key_exists('selectionQueryRequest', $_POST)) {
				handleSelectionRequest();
			} elseif (array_key_exists('joinUserRequest', $_POST)) {
				handleJoinRequest();
			} elseif (array_key_exists('updatePostQueryRequest', $_POST)) {
				handleUpdatePostRequest();
			} 

			disconnectFromDB();
	}
}

	// HANDLE ALL GET ROUTES
	// A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
	function handleGETRequest()
	{
		if (connectToDB()) {
			if (array_key_exists('countTuples', $_GET)) {
				handleCountRequest();
			} else if (array_key_exists('countUser', $_GET)) {
					handleCountUserRequest();
			} elseif (array_key_exists('displayUsersRequest', $_GET)) {
				handleDisplayUsersRequest();
			} else if (array_key_exists('countUserWithAtLeast2', $_GET)) {
				handleAggregationHavingRequest();
		    } else if (array_key_exists('countYoungestUserWithAtLeast2', $_GET)){
				handleNestedAggregationWithGroupBy();
			} elseif (array_key_exists('displayPostsRequest', $_GET)) {
				handleDisplayPostsRequest();
			} elseif (array_key_exists('displayMadePostsRequest', $_GET)) {
				//handleDisplayMadePostsRequest();
			} elseif (array_key_exists('division', $_GET)) {
				handleDivisionRequest();
			}

			disconnectFromDB();
		}
	}

	if (isset($_POST['reset']) || isset($_POST['updateSubmit']) || isset($_POST['createSubmit']) || isset($_POST['deleteSubmit']) || isset($_POST['projectSubmit'])
	|| isset($_POST['createPostSubmit']) || isset($_POST['deletePostSubmit']) || isset($_POST['selectSubmit']) || isset($_POST['joinUser']) || isset($_POST['updatePostSubmit'])) {
		handlePOSTRequest();
	} else if (isset($_GET['countTupleRequest']) || isset($_GET['displayUsersRequest']) || isset($_GET['countUserRequest']) 
	|| isset($_GET['aggregationHaving']) || isset($_GET['nestedAggregationHaving'])|| isset($_GET['displayPostsRequest'])
	|| isset($_GET['displayMadePostsRequest']) || isset($_GET['divisionsubmit'])){
		handleGETRequest();
	}
	
	// End PHP parsing and send the rest of the HTML content
	?>
</body>

</html>
