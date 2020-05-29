<?php 
require_once(ROOT .'views/class/class.user.php');

if(isset($_POST['content_post'])){
    $query = new User;

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
        <div class="col-md-3">
            <div class="profile">

                    <div class="uk-card uk-card-secondary uk-card-hover uk-card-body uk-light">
                        <h3 class="uk-card-title">Shanto Rahman</h3>
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

            <div class="uk-card uk-card-default uk-width-1-1@m">
                <div class="uk-card-header">
                    <div class="uk-grid-small uk-flex-middle" uk-grid>
                        <div class="uk-width-auto">
                            <img class="uk-border-circle" width="40" height="40" src="<?= HOME ?>assets/userdata/96792947_555345935358592_6093595841744863232_n.jpg">
                        </div>
                        <div class="uk-width-expand">
                            <h3 class="uk-card-title uk-margin-remove-bottom">Title</h3>
                            <p class="uk-text-meta uk-margin-remove-top"><time datetime="2016-04-01T19:00">April 01, 2016</time></p>
                        </div>
                            <form action="">                       
                            </form>
                        </div>
                </div>
                <div class="uk-card-body">
                    <p>Lorem ipsum dolor sit amet, consectetur Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quidem asperiores est quo aliquam pariatur odit repellat temporibus qui molestias sapiente hic necessitatibus impedit explicabo, libero expedita suscipit culpa laudantium nam? adipiscing elit, sed do eiusmod tempor incididunt.</p>
                </div>
                <div class="uk-card-footer">
                    <a href="#" class="uk-button uk-button-text">Read more</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="issue border">
            <p class="uk-heading-bullet">Heading Bullet</p>
            </div>
        </div>
    </div>

</div>