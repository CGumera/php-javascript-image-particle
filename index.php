<?php
require_once("Database.php");

if (isset($_POST['submit'])) {
    $images_dir = "images/";
    $image_path = $images_dir . basename($_FILES['file']['name']);

		$database = new Database();
		$message = $database->storeImage($image_path);
}
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Image Particles Test</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
				<p><?php echo isset($message) ? $message : "" ?></p>
        <div>
            <form method="post" enctype='multipart/form-data'>
                <strong>Upload Image:</strong>
                <input type="file" name="file" required/>
                <input type="submit" name="submit" value="Submit" />
            </form><br/>
            <input type="button" value="Click here!" onclick="startDraw()"/>
        </div>
        <canvas id="image"></canvas>
    </body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.7.3/p5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pixi.js/3.0.11/pixi.min.js"></script>
<script type="text/javascript">
	//set path of image to be rendered
	var imagePath = '<?php echo isset($image_path) ? $image_path : "" ?>';
</script>
<script src="js/app.js"></script>
