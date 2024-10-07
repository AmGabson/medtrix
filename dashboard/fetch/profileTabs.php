<?php
include("../../include/config.php");

//get user info
$userid  = intval($_POST["userid"]);
$stmt = $pdo->prepare("SELECT * FROM users WHERE userid=:userid ");
$stmt->bindParam(":userid", $userid, PDO::PARAM_INT);
$stmt->execute();
$userinfo = $stmt->fetch();




if(isset($_POST["contentType"]) && $_POST["contentType"] =="security"){ 

// Get activity log Status
$stmt = $pdo->prepare("SELECT saveActivity FROM preference WHERE userid=:userid ");
$stmt->bindParam(":userid", $userid, PDO::PARAM_INT);
$stmt->execute();
$status = $stmt->fetch();

?>

<div class="card card-bordered">
<div class="card-inner-group">
<div class="card-inner">
<div class="between-center flex-wrap flex-md-nowrap g-3">
<div class="nk-block-text">
<h6>Save my Activity Logs 
<span class="statBg badge bg-<?php if($status["saveActivity"]=="yes"){echo 'primary';}else{echo 'danger';}?>">
&nbsp;<span id="actText"><?php if($status["saveActivity"]=="yes"){echo 'YES';}else{echo 'NO';}?></span>
</span>
</h6>
<p>You can save your all activity logs including unusual activity detected.</p>
</div>
<div class="nk-block-actions">
<ul class="align-center gx-3">
<li class="order-md-last">
<div class="custom-control custom-switch me-n2 checked">
<input type="checkbox" class="custom-control-input" <?php if($status["saveActivity"]=="yes"){echo 'checked';}?> id="activityLog">
<label class="custom-control-label" for="activityLog"></label></div>
</li>
</ul>
</div>
</div>
</div>
<div class="card-inner">
<div class="between-center flex-wrap flex-md-nowrap g-3">
<div class="nk-block-text">
<h6>Change Password</h6>
<p>Set a unique password to protect your account.</p>
</div>
<div class="nk-block-actions flex-shrink-sm-0">
<ul class="align-center flex-wrap flex-sm-nowrap gx-3 gy-2">

<li class="order-md-last"><div data-bs-toggle="modal" data-bs-target="#password-edit" class="btn btn-primary">Change Password</div></li>

<li><em class="text-soft text-date fs-12px">Last changed: <span id="pdate">
<?php if(empty($userinfo["passUpdateDate"])){ echo "Never";}else{echo date("M jS, Y", strtotime($userinfo["passUpdateDate"]));}?></span></em></li>
</ul>
</div>
</div>
</div>
<div class="card-inner">
<div class="between-center flex-wrap flex-md-nowrap g-3">
<div class="nk-block-text">
<h6>2FA Authentication <span class="badge bg-danger">Disabled</span></h6>
<p>Secure your account with 2FA security. When it is activated you will need to enter not only your password, but also a special code using app. You can receive this code by in mobile app. </p>
</div>
<div class="nk-block-actions"><a href="#" class="disabled btn btn-primary">Disable</a></div>
</div>
</div>
</div>
</div>









<div class="modal fade" role="dialog" id="password-edit">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
<div class="modal-content">
<a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
<div class="modal-body modal-body-md">

<!--PASSWORD FORM-->
<form class="col-md-10" style="margin: auto;">

<div class="card-box">
<h4 align="center" id="wlcm">Update Password</h4><br>

<div id="Pwresult"></div>
<div class="form-group">
<label for="oldPassword"><i class="fas fa-user"></i> Old Password</label>
<div class="col-sm-12">
<input type="text" name="oldPassword" class="p-2 form-control" id="oldPassword" placeholder="Enter your current password">
</div>
</div>

<div class="form-group">
<label for="password"><i class="fas fa-key"></i> New password</label>
<div class="col-sm-12">
<input type="password" name="password" class="p-2 form-control" id="password" placeholder="Enter new password">
</div>
</div>

<div class="form-group">
<label for="ConfirmPassword"><i class="fas fa-key"></i> Confirm password</label>
<div class="col-sm-12">
<input type="password" name="ConfirmPassword" class="form-control p-2" id="ConfirmPassword" placeholder="Comfirm password">
</div>
</div>


<div class="col-12">
<ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2 pt-2">
<li>
<button class="btn btn-lg btn-primary update" type="button" id="updatePass">
<span>Update Password</span> &nbsp; &nbsp; 
<span class="spinner-border spinner-border-sm display-none spinLoader"></span>
</button>

</li>
<li>
<a href="#" data-bs-dismiss="modal" class="btn btn-danger btn-dim">Cancel</a>
</li>
</ul>
</div>


</div>
</form>

<!--PASSWORD FORM-->

</div>
</div>
</div>
</div>


<script>
$(".nk-block-title").html("Security Settings");
$(".nk-block-des").html("These settings helps you keep your account secure.");



// Update Password
$("#updatePass").click(function(e){
	 e.preventDefault();
	 
		let updatePass = "updatePass";
			
		let oldPassword = $("#oldPassword").val();
		let password = $("#password").val();
		let ConfirmPassword = $("#ConfirmPassword").val();
		

		$.ajax({
			url:'function.php',
			method:'POST',
			data:{updatePass:updatePass, password:password, ConfirmPassword:ConfirmPassword, oldPassword:oldPassword},
			beforeSend:function(){
                //nprogress
                NProgress.start();

                $(".spinLoader").removeClass("display-none");
                $("#updatePass").prop("disabled", true);
            },
			success:function(data){
				$("#Pwresult").html(data);
				
                $(".spinLoader").addClass("display-none");
                $("#updatePass").prop("disabled", false);

                //nprogress
                NProgress.done();
				
			}
		});
		
		});






//// SAVE UNSAVE ACTIVITY LOG
$("#activityLog").click(function(){

// If checked
if($("#activityLog").prop("checked")){
    
let activityLog = "toggle";
let value = "yes";

$.ajax({
    url:"function.php",
    method:"POST",
    data: {value:value,activityLog:activityLog},
    beforeSend:function(){
        $(".actLoader").removeClass("display-none");
    },   
    success:function(data){
            
        //hide Loader
        $(".actLoader").addClass("display-none");
        
        //result
        $(".result").html(data);
        console.log(data);
}
});

}else{
    


    //If unchecked
let activityLog = "toggle";
let value = "no";

$.ajax({
    url:"function.php",
    method:"POST",
    data: {value:value,activityLog:activityLog},
    beforeSend:function(){
        $(".actLoader").removeClass("display-none");
    },   
    success:function(data){
            
        //hide Loader
        $(".actLoader").addClass("display-none");
        
        //result
        $(".result").html(data);
        console.log(data);
}
});
}
});



</script>

<?php }

