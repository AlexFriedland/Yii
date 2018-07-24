<?php
  use yii\helpers\html;
 ?>
<h1>Welcome to the Homepage</h1>

<br><br>

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Category</th>
    </tr>
  </thead>
  <tbody>
    <tr class="table-active">
      <th scope="row">Active</th>
      <td>Column content</td>
      <td>Column content</td>
      <td>Column content</td>
      <td>
        <span><?= Html::a('View') ?></span>
        <span><?= Html::a('Update') ?></span>
        <span><?= Html::a('Delete') ?></span>
      </td>
    </tr>
  </tbody>
</table>
