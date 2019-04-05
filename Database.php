<?php
/**
 * Database Class
 * This class is used to connect to the database and
 * perform database related operations with mysqli
 */
class Database {
    private $connection;

    /**
     * Connect to the database upon creation of new instance
     */
    public function __construct() {
        $this->connect();
    }

    /**
     * Connect to the database using mysqli
     */
    public function connect() {
        $this->connection = mysqli_connect("localhost", "root", "", "particle");
		if(!$this->connection) {
			die("Connection failed: " . mysqli_connect_error() . mysqli_connect_errno());
		}
    }
    
    /**
     * Store image in the database and filesystem
     * @param String image_path - path where the file will be uploaded
     */
    public function storeImage($image_path) {
        //get image file type
        $imageFileType = strtolower(pathinfo($image_path, PATHINFO_EXTENSION));

        //valid file extentions
        $extensions_arr = array("jpg","jpeg","png");

        //store image if file type is valid
        if (in_array($imageFileType, $extensions_arr)) {
            $query = "INSERT INTO images(image_path) VALUES('".$image_path."')";
            $result = mysqli_query($this->connection, $query);

            if ($result) {
                move_uploaded_file($_FILES['file']['tmp_name'], $image_path);
                return "Image was successfully uploaded!";
            }

            return "Image was not uploaded. Please try again.";
        } else {
            return "Invalid file format! Please upload jpg or png file.";
        }
    }
}