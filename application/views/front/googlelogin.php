<!-- ==================== One-Tap Gamil Login API ================== -->
<!-- check if the user is not logged in -->
<?php 
//   $google_oauth_client_id = "77606373523-cntm8ntmoe1t8f9ch5e8lgpdan2hri2g.apps.googleusercontent.com";
$google_oauth_client_id = "77606373523-ibe867jnur5h6grj5d4vit9a4sim5ksn.apps.googleusercontent.com";

?>
<!-- display the login prompt -->
<?php if(!isset($_SESSION['loginwithgoogle'])){?>
<script src="https://accounts.google.com/gsi/client" async defer></script>
<?php }?>
<div id="g_id_onload" data-client_id="<?php echo $google_oauth_client_id; ?>" data-context="signin"
    data-callback="googleLoginEndpoint" data-close_on_tap_outside="false">
</div>
<script>
// callback function that will be called when the user is successfully logged-in with Google
function googleLoginEndpoint(googleUser) {
    // get user information from Google
    // console.log(googleUser);

    // send an AJAX request to register the user in your website
    var ajax = new XMLHttpRequest();

    // path of server file
    var url = "<?php echo base_url('googlelogin/loginwithgoogle');?>"
    ajax.open("POST", url, true);

    // callback when the status of AJAX is changed
    ajax.onreadystatechange = function() {

        // when the request is completed
        if (this.readyState == 4) {

            // when the response is okay
            if (this.status == 200) {
                console.log(this.responseText);
                // window.location.href='my_account.php';
                // location.reload();
            }

            // if there is any server error
            if (this.status == 500) {
                console.log(this.responseText);
            }
        }
    }

    // send google credentials in the AJAX request
    var formData = new FormData();
    formData.append("id_token", googleUser.credential);
    ajax.send(formData);
}
</script>