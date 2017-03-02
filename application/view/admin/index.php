<div class="p-4">
  <h4 class="mb-3">List of Users <span class="text-muted"><?= count($users) ?></span></h4>
  <table class="table table-hover">
  <tbody>
    <?php foreach ($users as $user) { ?>
      <tr>
        <th scope="row"><?= $user->userID ?></th>
        <td><?= $user->first_name ?></td>
        <td><?= $user->last_name ?></td>
        <td><?= $user->email ?></td>
        <td><?= $user->privacy ?></td>
        <td><?= $user->admin ?></td>
        <td class="text-right">
          <button type="button" class="btn-link" data-toggle="modal" data-target="#edit<?= $user->userID ?>">
            Edit
          </button>
          <a href="<?= URL ?>admin/delete_user?userID=<?= $user->userID ?>" class="btn-link">Delete</a>
        </td>
      </tr>
      <? require APP . 'view/admin/edit_user.php'; ?>
    <?php } ?>
  </tbody>
  </table>

  <h4 class="mb-3">List of Profiles <span class="text-muted"><?= count($profiles) ?></span></h4>
  <table class="table table-hover">
  <tbody>
    <?php foreach ($profiles as $profile) { ?>
      <tr>
        <th scope="row"><?= $profile->userID ?></th>
        <td><?= $profile->about ?></td>
        <td><?= $profile->gender ?></td>
        <td><?= $profile->birthdate ?></td>
        <td><?= $profile->current_city ?></td>
        <td><?= $profile->home_city ?></td>
        <td><?= $profile->address ?></td>
        <td><?= $profile->languages ?></td>
        <td><?= $profile->workplace ?></td>
      </tr>
    <?php } ?>
  </tbody>
  </table>


  <h4 class="mb-3">List of Circles <span class="text-muted"><?= count($circles) ?></span></h4>
  <table class="table table-hover">
  <tbody>
    <?php foreach ($circles as $circle) { ?>
      <tr>
        <th scope="row"><?= $circle->circleID ?></th>
        <td>User <?= $circle->userID ?></td>
        <td><?= $circle->name ?></td>
        <td class="text-right">
          <button type="button" class="btn-link" data-toggle="modal" data-target="#editCircle<?= $circle->circleID ?>">
            Edit
          </button>
          <a href="<?= URL ?>admin/delete_circle?circleID=<?= $circle->circleID ?>" class="btn-link">Delete</a>
        </td>
      </tr>
      <? require APP . 'view/admin/edit_circle.php'; ?>
    <?php } ?>
  </tbody>
  </table>

  <h4 class="mb-3">List of Messages <span class="text-muted"><?= count($messages) ?></span></h4>
  <table class="table table-hover">
  <tbody>
    <?php foreach ($messages as $message) { ?>
      <tr>
        <th scope="row"><?= $message->messageID ?></th>
        <td>Circle <?= $message->circleID ?></td>
        <td>User <?= $message->userID ?></td>
        <td><?= $message->content ?></td>
        <td class="text-right">
          <button type="button" class="btn-link" data-toggle="modal" data-target="#editMessage<?= $message->messageID ?>">
            Edit
          </button>
          <a href="<?= URL ?>admin/delete_message?messageID=<?= $message->messageID ?>" class="btn-link">Delete</a>
        </td>
      </tr>
      <? require APP . 'view/admin/edit_message.php'; ?>
    <?php } ?>
  </tbody>
  </table>

  <h4 class="mb-3">List of Photo Collections <span class="text-muted"><?= count($collections) ?></span></h4>
  <table class="table table-hover">
  <tbody>
    <?php foreach ($collections as $collection) { ?>
      <tr>
        <th scope="row"><?= $collection->collectionID ?></th>
        <td>User <?= $collection->userID ?></td>
        <td><?= $collection->uploadRights ?></td>
        <td><?= $collection->viewRights ?></td>
      </tr>
    <?php } ?>
  </tbody>
  </table>

  <h4 class="mb-3">List of Photos <span class="text-muted"><?= count($photos) ?></span></h4>
  <table class="table table-hover">
  <tbody>
    <?php foreach ($photos as $photo) { ?>
      <tr>
        <th scope="row"><?= $photo->photoID ?></th>
        <td>Collection <?= $photo->collectionID ?></td>
        <td>User <?= $photo->userID ?></td>
        <td><?= $photo->path ?></td>
      </tr>
    <?php } ?>
  </tbody>
  </table>

  <h4 class="mb-3">List of Comment <span class="text-muted"><?= count($comments) ?></span></h4>
  <table class="table table-hover">
  <tbody>
    <?php foreach ($comments as $comment) { ?>
      <tr>
        <th scope="row"><?= $comment->commentID ?></th>
        <td>User <?= $comment->userID ?></td>
        <td>Photo <?= $comment->photoID ?></td>
        <td><?= $comment->content ?></td>
      </tr>
    <?php } ?>
  </tbody>
  </table>
</div>