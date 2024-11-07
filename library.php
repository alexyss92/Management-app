<?php 

    function setDisabled() {
        global $op;

        if ($op == 'view') {
            echo " disabled";
        }
    }

    function setTextArea($value) {
        global $op;

        if ($op == 'update' || $op == 'view') {
            echo $value;
        }
    }

    function setValue($value) {
        global $op;

        if ($op == 'update') {
            echo "value = \"$value\"";
        } elseif ($op == 'view') {
            echo "value = \"$value\" disabled";
        } elseif ($op == 'insert'){
            echo "value = \"$value\"";
        }
    }


    function get($chiave, $valoreDefault) {
        if ( isset($_GET[$chiave]) ) {
            return $_GET[$chiave];
        } else {
            return $valoreDefault;
        }
    }

    function post($chiave, $valoreDefault) {
        if ( isset($_POST[$chiave]) && !empty($_POST[$chiave]) ) {
            return $_POST[$chiave];
        } else {
            return $valoreDefault;
        }
    }

    function getDateLocale($dateSchema = 'eee d MMMM y HH:mm') {
          // "date_default_timezone_set" may be required by your server
          date_default_timezone_set('Europe/Rome');

          // make a DateTime object 
          // the "now" parameter is for get the current date, 
          // but that work with a date recived from a database 
          // ex. replace "now" by '2022-04-04 05:05:05'
          $dateTimeObj = new DateTime('now', new DateTimeZone('Europe/Rome'));

          // format the date according to your preferences
          // the 3 params are [ DateTime object, ICU date scheme, string locale ]
          $dateFormatted = 
          IntlDateFormatter::formatObject( 
            $dateTimeObj, 
            $dateSchema, 
            'it' 
          );

          return ucwords($dateFormatted);
    }

    function getRecordCount($tableName) {
        global $dbUser, $dbPassword, $connString;

        try {
            $conn = new PDO($connString, $dbUser, $dbPassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = 'SELECT COUNT(*) FROM ' . $tableName . ';';
            $result = $conn->query($sql);
            $recordCount = $result->fetchColumn();

            $conn = null;
        } catch (PDOException $err) {
            echo $err->getMessage();
        }

        return $recordCount;
    }
?>