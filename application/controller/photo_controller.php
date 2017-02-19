<?php

require_once APP . 'model/photo.php';

class PhotoController
{

  public function index()
  {
    // list of user's photos if logged in
    $current_user = NULL;
    $photos = NULL;

    $current_user = $_SESSION['current_user'];
    $userID =$current_user->userID;

    $this->user_index($userID);
  }

  public function user_index($userID)
  {
    $model = new Photo();
    $photos = $model->find_user_photos($userID);

    require APP . 'view/_templates/header.php';
    require APP . 'view/photos/index.php';
    require APP . 'view/_templates/footer.php';
  }

  public function view($photoID)
  {

    // display photo and comments
    $model = new Photo();
    $photo = $model->find_by_id($photoID);

    // TODO: Check if user has view access to photo

    $photo_comments = NULL;
    if (count($photo) > 0) {
      $photo_comments = $model->find_photo_comments($photoID);
    }

    require APP . 'view/_templates/header.php';
    require APP . 'view/photos/view.php';
    require APP . 'view/_templates/footer.php';
  }

  public function upload()
  {

    $current_user = NULL;
    $current_user = $_SESSION['current_user'];
    $userID = $current_user->userID;

    if (isset($_GET['collectionID'])) {
        $collectionID = $_GET['collectionID'];

        // TODO: Check if user has upload access to photo collection

        require APP . 'view/_templates/header.php';
        require APP . 'view/photos/upload.php';
        require APP . 'view/_templates/footer.php';

    } else if (isset($_POST['submit'])) {

      $collectionID = $_POST['collectionID'];
      $uploadFile = $_FILES['uploadFile'];

      // TODO: Check if user has upload access to photo collection
      // TODO validate file format, size
      // TODO rename file if already exist

      $targetDirectory = "uploads/users/" . $userID . '/';
      // create user's directory if it does not exist
      if (!file_exists($targetDirectory)) {
          mkdir($targetDirectory, 0777, true);
      }

      $targetFile = $targetDirectory . basename($uploadFile["name"]);
      $uploadResult = move_uploaded_file($uploadFile["tmp_name"], $targetFile);

      if ($uploadResult) {
        // insert into database
        $model = new Photo();
        $result = $model->create($userID,
                                $collectionID,
                                $targetFile);
        if ($result) {
          $_SESSION['message'] = 'Photo uploaded successfully';
          header('location: ' . URL . 'collection/' . $collectionID);
        } else {
          $_SESSION['message'] = 'Photo upload failed';
          unlink($targetFile); // remove uploaded file
          header('location: ' . URL . 'photo/upload?collectionID=' . $collectionID);
        }


      } else {
        $_SESSION['message'] = 'Photo upload failed';
        header('location: ' . URL . 'photo/upload?collectionID=' . $collectionID);
      }

    } else {
      $_SESSION['message'] = 'No Collection ID';
      header('location: ' . URL);
    }

  }

}

?>