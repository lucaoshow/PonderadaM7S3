<?php include "../inc/dbinfo.inc"; ?>
<html>
    <body>
        <h1>Backends do NSYNC</h1>
        <?php

            /* Connect to PostgreSQL and select the database. */
            $constring = "host=" . DB_SERVER . " dbname=" . DB_DATABASE . " user=" . DB_USERNAME . " password=" . DB_PASSWORD ;
            $connection = pg_connect($constring);

            if (!$connection){
                echo "Failed to connect to PostgreSQL";
                exit;
            }
            /* Ensure that the NSYNC table exists. */
            VerifyNSYNCTable($connection, DB_DATABASE);

            /* If input fields are populated, add a row to the NSYNC table. */
            $nsyncer_name = htmlentities($_POST['NOME']);
            $nsyncer_language = htmlentities($_POST['LINGUAGEM_BACKEND']);
            $nsyncer_finished = 0;
            if (isset($_POST['TERMINOU_BACKEND'])) {
                $nsyncer_finished = 1;
            }

            if (strlen($nsyncer_name) && strlen($nsyncer_language)) {
                AddNSYNCER($connection, $nsyncer_name, $nsyncer_language, $nsyncer_finished);
            }

        ?>

        <!-- Input form -->
        <form action="<?PHP echo $_SERVER['SCRIPT_NAME'] ?>" method="POST">
            <table border="0">
                <tr>
                    <td>NOME</td>
                    <td>LINGUAGEM DO BACKEND</td>
                    <td>TERMINOU BACKEND</td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="NOME" maxlength="45" size="30" />
                    </td>
                    <td>
                        <input type="text" name="LINGUAGEM_BACKEND" maxlength="45" size="60" />
                    </td>
                    <td>
                        <input type="checkbox" name="TERMINOU_BACKEND" value="true" />
                    </td>
                    <td>
                        <input type="submit" value="Add Data" />
                    </td>
                </tr>
            </table>
        </form>
        <!-- Display table data. -->
        <table border="1" cellpadding="2" cellspacing="2">
            <tr>
                <td>ID</td>
                <td>NOME</td>
                <td>LINGUAGEM DO BACKEND</td>
                <td>TERMINOU BACKEND</td>
            </tr>

            <?php

                $result = pg_query($connection, "SELECT * FROM NSYNC");

                while($query_data = pg_fetch_row($result)) {
                    echo "<tr>";
                    echo "<td>",$query_data[0], "</td>";
                    echo "<td>",$query_data[1], "</td>";
                    echo "<td>",$query_data[2], "</td>";
                    echo "<td>", $query_data[3] == "f" ? "Não" : "Sim", "</td>";
                    echo "</tr>";
                }
            ?>
        </table>

        <!-- Clean up. -->
        <?php

        pg_free_result($result);
        pg_close($connection);
        ?>
    </body>
</html>


<?php

    /* Add an employee to the table. */
    function AddNSYNCER($connection, $name, $backend_language, $finished) {
        $query = "INSERT INTO NSYNC (NOME, LINGUAGEM_BACKEND, TERMINOU_BACKEND) VALUES ($1, $2, $3);";

        if(!pg_query_params($connection, $query, array($name, $backend_language, $finished))) echo("<p>Error adding NSYNCER data.</p>");
    }

    /* Check whether the table exists and, if not, create it. */
    function VerifyNSYNCTable($connection, $dbName) {
        if(!TableExists("NSYNC", $connection, $dbName))
        {
            $query = "CREATE TABLE NSYNC (
                ID serial PRIMARY KEY,
                NOME VARCHAR(45),
                LINGUAGEM_BACKEND VARCHAR(45),
                TERMINOU_BACKEND BOOLEAN
            )";

            if(!pg_query($connection, $query)) echo("<p>Error creating table.</p>");
        }
    }

    /* Check for the existence of a table. */
    function TableExists($tableName, $connection, $dbName) {
        $t = strtolower(pg_escape_string($tableName)); //table name is case sensitive
        $d = pg_escape_string($dbName); //schema is 'public' instead of 'sample' db name so not using that

        $query = "SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_NAME = '$t';";
        $checktable = pg_query($connection, $query);

        if (pg_num_rows($checktable) >0) return true;
        return false;

    }
?>