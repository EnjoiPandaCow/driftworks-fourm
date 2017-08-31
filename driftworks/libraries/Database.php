<?php
class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    /*
     * dbh = handler to interact with the database,
     * error = used to output errors
     * stmt = used for prepared statements
     */
    private $dbh;
    private $error;
    private $stmt;

    /*
     * Called whenever you create a new database object.
     */
    public function __construct() {
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        // Set options
        $options = array (
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        //Create a new PDO instanace
        try {
            $this->dbh = new PDO ($dsn, $this->user, $this->pass, $options);
        }		// Catch any errors
        catch ( PDOException $e ) {
            $this->error = $e->getMessage();
        }
    }


    //Pass in a query from where ever we are working from.
    public function query($query) {
        $this->stmt = $this->dbh->prepare($query);
    }


    // Binding values to the query, prevents SQL injections, checking the type of input.
    public function bind($param, $value, $type = null) {
        if (is_null ( $type )) {
            switch (true) {
                case is_int ( $value ) :
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool ( $value ) :
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null ( $value ) :
                    $type = PDO::PARAM_NULL;
                    break;
                default :
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue ( $param, $value, $type );
    }


    // Execute what ever your statement is.
    public function execute() {
        return $this->stmt->execute();
    }


    // Used to grab onto the result object.
    public function resultset() {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }


    // Used to retrieve one result.
    public function single() {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }


    // Going to return the amount of rows returned.
    public function rowCount() {
        return $this->stmt->rowCount();
    }


    // Give ID of whatever the last ID you inserted was.
    public function lastInsertId() {
        return $this->dbh->lastInsertId();
    }
}