<?php

class Validation extends Database {
    static public function has_unique_email($email, $current_id="0") {

        $user = User::find_by_email($email);
        if($user === false || $user->id == $current_id) {
        // is unique
        return true;
        } else {
        // not unique;
        return false;
        }

        // $sql = "SELECT * FROM users ";
        // $sql.= "WHERE email='" . $email . "' ";
        // $sql.= "AND id !='" . $current_id . "'";

        // $user_set = Database::$database->query($sql);
        // $user_count = mysqli_num_rows($user_set);
        // $user_set->free();

        // return $user_count === 0; // returns true/false
    }

    static public function is_blank($value) {
        return !isset($value) || trim($value) === '';
    }  

    static public function has_length_greater_than($value, $min) {
        $length = strlen($value);
        return $length > $min;
    }

    static public function has_length_less_than($value, $max) {
        $length = strlen($value);
        return $length < $max;
    }

    static public function has_length_exactly($value, $exact) {
        $length = strlen($value);
        return $length == $exact;
    }

    static public function has_length($value, $options) {
        if(isset($options['min']) && !self::has_length_greater_than($value, $options['min'] - 1)) {
        return false;
        } elseif(isset($options['max']) && !self::has_length_less_than($value, $options['max'] + 1)) {
        return false;
        } elseif(isset($options['exact']) && !self::has_length_exactly($value, $options['exact'])) {
        return false;
        } else {
        return true;
        }
    }

    static public function validate_file($file) {
        $errors = [];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if($fileExt === "jpg" || $fileExt === "png" || $fileExt === "jpeg") {
            if($fileSize < 50000) {
                if($fileError === 0) {
                    $fileNameNew = time() . "." . $fileExt;
                    $fileDestination = 'images/' . $fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    return $fileNameNew;
                } else {
                    $errors[] = "There was an error uploading the file";
                }
            } else {
                $errors[] = "Image size is too large";
            }
        } else { 
            $errors[] = "Image type is not valid";
        }
        return $errors;
    }
}

?>