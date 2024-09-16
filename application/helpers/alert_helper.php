<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('test_method'))
{
    function show_alert($type = '', $msg= '')
    {
        $strSuccess = '<div class="alert alert-success a_success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> ##msg##</div>';
        $strError = '<div class="alert alert-danger a_danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> ##msg##</div>';
        $strWarning = '<div class="alert alert-warning a_warning"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>##msg##</div>';

        if($type=="success"){
        	$msg= str_replace('##msg##', $msg, $strSuccess);
        }elseif($type=="error"){
        	$msg= str_replace('##msg##', $msg, $strError);
        }elseif($type=="warning"){
        	$msg= str_replace('##msg##', $msg, $strWarning);
        }
        echo $msg;
    }   
}

?>