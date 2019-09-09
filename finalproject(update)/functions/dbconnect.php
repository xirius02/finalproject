<?php
/**
 * Function to establish a database connection
 * 
 * @return PDO Object
 */  
function getDatabase() {
    
        /* PHP script runs local or remote. Database server remote */
        /* 
            *********************************************************************************
            BE SURE TO CHANGE THIS TO USE YOUR OWN dbname, user name and password! 
                
                dbname: se266_[firstname]
                DB_USER:  se266_[firstname]
	            DB_PASSWORD: studentidwithoutleadingzeroes
            	
           *********************************************************************************    
        */
    $config = array(
            'DB_DNS' => 'mysql:host=127.0.0.1;port=3306;dbname=se266_erick',
            'DB_USER' => 'root',
            'DB_PASSWORD' => ''
        );
        
        
         /* PHP script runs local. Database Server local */
       
        /*$config = array(
            'DB_DNS' => 'mysql:host=127.0.0.1;port=3306;dbname=se266_erick;',
            'DB_USER' => 'root',
            'DB_PASSWORD' => ''
        );*/
        /* Create a Database connection and save it into the variable */
        
        try {
            $db = new PDO($config['DB_DNS'], $config['DB_USER'], $config['DB_PASSWORD']);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (Exception $ex) {
            echo $ex->getMessage();
            $db = null;
        }
        
    return $db;
}

function getusers() {
    
        /* PHP script runs local or remote. Database server remote */
        /* 
            *********************************************************************************
            BE SURE TO CHANGE THIS TO USE YOUR OWN dbname, user name and password! 
                
                dbname: se266_[firstname]
                DB_USER:  se266_[firstname]
	            DB_PASSWORD: studentidwithoutleadingzeroes
            	
           *********************************************************************************    
        */
    /*$config = array(
            'DB_DNS' => 'mysql:host=ict.neit.edu;port=5500;dbname=se266_008003477',
            'DB_USER' => 'se266_008003477',
            'DB_PASSWORD' => '008003477'
        );*/
        
        
         /* PHP script runs local. Database Server local */
       
        /*$config = array(
            'DB_DNS' => 'mysql:host=127.0.0.1;port=3306;dbname=se266_erick;',
            'DB_USER' => 'root',
            'DB_PASSWORD' => ''
        );*/
        /* Create a Database connection and save it into the variable */
        /*
        try {
            $db = new PDO($config['DB_DNS'], $config['DB_USER'], $config['DB_PASSWORD']);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (Exception $ex) {
            echo $ex->getMessage();
            $db = null;
        }
        */
    define('DB_SERVER', '127.0.0.1');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'se266_erick');
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
    } else{
        
    }
    return $link;
}

function wholeuser($usr)
{
    $usr;
    $db = getDatabase();
            $stmt = $db->prepare("SELECT * FROM tblusers where username = :usr ");
        /*
         * We execute the statement and make sure we
         * got some results back.
         */
        $results = array();
        if ($stmt->execute() && $stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
    return $results;
}
?>