// End Security Tab














// // START Activity Tab
elseif(isset($_POST["contentType"]) && $_POST["contentType"] =="activity"){
    
    $stmt = $pdo->prepare("SELECT * FROM activities WHERE userid=:userid ORDER BY id DESC");
    $stmt->bindParam(":userid", $userid, PDO::PARAM_STR);
    $stmt->execute();
    if($stmt->rowCount() < 1){
        echo '<h3 class="text-center mt-5 mb-5 pb-5 text-gray">NO SAVED ACTIVITY</h3>';
    }
    $getActivities = $stmt->fetchAll();    
    foreach($getActivities  as $activity){
    $device = explode(' ', $activity["os"]);
    ?>


<div class="nk-iv-scheme-item Row_<?php echo intval($activity["id"]);?>">
<div class="nk-iv-scheme-icon is-running"><em class="icon ni <?php echo $activity["icon"];?>"></em></div>
<div class="nk-iv-scheme-info">
<div class="nk-iv-scheme-name pt-1"> 
<div class="sub-text" style="margin-top: -17px;position: absolute;font-weight:400;font-size: 11px;">
<?php  echo date("M jS, Y - h:i a", strtotime($activity["dateTime"]));?>
</div>
<?php echo htmlspecialchars($activity["browser"] ." on ".$device[0]);?>
</div>
<div class="nk-iv-scheme-desc">
<span class="amount">IP - </span><?php echo htmlspecialchars($activity["ip"]);?>
</div>
</div>

<div class="nk-iv-scheme-amount">
<div class="nk-iv-scheme-amount-b nk-iv-scheme-order">
<span class="nk-iv-scheme-label text-soft">OS Version</span>
<span class="nk-iv-scheme-value amount"><?php echo htmlspecialchars($activity["os"]);?> </span>
</div>
</div>

<div class="nk-iv-scheme-more">
<button class="btn btn-icon btn-lg btn-round delActivity" id="<?php echo intval($activity["id"]);?>">
<em class="icon ni ni-cross"></em></button>
</div>
<div class="nk-iv-scheme-progress">
<div class="progress-bar" data-progress="25" style="width: 25%;"></div>
</div>
</div>

<?php }?>

<script>
$(".nk-block-title").html("Recent Activity");
$(".nk-block-des").html("This information about the last login activity on your account.");









//  Delete Acytivity
$(".delActivity").click(function(){

let delActivity = this.id;

$.ajax({
type: 'POST',
url: 'function.php',
data: {delActivity:delActivity},
beforeSend:function(){
   // NLoader show
   NProgress.start();
},
success: function(data){

    // NLoader hide
    NProgress.done();

    console.log(data);
    
// FadeOut Row
if(data == 1){
$(".Row_"+delActivity).fadeOut(function(){
    $(".Row_"+delActivity).remove();
});
}

}
});

});


</script>


<?php }
// End Activity Tab
















