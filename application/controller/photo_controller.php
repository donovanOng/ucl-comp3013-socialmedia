<?php

require_once APP . 'model/user.php';
require_once APP . 'model/photo.php';
require_once APP . 'model/collection.php';

class PhotoController
{

  function __construct()
  {
    if (isset($_SESSION['current_user'])) {
      $this->current_user = $_SESSION['current_user'];
      $this->current_userID = $_SESSION['current_user']->userID;
    }
  }

  public function user_index($photo_userID)
  {
    $model = new User();
    $user = $model->find_by_id($photo_userID);

    $model = new Photo();
    $photos = $model->find_user_photos($photo_userID);

    require APP . 'view/_templates/header.php';
    require APP . 'view/photos/index.php';
    require APP . 'view/_templates/footer.php';
  }

  public function view($photoID)
  {
    // display photo and comments
    $model = new Photo();
    $photo = $model->find_by_id($photoID);

    $photo_comments = NULL;
    if ($photo != NULL) {
      $photo_comments = $model->find_photo_comments($photoID);
    }

    require APP . 'view/_templates/header.php';
    require APP . 'view/photos/view.php';
    require APP . 'view/_templates/footer.php';
  }

  public function upload()
  {

    if (isset($_GET['collectionID'])) {
        $collectionID = $_GET['collectionID'];

        // TODO: Check if user has upload access to photo collection

        require APP . 'view/_templates/header.php';
        require APP . 'view/photos/upload.php';
        require APP . 'view/_templates/footer.php';

    } else if (isset($_POST['submit'])) {

      $collectionID = $_POST['collectionID'];
      $uploadFile = $_FILES['uploadFile'];

      // TODO: Check if user has upload access to photo collectiont

      $result = $this->upload_photo($collectionID, $uploadFile);

      if ($result) {
        $_SESSION['message'] = 'Photo uploaded successfully';
        Redirect(URL . 'collection/' . $collectionID);
      } else {
        $_SESSION['message'] = 'Photo upload failed';
        Redirect(URL . 'photo/upload?collectionID=' . $collectionID);
      }

    } else {
      $_SESSION['message'] = 'No Collection ID';
      Redirect(URL);
    }

  }

  private function upload_photo($collectionID, $uploadFile)
  {
    $targetDirectory = "uploads/users/" . $this->current_userID . '/';
    // create user's directory if it does not exist
    if (!file_exists($targetDirectory)) {
        mkdir($targetDirectory, 0777, true);
    }

    // TODO validate file format, size
    // TODO rename file if already exits

    $targetFile = $targetDirectory . basename($uploadFile["name"]);
    $uploadResult = move_uploaded_file($uploadFile["tmp_name"], $targetFile);

    if ($uploadResult) {
      // insert into database
      $model = new Photo();
      $result = $model->create($this->current_userID,
                              $collectionID,
                              $targetFile);

      if (!$result) { unlink($targetFile); }
      return $result;

    } else {
      return FALSE;
    }
  }

}

?>
