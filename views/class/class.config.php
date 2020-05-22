<?php
class Tamplate {

    public function wrn_massage($massage, $msg_type){
        $_SESSION['msg_wrn'] = $massage;
	    $_SESSION['msg_type'] = $msg_type;
    }

    public function wrn_massage_show(){
        if(isset($_SESSION['msg_wrn'])):?>
            <div class="msg">
                    <!-- this h1 for condition in sweetalert if h1 result 11 then sweealert play -->
                    <h1 id="condition" class="d-none">11</h1>
                    <h1 id="msg_type" class="d-none"><?= $_SESSION['msg_type']; ?></h1>
                    <p id="msg" class="d-none">
                        <?php echo $_SESSION['msg_wrn'];
                        unset($_SESSION['msg_wrn']);?>
                    </p>
            
            </div>
        <?php endif;
    }
}

?>