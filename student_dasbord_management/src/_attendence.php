<?php

function sumofattemdance($roll_number, $tables){
    include 'src/_dbconnect.php';
    // $server = "127.0.0.1";
    // $username = "root";
    // $password = "@i!yaKizu";
    // $database = "user_1s";

    // $conn = mysqli_connect($server, $username, $password, $database);
    // if (!$conn){
        
    //     die("Error". mysqli_connect_error());
    // }

    // $roll_number=101;

    // Fetch column names from the table
    $result_array = array();

    foreach ($tables as $table_name) {

        $sql = "SHOW COLUMNS FROM $table_name";
        
        $result = mysqli_query($conn, $sql);
        if($result===false){
            die ("Connection failed: ");
        }
        // echo $result . "<br>";
        $allowed_columns = array("january", "feburary", "march", "column4");
        $num = mysqli_num_rows($result);
        // $result = $conn->query($sql);

        if ($num > 0) {
            // Array to store valid column names
            $valid_columns = array();

            // Process each row to check if column exists in allowed columns array
            while ($row = $result->fetch_assoc()) {
                $column_name = $row['Field'];
                if (in_array($column_name, $allowed_columns)) {
                    $valid_columns[] = $column_name;
                }
            }

            // Construct SQL query to sum up values of valid columns for the specified roll number
            if (!empty($valid_columns)) {
                $columns_str = implode(" + ", $valid_columns);
                $sql_sum = "SELECT SUM($columns_str) AS total_sum FROM $table_name WHERE roll_num = $roll_number";

                // Execute SQL query
                $result_sum = $conn->query($sql_sum);

                if ($result_sum === false) {
                    echo "Error executing query: " . $conn->error;

                } else {
                    if ($result_sum->num_rows > 0) {
                        // Output total sum for the specified roll number
                        $row_sum = $result_sum->fetch_assoc();
                        // echo "Total Sum for Roll Number $roll_number : <br>" . $row_sum["total_sum"] . "<br>";
                        $total = $row_sum["total_sum"];
                        // echo "<br>" . $total . "<br>";
                        $result_array[$table_name] = $total;
                        // echo $result_array[$table_name];
                    } else {
                        echo "No records found for Roll Number $roll_number";
                    }
                }
            } else {
                echo "No valid columns found in the table.";
                $result_array[$table_name] = "you are just ennorled" ;
            }
        } else {
            echo "No columns found in the table.";
            $result_array[$table_name] =  "you are not ennorled" ; 
        }
    }

    // Close connection
    $conn->close();
    return $result_array;

}

// Example usage:
$roll_number = 101; // Replace with the desired roll number
$tables = array("table1", "table2", "table3"); // Replace with the table names
$result_array = sumofattemdance($roll_number, $tables);

// foreach ($result_array as $key => $value) {
//     echo "Key: $key, Value: $value <br>";
// }

$tb = 'table2';
$t = $result_array[$tb];
echo $t;
?>