// Notifications Tab
elseif(isset($_POST["contentType"]) && $_POST["contentType"] =="notifications"){

//count all
$stmt=$pdo->prepare("SELECT COUNT(*) AS count FROM notifications WHERE userid = :userid
AND (type IS NULL || type='received')");
$stmt->bindParam("userid", $userid, PDO::PARAM_STR);
$stmt->execute();
$getAll = $stmt->fetch();

//Get All notifications
$stmt=$pdo->prepare("SELECT * FROM notifications WHERE userid = :userid 
AND (type IS NULL || type='received') ORDER BY id DESC ");
$stmt->bindParam("userid", $userid, PDO::PARAM_STR);
$stmt->execute();
$cntNoti = $stmt->rowCount();
$notis=$stmt->fetchAll();

foreach($notis as $noti){?>

<style>
    .dark-mode .alert{
        color: #b6c6e4!important;
    }
.N-active::before{
    content: '';
    background: #63f19c;
    height: 10px;
    width: 10px;
    border-radius: 50%;
    position: absolute;
    top: -5px;
    left: -5px;
    border:1px solid #fff;
}
</style>


<div class="<?php if($noti["status"]=='unread'){echo 'N-active';}?> alert mb-2 bg-<?php echo $noti["color"];?>-dim alert-dismissible alert-icon">
<em class="icon ni <?php echo $noti["icon"];?>"></em><?php echo $noti["title"];?>
<?php if($noti["type"]=='received'){echo "&nbsp;&nbsp; <a href='contact.php'><b>Open</b></a>";}?>
<button class="close delNotification" data-id="<?php echo $noti["id"];?>" data-bs-dismiss="alert">
</button>
</div>

<?php } ?>

<button class="btn btn-primary markRead mt-3">
<span class="readText">Mark All as Read</span>
<span class="readLoad display-none">
<div class="spinner-border spinner-border-sm" role="status">
<span class="visually-hidden">Loading...</span></div>
</span>
</button>

<script>
$(".nk-block-title").html("Notifications(<?php echo $getAll['count']?>)");
$(".nk-block-des").html("Access and modify all notifications");



    //  Delete Notification
    $(".delNotification").click(function(){

        let delNotification = $(this).data("id");
    
    $.ajax({
    type: 'POST',
    url: 'function.php',
    data: {delNotification:delNotification},
    // beforeSend:function(){
    //     $(".Aload"+delNotification).removeClass("display-none");
    // },
    success: function(data){
        console.log(data);
    }
    });

    });



    //mark all as read
     $(".markRead").click(function(e){
             e.preventDefault();
             
             let markRead = "read";
     
             $.ajax({
             type: 'POST',
             url: 'function.php',
             data: {markRead:markRead},
             beforeSend:function(){
                //nprogress
                NProgress.start();
              
             $(".readText").addClass("display-none");
             $(".readLoad").removeClass("display-none");
             },
             success: function(data){
             $(".readText").removeClass("display-none");
             $(".readLoad").addClass("display-none");
     
             $(".request").html(data);
             console.log(data);
             
                //nprogress
                NProgress.done();
     
             }
             });
     });
     
</script>



<?php }
// Notifications Tab