<?php

use yii\db\Migration;

/**
 * Class m180731_133234_init_rbac
 */
class m180731_133234_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
      $auth = Yii::$app->authManager;

      //add 'createPost' permission
      $createPost = $auth->createPermission('createPost');
      $createPost->description = 'Create Post';
      $auth->add($createPost);

      //add 'updatePost' permission
      $updatePost = $auth->createPermission('updatePost');
      $updatePost->description = 'Update post';
      $auth->add($updatePost);

      //add 'author role and give role the 'createPost' permission
      $author = $auth->createRole('author');
      $auth->add($author);
      $auth->addChild($author, $createPost);

      // add 'admin' role and give role the 'updatePost' permission
      // as well as permissions of the author role
      $admin = $auth->createRole('admin');
      $auth->add($admin);
      $auth->addChild($admin, $updatePost);
      $auth->addChild($admin, $author);

      // assign roles to users. 1 + 2 are IDs returned by IdentityInterface::getId()
      //usually implemented in User model
      $auth->assign($author, 2);
      $auth->assign($admin, 1);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "This used to say 'this migration can't be reverted\n";
        echo "Now it's set to assign $auth to authManager, and $auth->removeAll\n";

        $auth->removeAll();

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180731_133234_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}
