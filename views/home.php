<?php 
require_once(ROOT .'views/class/class.user.php');

$query = new User;

if(isset($_POST['content_post'])){
    

    $insert = $query->post_insert(
        $_POST['content_title'],
        $_POST['content_body'],
        $_POST['user_id']);
        if($insert){
            header('location: home');
            exit();
        }else{
            echo 'Something Wrong';
        }
    
}




require_once(ROOT . 'views/nav.php');
?>


<div class="container uk-margin-small-top">

    <div class="row">
        <div class="col-md-3 left-siderbar">
            <div class="profile">

                    <div class="uk-card uk-card-secondary uk-card-hover uk-card-body uk-light">
                        <h3 class="uk-card-title"><?= $_SESSION['user_name'] ?></h3>
                    </div>
            </div>

            <div class="post uk-margin-small-top">
                <form action="home" method="POST">
                    <fieldset class="uk-fieldset">

                        <div class="uk-margin">
                            <input name="content_title" class="uk-input" type="text" placeholder="Title">
                            <input name="user_id" type="hidden" value="<?= $_SESSION['user_id']; ?>">
                        </div>
                        <div class="uk-margin">
                            <textarea name="content_body" class="uk-textarea" rows="5" placeholder="Whats on your mind..."></textarea>
                        </div>
                        <button name="content_post" class="uk-button uk-button-primary">POST</button>
                    </fieldset>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <?php $content = $query->get_post($_SESSION['user_id']); 
                foreach($content as $value):?>

            <div class="uk-card uk-card-default uk-width-1-1@m">
                <div class="uk-card-header">
                    <div class="uk-grid-small uk-flex-middle" uk-grid>
                        <div class="uk-width-auto">
                            <img class="uk-border-circle" width="40" height="40" src="<?= ROOT ?>assets/userdata/<?= $_SESSION['profilePic']?>">
                        </div>
                        <div class="uk-width-expand">
                            <h3 class="uk-card-title uk-margin-remove-bottom"><?= $value['blog_title']; ?></h3>
                            <p class="uk-text-meta uk-margin-remove-top"><time ><?= $value['blog_time']; ?></time></p>
                        </div>
                        </div>
                </div>
                <div class="uk-card-body"> <?= $value['blog_content']; ?> </p>
                </div>
                <div class="uk-card-footer">
                    <a href="#" class="uk-button uk-button-text">Read more</a>
                </div>
            </div>
                <?php endforeach; ?>
        </div>

        <div class="col-md-3">
            <div class="issue border">
            <p class="uk-heading-bullet">Heading Bullet</p>
            </div>
        </div>
    </div>

</div>