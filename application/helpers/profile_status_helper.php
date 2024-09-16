<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


/**
 * This function is used to print the content of any data
 */




 // Client profile status function
 function client_profile_status($id){
                
    $CI = get_instance();
    $query = $CI->db->select('*')

    ->from('clint')

    ->where('id', $id)

    ->get();
    if ($query->num_rows() > 0) {
            $result = $query->result();
            $clientData=$result[0];
            $profileStatus=30;
            if($clientData !=''){
                    $totalStep = 0;
                    if($clientData->email !=''){
                    $profileStatus=$profileStatus+30;
                    $totalStep++;
                   
                    }
                    if($clientData->gender !=''){
                    $profileStatus=$profileStatus+10;
                    $totalStep++;
                   
                    }
                    if($clientData->image !=''){
                        $profileStatus=$profileStatus+15;
                        $totalStep++;
                    }
                    if($clientData->about!=''){
                        $profileStatus=$profileStatus+10;
                    }

                    if($totalStep == 3){
                        $profileStatus = 100;
                    }

                    

                    $CI->session->set_userdata('profile_complete', $profileStatus);
                    $CI->session->set_userdata('img', "https://insaaf99.com/".$clientData->image);

                    $data['profile_complete']=$profileStatus;
                    $CI->db->where('id', $id);
                    $CI->db->update('clint', $data);
                    $updated_status = $CI->db->affected_rows();
                

                    return $profileStatus;
                }
           } else {
            return $profileStatus;
        }
}

//    Lawyer profile status function
        function lawyer_profile_status($id,$redirectStatus = true){
                
            $CI = get_instance();
            $query = $CI->db->select('*')->from('lawyer')->where('id', $id)->get();
            $lawyer_scheduler = $CI->db->select('*')->from('lawyer_scheduler')->where('lawyer_id', $id)->get();

            $lawyerSchedulerData='';
            $profileStatus=30;
            if ($lawyer_scheduler->num_rows() > 0) {

                $lawyerSchedulerData= $lawyer_scheduler->result();
            }
     
             if ($query->num_rows() > 0) {
             $result = $query->result();
              $lawyerData=$result[0];
             

             if($lawyerData !=''){
                    // Activate var
                    $activateCount = 0;

                   // stape 1
                    // check category
                   
                    if($lawyerData->category !=''){
                        $profileStatus=$profileStatus+16; // 46
                        $activateCount++;
                    }else  if($lawyerData->profile_complete =='' && $lawyerData->status == 0 && $redirectStatus ){
                        header("Location:".base_url('lawyer/profile/edit?action=update_category&action2=complete_profile'));
                        exit;
                    }

                       // stape 2
                    if($lawyerData->email !=''){
                      $profileStatus=$profileStatus+20; // 66
                      $activateCount++;
                    }else  if($lawyerData->email =='' && $lawyerData->status == 0 && $redirectStatus){
                        header("Location:".base_url('lawyer/profile/edit?action=verify_email'));
                        exit;
                    } 
                 

                    
                    // stape 3
                  
                    // if($lawyerSchedulerData !=''){
                    //     $profileStatus=$profileStatus+6;
                    //     $activateCount++;
                    // }
                    // else  if($lawyerSchedulerData =='' && $lawyerData->status == 0 && $redirectStatus){
                    //     header("Location:".base_url('lawyer/my_scheduler?action=complete_profile'));
                    //     exit;
                    // }//66

                    // verification id
                   
                    if($lawyerData->enrol_image !=''){
                        $activateCount ++;
                    }else if($lawyerData->enrol_image =='' && $lawyerData->status == 0 && $redirectStatus){
                        header("Location:".base_url('lawyer/profile/edit?action=verification_doc'));
                        exit;
                    }
                   
                    // stape 4
                    if($lawyerData->enrol_image !=''){
                        $profileStatus=$profileStatus+5;
                    }//71
                    if($lawyerData->about!=''){
                        $profileStatus=$profileStatus+3;
                    }//74
                    if($lawyerData->address!=''){
                        $profileStatus=$profileStatus+3;
                    }//77
                    if($lawyerData->practice_area!=''){
                        $profileStatus=$profileStatus+4;
                    }//81
                    if($lawyerData->bar_councle!=''){
                        $profileStatus=$profileStatus+4;
                    }//85


                    if($lawyerData->lawyer_img !=''){
                        $profileStatus=$profileStatus+3;
                    }//88

                    if($lawyerData->gender !=''){
                        $profileStatus=$profileStatus+3;
                    }//91

                    if($lawyerData->experience!=''){
                        $profileStatus=$profileStatus+7;
                    }//98

                    

                    if($activateCount == 4 && $lawyerData->status == 0){
                        $data['status'] = 2;
                        $CI->session->set_userdata('status', 2);
                    }
                  

                    $CI->session->set_userdata('profile_complete', $profileStatus);
                    $CI->session->set_userdata('img', base_url().$lawyerData->image);
                    // $CI->session->set_userdata('img', "https://insaaf99.com/".$lawyerData->image);

                    $data['profile_complete']=$profileStatus;
                    $CI->db->where('id', $id);
                    $CI->db->update('lawyer', $data);
                    $updated_status = $CI->db->affected_rows();

                    return $profileStatus;
              }
            } else {
                return $profileStatus;
            }
        }

  

  


?>