<?php
require("partials/dbconnect.php");
$myalert = false;
$myerror = false;
$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST') {
    if (isset($_POST['category_name'], $_POST['category_description']) && isset($_FILES['category_image'])) {
        $category_name = $_POST['category_name'];
        $category_description = $_POST['category_description'];
        if (isset($_FILES['category_image'])) {
            $category_image = $_FILES['category_image']['name'];
            $tempname = $_FILES['category_image']['tmp_name'];
            $folder = 'uploded_images/' . $category_image;

            if (move_uploaded_file($tempname, $folder)) {
                // Escape the variables to prevent SQL injection
                $category_image = mysqli_real_escape_string($conn, $category_image);
                $category_name = mysqli_real_escape_string($conn, $category_name);
                $category_description = mysqli_real_escape_string($conn, $category_description);

                // Construct the SQL query
                $catsql = "INSERT INTO `categories` (`category_image`, `category_name`, `category_description`) VALUES ('$category_image', '$category_name', '$category_description')";

                $catresult = mysqli_query($conn, $catsql);

                if ($catresult) {
                    $myalert = "Category has been added successfully";
                } else {
                    $myerror = "Error in adding category: " . mysqli_error($conn);
                }
            } else {
                $myerror = "Failed to upload the image.";
            }
        } else {
            $myerror = "No image uploaded.";
        }
    }
}
?>

<!-- Modal -->
<div class="modal fade" id="addcategoryModal" tabindex="-1" aria-labelledby="addcategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addcategoryModalLabel">Add new Category</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="category_name" class="form-label">Category Name</label>
                        <input type="text" class="bg-secondary-subtle form-control" name="category_name" id="category_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="category_description" class="form-label">Category Description</label>
                        <textarea class="bg-secondary-subtle form-control" name="category_description" rows="6" id="category_description" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="category_image" class="form-label">Category Image</label>
                        <input type="file" class="bg-secondary-subtle form-control" name="category_image" id="category_image" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Category</button>
                </form>
            </div>
        </div>
    </div>
</div>