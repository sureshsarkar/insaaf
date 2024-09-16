<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
class Newpage extends BaseController
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('base_library');
        $this->load->model('admin/blogs_model');
        $this->load->model('admin/Category_model');
        $this->load->model('admin/Latest_News_model');
        $this->load->model('lawyer/slot_model');
        $this->load->model('admin/dictionary_model');
        // Cookie helper
        $this->load->helper('cookie');
        $lang='';
         if(!empty($_COOKIE['lang']) && isset($_COOKIE['lang'])){
          $lang=$_COOKIE['lang'];
         }else{
          $lang=config_item('language');
         }
        $this->lang->load('menu',$lang);
     }


    // Index =============================================================
    public function index()
    {

      $data1['table']  = 'category';
      $data1['id']     = '-id'; // Desc when - add
      $data1['limit']     = '20'; // Desc when - add
      $data['categoryMenu']      = $this->getCategory($data1); 
 
      // Fetch Latest news data from ddatabase
        $where               = array();
        $where['orderby']    ='-1';
        $where['limit']    ='4';
        $where['status']    ='1';
        $data['latest_news'] = $this->Latest_News_model->findDynamic($where);
    //  ================================
       $data["title"]="Hire Online Lawyer for Legal Consultation/Advice in India | Insaaf99";
       $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, free legal advice, legal response, law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";
       $data["description"]="Get Online lawyer or advocate for legal consultation/advice in India. Consult a professional lawyer on phone to resolve your legal query 24/7 for family law, divorce, criminal law, cheque bounce, property, child custody, consumer matters, matrimony and many more.";
       $data["og_url"]="https://insaaf99.com";
       $data["og_title"]="Hire Online Lawyer for Legal Consultation/Advice in India | Insaaf99";
       $data["og_description"]="Get Online lawyer or advocate for legal consultation/advice in India. Consult a professional lawyer on phone to resolve your legal query 24/7 for family law, divorce, criminal law, cheque bounce, property, child custody, consumer matters, matrimony and many more.";
       $data["og_site_name"]="insaaf99.com";
       $data["twitter_card"]="summary";
       $data["twitter_title"]="Hire Online Lawyer for Legal Consultation/Advice in India | Insaaf99";
       $data["twitter_description"]="Get Online lawyer or advocate for legal consultation/advice in India. Consult a professional lawyer on phone to resolve your legal query 24/7 for family law, divorce, criminal law, cheque bounce, property, child custody, consumer matters, matrimony and many more.";
       $data["canonical"]="https://insaaf99.com";


    // ==============================
       $data["file"]="front/newpage";
       $this->load->view('front/template',$data);
    } 

    // public function sitemap()
    // {

  
    //    $data["title"]="All News";
    //    $data["file"]="front/sitemap.xml";
    //    $this->load->view('front/template',$data);
    // } 

    public function allnews()
    {
 

        $data1['table']  = 'category';
        $data1['id']     = '-id'; // Desc when - add
        $data1['limit']     = '20'; // Desc when - add
        $data['categoryMenu']      = $this->getCategory($data1); 


 
      // Fetch Latest news data from ddatabase
        $where               = array();

        if (isset($_GET['search']) && $_GET['search']!='') {
          $word = $_GET['search'];
          $likeArr = array(
            "descreption"=>$word,
            "news_cat"=>$word,
            "expert_hi"=>$word,
            "descreption_hi"=>$word,
            "expert"=>$word
          );
          $where['like']    = json_encode($likeArr);
        }


        // echo $word; die();
        $where['orderby']    ='-1';
        $where['status']    ='1';
        $data['latest_news'] = $this->Latest_News_model->findDynamic($where);


  
        
        $data["title"]="All Latest News And Judgement | Insaaf99";
        $data["keywords"]="All Latest News And Judgement";
        $data["description"]="All latest news related to supreme court, delhi high court judgment.";
        $data["og_url"]="https://insaaf99.com/all-news";
        $data["og_title"]="All Latest News And Judgement | Insaaf99";
        $data["og_description"]="All latest news related to supreme court, delhi high court judgment";
        $data["og_site_name"]="insaaf99.com";
        $data["twitter_card"]="summary";
        $data["twitter_title"]="All Latest News And Judgement | Insaaf99 ";
        $data["twitter_description"]="All latest news related to supreme court, delhi high court judgment.";
        $data["canonical"]="https://insaaf99.com/all-news";

       
       $data["file"]="front/allnews";
       $this->load->view('front/template',$data);
    } 
    

    public function searchNews(){
       if(isset($_POST['search']) && !empty($_POST['search'])){
        $search =$_POST['search'];
        $sql ='';
        $sql .="SELECT * FROM `news` ";
        $sql .="WHERE `news_cat` LIKE '%{$search}%' OR `descreption` LIKE '%{$search}%'";

        $result = $this->Latest_News_model->rawquery($sql);
     if(!empty($result)){
        echo json_encode(array('result'=>$result[0]));  
      exit();
     }else{
      echo 2;
      exit();
     }


       }
    }


    public function News($slug)
    {
     
      $data1['table']  = 'category';
      $data1['id']     = '-id'; // Desc when - add
      $data1['limit']     = '20'; // Desc when - add
      $data['categoryMenu']      = $this->getCategory($data1); 
     
        $where['slug_url']    =$slug;
        $da= $this->Latest_News_model->findDynamic($where);
     
      
        if(isset($da) && !empty($da)){
        if($da[0]->slug_url=="bombay-high-court-imposes-25k-fine-on-state-for-registering-fir-against-9-year-old-quashes-case"){
           
      $data["title"]="Bombay High Court imposes ?25k fine on State for registering FIR against 9-year-old, quashes case";
      $data["description"]="Bombay High Court imposes ₹25k fine on State for registering FIR against 9-year-old, quashes case · Bombay High Court";

      $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, free legal advice, legal response, law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";

      $data["og_url"]="https://insaaf99.com/latest-news/bombay-high-court-imposes-25k-fine-on-state-for-registering-fir-against-9-year-old-quashes-case";

      $data["og_title"]="Bombay High Court imposes ?25k fine on State for registering FIR against 9-year-old, quashes case";

      $data["og_description"]="Bombay High Court imposes ₹25k fine on State for registering FIR against 9-year-old, quashes case · Bombay High Court";

      $data["og_site_name"]="insaaf99.com";

      $data["twitter_card"]="summary";

      $data["twitter_title"]="Bombay High Court imposes ?25k fine on State for registering FIR against 9-year-old, quashes case";

      $data["twitter_description"]="Bombay High Court imposes ₹25k fine on State for registering FIR against 9-year-old, quashes case · Bombay High Court";

      $data["canonical"]="https://insaaf99.com/latest-news/bombay-high-court-imposes-25k-fine-on-state-for-registering-fir-against-9-year-old-quashes-case";
     
      }
      elseif($da[0]->slug_url=='after-issuance-of-notice-under-41-a-crpc-police-cannot-arrest-without-magistrate-s-permission-rules-telangana-high-court'){
        $data["title"]="After Issuance of Notice Under 41-A CrPC Police Cannot Arrest Without Magistrate’s Permission, Rules Telangana High Court";
        $data["description"]="";
  
        $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, free legal advice, legal response, law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";
  
        $data["og_url"]="https://insaaf99.com/latest-news/after-issuance-of-notice-under-41-a-crpc-police-cannot-arrest-without-magistrate-s-permission-rules-telangana-high-court";
  
        $data["og_title"]="After Issuance of Notice Under 41-A CrPC Police Cannot Arrest Without Magistrate’s Permission, Rules Telangana High Court";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="summary";
  
        $data["twitter_title"]="After Issuance of Notice Under 41-A CrPC Police Cannot Arrest Without Magistrate’s Permission, Rules Telangana High Court";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/after-issuance-of-notice-under-41-a-crpc-police-cannot-arrest-without-magistrate-s-permission-rules-telangana-high-court";

      }
      elseif($da[0]->slug_url=='supreme-court-if-adopted-child-was-not-dependant-on-the-government-servant-prior-to-his-death-is-not-entitled-to-family-pension-under-the-definition-of-family-under-rule-54-14-b-of-the-ccs-pension-rules'){
        $data["title"]="Supreme Court- If Adopted Child was not dependant on the government servant prior to his death is not entitled to Family Pension under the definition of ‘family’ under Rule 54(14)(b) of the CCS (Pension) Rules";
        $data["description"]="";
  
        $data["keywords"]="";
  
        $data["og_url"]="https://insaaf99.com/latest-news/supreme-court-if-adopted-child-was-not-dependant-on-the-government-servant-prior-to-his-death-is-not-entitled-to-family-pension-under-the-definition-of-family-under-rule-54-14-b-of-the-ccs-pension-rules";
  
        $data["og_title"]="Supreme Court- If Adopted Child was not dependant on the government servant prior to his death is not entitled to Family Pension under the definition of ‘family’ under Rule 54(14)(b) of the CCS (Pension) Rules";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="";
  
        $data["twitter_title"]="Supreme Court- If Adopted Child was not dependant on the government servant prior to his death is not entitled to Family Pension under the definition of ‘family’ under Rule 54(14)(b) of the CCS (Pension) Rules";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/supreme-court-if-adopted-child-was-not-dependant-on-the-government-servant-prior-to-his-death-is-not-entitled-to-family-pension-under-the-definition-of-family-under-rule-54-14-b-of-the-ccs-pension-rules";

      }
      elseif($da[0]->slug_url=='accused-relies-on-income-tax-returns-of-complainant-showing-lacked-financial-capacity-the-supreme-court-upholds-the-acquittal'){
        $data["title"]="Accused relies on income tax returns of complainant showing lacked financial capacity, the Supreme Court upholds the acquittal";
        $data["description"]="";
  
        $data["keywords"]="";
  
        $data["og_url"]="https://insaaf99.com/latest-news/accused-relies-on-income-tax-returns-of-complainant-showing-lacked-financial-capacity-the-supreme-court-upholds-the-acquittal";
  
        $data["og_title"]="Accused relies on income tax returns of complainant showing lacked financial capacity, the Supreme Court upholds the acquittal";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="";
  
        $data["twitter_title"]="Accused relies on income tax returns of complainant showing lacked financial capacity, the Supreme Court upholds the acquittal";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/accused-relies-on-income-tax-returns-of-complainant-showing-lacked-financial-capacity-the-supreme-court-upholds-the-acquittal";

      }
      elseif($da[0]->slug_url=='criminal-law-cannot-be-utilised-for-arm-twisting-or-money-recovery-bail-cannot-be-dependent-on-payment-of-money-supreme-court'){
        $data["title"]="Criminal Law cannot be utilised for arm twisting or money recovery. Bail cannot be dependent on payment of money-Supreme Court";
        $data["description"]="";
  
        $data["keywords"]="";
  
        $data["og_url"]="https://insaaf99.com/latest-news/criminal-law-cannot-be-utilised-for-arm-twisting-or-money-recovery-bail-cannot-be-dependent-on-payment-of-money-supreme-court";
  
        $data["og_title"]="Criminal Law cannot be utilised for arm twisting or money recovery. Bail cannot be dependent on payment of money-Supreme Court";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="";
  
        $data["twitter_title"]="Criminal Law cannot be utilised for arm twisting or money recovery. Bail cannot be dependent on payment of money-Supreme Court";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/criminal-law-cannot-be-utilised-for-arm-twisting-or-money-recovery-bail-cannot-be-dependent-on-payment-of-money-supreme-court";

      }
      elseif($da[0]->slug_url=='delhi-hc-awards-costs-of-rs-20-lakh-to-louis-vuitton-in-trademark-violation-case-against-banned-chinese-e-shopping-portal-club-factory'){
        $data["title"]="Delhi HC awards costs of Rs 20 lakh to Louis Vuitton in trademark violation case against banned Chinese e-shopping portal Club Factory";
        $data["description"]="";
  
        $data["keywords"]="";
  
        $data["og_url"]="https://insaaf99.com/latest-news/delhi-hc-awards-costs-of-rs-20-lakh-to-louis-vuitton-in-trademark-violation-case-against-banned-chinese-e-shopping-portal-club-factory";
  
        $data["og_title"]="Delhi HC awards costs of Rs 20 lakh to Louis Vuitton in trademark violation case against banned Chinese e-shopping portal Club Factory";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="";
  
        $data["twitter_title"]="Delhi HC awards costs of Rs 20 lakh to Louis Vuitton in trademark violation case against banned Chinese e-shopping portal Club Factory";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/delhi-hc-awards-costs-of-rs-20-lakh-to-louis-vuitton-in-trademark-violation-case-against-banned-chinese-e-shopping-portal-club-factory";

      }
      elseif($da[0]->slug_url=='only-adequate-cause-qualifies-as-an-acceptable-excuse-for-a-delay-explains-section-5-of-limitation-act-held-a-party-cannot-be-held-accountable-if-given-sufficient-cause-supreme-court'){
        $data["title"]="Only adequate cause qualifies as an acceptable excuse for a delay. Explains Section 5 of Limitation Act, Held a party cannot be held accountable if given Sufficient Cause- Supreme Court";
        $data["description"]="";
  
        $data["keywords"]="";
  
        $data["og_url"]="https://insaaf99.com/latest-news/only-adequate-cause-qualifies-as-an-acceptable-excuse-for-a-delay-explains-section-5-of-limitation-act-held-a-party-cannot-be-held-accountable-if-given-sufficient-cause-supreme-court";
  
        $data["og_title"]="Only adequate cause qualifies as an acceptable excuse for a delay. Explains Section 5 of Limitation Act, Held a party cannot be held accountable if given Sufficient Cause- Supreme Court";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="";
  
        $data["twitter_title"]="Only adequate cause qualifies as an acceptable excuse for a delay. Explains Section 5 of Limitation Act, Held a party cannot be held accountable if given Sufficient Cause- Supreme Court";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/only-adequate-cause-qualifies-as-an-acceptable-excuse-for-a-delay-explains-section-5-of-limitation-act-held-a-party-cannot-be-held-accountable-if-given-sufficient-cause-supreme-court";

      }
      elseif($da[0]->slug_url=='communications-between-a-lawyer-and-client-made-during-the-employment-of-the-lawyer-is-a-privileged-communications-under-section-126-and-129-of-the-evidence-act-bombay-hc'){
        $data["title"]="Communications between a lawyer and client made during the employment of the lawyer is a privileged communications Under Section 126 and 129 of the Evidence Act: Bombay HC";
        $data["description"]="";
  
        $data["keywords"]="";
  
        $data["og_url"]="https://insaaf99.com/latest-news/communications-between-a-lawyer-and-client-made-during-the-employment-of-the-lawyer-is-a-privileged-communications-under-section-126-and-129-of-the-evidence-act-bombay-hc";
  
        $data["og_title"]="Communications between a lawyer and client made during the employment of the lawyer is a privileged communications Under Section 126 and 129 of the Evidence Act: Bombay HC";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="";
  
        $data["twitter_title"]="Communications between a lawyer and client made during the employment of the lawyer is a privileged communications Under Section 126 and 129 of the Evidence Act: Bombay HC";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/communications-between-a-lawyer-and-client-made-during-the-employment-of-the-lawyer-is-a-privileged-communications-under-section-126-and-129-of-the-evidence-act-bombay-hc";

      }
      elseif($da[0]->slug_url=='delhi-high-court-awarded-decree-of-permanent-injunction-in-favour-of-starbucks-restraining-the-lol-caf-from-infringing-and-or-passing-off-the-starbuck-s-registered-trade-mark-frappuccino-and-or-using-the-frappuccino-mark-including-the-brownie-ch'){
        $data["title"]="Delhi High Court awarded decree of permanent injunction In Favour of Starbucks restraining the LOL Café from infringing and/or passing off the Starbuck’s registered trade mark ‘FRAPPUCCINO’ and/or using the ‘FRAPPUCCINO’ mark, including the ‘BROWNIE Ch";
        $data["description"]="";
  
        $data["keywords"]="";
  
        $data["og_url"]="https://insaaf99.com/latest-news/delhi-high-court-awarded-decree-of-permanent-injunction-in-favour-of-starbucks-restraining-the-lol-caf-from-infringing-and-or-passing-off-the-starbuck-s-registered-trade-mark-frappuccino-and-or-using-the-frappuccino-mark-including-the-brownie-ch";
  
        $data["og_title"]="Delhi High Court awarded decree of permanent injunction In Favour of Starbucks restraining the LOL Café from infringing and/or passing off the Starbuck’s registered trade mark ‘FRAPPUCCINO’ and/or using the ‘FRAPPUCCINO’ mark, including the ‘BROWNIE Ch";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="";
  
        $data["twitter_title"]="Delhi High Court awarded decree of permanent injunction In Favour of Starbucks restraining the LOL Café from infringing and/or passing off the Starbuck’s registered trade mark ‘FRAPPUCCINO’ and/or using the ‘FRAPPUCCINO’ mark, including the ‘BROWNIE Ch";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/delhi-high-court-awarded-decree-of-permanent-injunction-in-favour-of-starbucks-restraining-the-lol-caf-from-infringing-and-or-passing-off-the-starbuck-s-registered-trade-mark-frappuccino-and-or-using-the-frappuccino-mark-including-the-brownie-ch";

      }
      elseif($da[0]->slug_url=='delhi-high-court-awarded-decree-of-permanent-injunction-in-favour-of-starbucks-restraining-the-lol-caf-from-infringing-and-or-passing-off-the-starbuck-s-registered-trade-mark-frappuccino-and-or-using-the-frappuccino-mark-including-the-brownie-ch'){
        $data["title"]="";
        $data["description"]="";
  
        $data["keywords"]="";
  
        $data["og_url"]="https://insaaf99.com/latest-news/delhi-high-court-awarded-decree-of-permanent-injunction-in-favour-of-starbucks-restraining-the-lol-caf-from-infringing-and-or-passing-off-the-starbuck-s-registered-trade-mark-frappuccino-and-or-using-the-frappuccino-mark-including-the-brownie-ch";
  
        $data["og_title"]="";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="";
  
        $data["twitter_title"]="";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/delhi-high-court-awarded-decree-of-permanent-injunction-in-favour-of-starbucks-restraining-the-lol-caf-from-infringing-and-or-passing-off-the-starbuck-s-registered-trade-mark-frappuccino-and-or-using-the-frappuccino-mark-including-the-brownie-ch";

      }
      elseif($da[0]->slug_url=='if-a-complaint-or-police-report-does-not-reveal-an-accused-person-s-involvement-in-a-crime-criminal-proceedings-may-be-quashed-according-to-the-supreme-court'){
        $data["title"]="If a complaint or police report does not reveal an accused person's involvement in a crime, criminal proceedings may be quashed, according to the Supreme Court";
        $data["description"]="";
  
        $data["keywords"]="";
  
        $data["og_url"]="https://insaaf99.com/latest-news/if-a-complaint-or-police-report-does-not-reveal-an-accused-person-s-involvement-in-a-crime-criminal-proceedings-may-be-quashed-according-to-the-supreme-court";
  
        $data["og_title"]="If a complaint or police report does not reveal an accused person's involvement in a crime, criminal proceedings may be quashed, according to the Supreme Court";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="";
  
        $data["twitter_title"]="If a complaint or police report does not reveal an accused person's involvement in a crime, criminal proceedings may be quashed, according to the Supreme Court";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/if-a-complaint-or-police-report-does-not-reveal-an-accused-person-s-involvement-in-a-crime-criminal-proceedings-may-be-quashed-according-to-the-supreme-court";

      }
      elseif($da[0]->slug_url=='supreme-court-sarfaesi-act-with-respect-to-the-secured-assets-would-prevail-over-the-recoveries-under-the-msmed-act-to-recover-the-amount'){
        $data["title"]="Supreme Court: SARFAESI Act with respect to the secured assets would prevail over the recoveries under the MSMED Act to recover the amount";
        $data["description"]="";
  
        $data["keywords"]="";
  
        $data["og_url"]="https://insaaf99.com/latest-news/supreme-court-sarfaesi-act-with-respect-to-the-secured-assets-would-prevail-over-the-recoveries-under-the-msmed-act-to-recover-the-amount";
  
        $data["og_title"]="Supreme Court: SARFAESI Act with respect to the secured assets would prevail over the recoveries under the MSMED Act to recover the amount";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="";
  
        $data["twitter_title"]="Supreme Court: SARFAESI Act with respect to the secured assets would prevail over the recoveries under the MSMED Act to recover the amount";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/supreme-court-sarfaesi-act-with-respect-to-the-secured-assets-would-prevail-over-the-recoveries-under-the-msmed-act-to-recover-the-amount";

      }
      elseif($da[0]->slug_url=='in-a-landmark-judgement-top-court-issued-guidelines-to-prevent-unnecessary-arrest-remand-and-stressed-upon-the-importance-of-the-rule-bail-over-jail'){
        $data["title"]="In a Landmark Judgement Top Court issued guidelines to prevent unnecessary arrest, remand and stressed upon the importance of the rule “Bail Over Jail”";
        $data["description"]="";
  
        $data["keywords"]="";
  
        $data["og_url"]="https://insaaf99.com/latest-news/in-a-landmark-judgement-top-court-issued-guidelines-to-prevent-unnecessary-arrest-remand-and-stressed-upon-the-importance-of-the-rule-bail-over-jail";
  
        $data["og_title"]="In a Landmark Judgement Top Court issued guidelines to prevent unnecessary arrest, remand and stressed upon the importance of the rule “Bail Over Jail”";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="";
  
        $data["twitter_title"]="In a Landmark Judgement Top Court issued guidelines to prevent unnecessary arrest, remand and stressed upon the importance of the rule “Bail Over Jail”";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/in-a-landmark-judgement-top-court-issued-guidelines-to-prevent-unnecessary-arrest-remand-and-stressed-upon-the-importance-of-the-rule-bail-over-jail";

      }
      elseif($da[0]->slug_url=='ncdrc-holds-the-landowner-and-developer-jointly-and-severally-liable-for-the-service-s-deficiency'){
        $data["title"]="NCDRC holds the landowner and developer jointly and severally liable for the service's deficiency";
        $data["description"]="";
  
        $data["keywords"]="";
  
        $data["og_url"]="https://insaaf99.com/latest-news/ncdrc-holds-the-landowner-and-developer-jointly-and-severally-liable-for-the-service-s-deficiency";
  
        $data["og_title"]="NCDRC holds the landowner and developer jointly and severally liable for the service's deficiency";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="";
  
        $data["twitter_title"]="NCDRC holds the landowner and developer jointly and severally liable for the service's deficiency";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/ncdrc-holds-the-landowner-and-developer-jointly-and-severally-liable-for-the-service-s-deficiency";

      }
      elseif($da[0]->slug_url=='supreme-court-permanent-injunction-cannot-be-sought-on-the-basis-of-an-unregistered-agreement-to-sell'){
        $data["title"]="Supreme Court: Permanent Injunction Cannot be sought on the basis of an unregistered agreement to sell";
        $data["description"]="";
  
        $data["keywords"]="";
  
        $data["og_url"]="https://insaaf99.com/latest-news/supreme-court-permanent-injunction-cannot-be-sought-on-the-basis-of-an-unregistered-agreement-to-sell";
  
        $data["og_title"]="Supreme Court: Permanent Injunction Cannot be sought on the basis of an unregistered agreement to sell";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="";
  
        $data["twitter_title"]="Supreme Court: Permanent Injunction Cannot be sought on the basis of an unregistered agreement to sell";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/supreme-court-permanent-injunction-cannot-be-sought-on-the-basis-of-an-unregistered-agreement-to-sell";

      }
      elseif($da[0]->slug_url=='delhi-high-court-removed-pakistani-roohafza-from-amazon'){
        $data["title"]="Delhi High Court removed Pakistani Roohafza from Amazon";
        $data["description"]="";
  
        $data["keywords"]="";
  
        $data["og_url"]="https://insaaf99.com/latest-news/delhi-high-court-removed-pakistani-roohafza-from-amazon";
  
        $data["og_title"]="Delhi High Court removed Pakistani Roohafza from Amazon";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="";
  
        $data["twitter_title"]="Delhi High Court removed Pakistani Roohafza from Amazon";
  
        $data["twitter_description"]="https://insaaf99.com/latest-news/delhi-high-court-removed-pakistani-roohafza-from-amazon";
  
        $data["canonical"]="delhi-high-court-removed-pakistani-roohafza-from-amazon";

      }
      elseif($da[0]->slug_url=='the-supreme-court-grants-interim-protection-via-anticipatory-bail-to-step-mother-in-protection-of-children-from-sexual-offences-act-pocos-act-and-offences-under-the-juvenile-justice-care-and-protection-of-children-case'){
        $data["title"]="The Supreme Court grants Interim Protection via Anticipatory Bail to Step Mother in Protection of Children from Sexual Offences Act (POCOS Act) and offences under the Juvenile Justice (Care and Protection of Children) Case";
        $data["description"]="";
  
        $data["keywords"]="";
  
        $data["og_url"]="https://insaaf99.com/latest-news/the-supreme-court-grants-interim-protection-via-anticipatory-bail-to-step-mother-in-protection-of-children-from-sexual-offences-act-pocos-act-and-offences-under-the-juvenile-justice-care-and-protection-of-children-case";
  
        $data["og_title"]="The Supreme Court grants Interim Protection via Anticipatory Bail to Step Mother in Protection of Children from Sexual Offences Act (POCOS Act) and offences under the Juvenile Justice (Care and Protection of Children) Case";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="";
  
        $data["twitter_title"]="The Supreme Court grants Interim Protection via Anticipatory Bail to Step Mother in Protection of Children from Sexual Offences Act (POCOS Act) and offences under the Juvenile Justice (Care and Protection of Children) Case";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/the-supreme-court-grants-interim-protection-via-anticipatory-bail-to-step-mother-in-protection-of-children-from-sexual-offences-act-pocos-act-and-offences-under-the-juvenile-justice-care-and-protection-of-children-case";

      }
      elseif($da[0]->slug_url=='section-319-crpc-apex-court-s-constitutional-bench-issued-12-guidelines-for-summoning-additional-defendants-during-trial'){
        $data["title"]="";
        $data["description"]="";
  
        $data["keywords"]="";
  
        $data["og_url"]="https://insaaf99.com/latest-news/section-319-crpc-apex-court-s-constitutional-bench-issued-12-guidelines-for-summoning-additional-defendants-during-trial";
  
        $data["og_title"]="Section 319 CrPC: Apex Court’s Constitutional Bench issued 12 Guidelines for Summoning Additional Defendants During Trial";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="";
  
        $data["twitter_title"]="Section 319 CrPC: Apex Court’s Constitutional Bench issued 12 Guidelines for Summoning Additional Defendants During Trial";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/section-319-crpc-apex-court-s-constitutional-bench-issued-12-guidelines-for-summoning-additional-defendants-during-trial";

      }
      elseif($da[0]->slug_url=='bilkis-bano-moves-supreme-court-against-release-of-11-convicts-cji-to-look-into'){
        $data["title"]="";
        $data["description"]="";
  
        $data["keywords"]="";
  
        $data["og_url"]="https://insaaf99.com/latest-news/bilkis-bano-moves-supreme-court-against-release-of-11-convicts-cji-to-look-into";
  
        $data["og_title"]="";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="";
  
        $data["twitter_title"]="";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/bilkis-bano-moves-supreme-court-against-release-of-11-convicts-cji-to-look-into";

      }
      elseif($da[0]->slug_url=='a-decree-of-possession-cannot-be-passed-in-favour-of-the-plaintiff-on-the-ground-that-defendant-have-not-been-able-to-fully-establish-their-right-title-and-interest-supreme-court'){
        $data["title"]="A decree of possession cannot be passed in favour of the plaintiff on the ground that defendant have not been able to fully establish their right, title and interest- Supreme Court";
        $data["description"]="";
  
        $data["keywords"]="";
  
        $data["og_url"]="https://insaaf99.com/latest-news/a-decree-of-possession-cannot-be-passed-in-favour-of-the-plaintiff-on-the-ground-that-defendant-have-not-been-able-to-fully-establish-their-right-title-and-interest-supreme-court";
  
        $data["og_title"]="A decree of possession cannot be passed in favour of the plaintiff on the ground that defendant have not been able to fully establish their right, title and interest- Supreme Court";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="";
  
        $data["twitter_title"]="A decree of possession cannot be passed in favour of the plaintiff on the ground that defendant have not been able to fully establish their right, title and interest- Supreme Court";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/a-decree-of-possession-cannot-be-passed-in-favour-of-the-plaintiff-on-the-ground-that-defendant-have-not-been-able-to-fully-establish-their-right-title-and-interest-supreme-court";

      }
      elseif($da[0]->slug_url=='supreme-court-directs-the-authority-to-pay-the-amount-of-compensation-to-the-land-owners-within-two-months-for-the-land-acquired-40-years-ago'){
        $data["title"]="Supreme Court directs the Authority to pay the amount of compensation to the Land owners within two months for the Land Acquired 40 years ago";
        $data["description"]="";
  
        $data["keywords"]="";
  
        $data["og_url"]="https://insaaf99.com/latest-news/supreme-court-directs-the-authority-to-pay-the-amount-of-compensation-to-the-land-owners-within-two-months-for-the-land-acquired-40-years-ago";
  
        $data["og_title"]="Supreme Court directs the Authority to pay the amount of compensation to the Land owners within two months for the Land Acquired 40 years ago";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="";
  
        $data["twitter_title"]="Supreme Court directs the Authority to pay the amount of compensation to the Land owners within two months for the Land Acquired 40 years ago";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/supreme-court-directs-the-authority-to-pay-the-amount-of-compensation-to-the-land-owners-within-two-months-for-the-land-acquired-40-years-ago";

      }
      elseif($da[0]->slug_url=='delhi-high-court-awards-adobe-more-than-2-million-as-damages-in-a-trademark-infringement-case-brought-against-a-frequent-cybersquatter'){
        $data["title"]="Delhi High Court awards Adobe more than $2 million as damages in a trademark infringement case brought against a frequent cybersquatter";
        $data["description"]="";
  
        $data["keywords"]="";
  
        $data["og_url"]="https://insaaf99.com/latest-news/delhi-high-court-awards-adobe-more-than-2-million-as-damages-in-a-trademark-infringement-case-brought-against-a-frequent-cybersquatter";
  
        $data["og_title"]="Delhi High Court awards Adobe more than $2 million as damages in a trademark infringement case brought against a frequent cybersquatter";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="";
  
        $data["twitter_title"]="Delhi High Court awards Adobe more than $2 million as damages in a trademark infringement case brought against a frequent cybersquatter";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/delhi-high-court-awards-adobe-more-than-2-million-as-damages-in-a-trademark-infringement-case-brought-against-a-frequent-cybersquatter";

      }
      elseif($da[0]->slug_url=='supreme-court-in-motor-accident-compensation-claim-cases-the-deceased-s-income-tax-returns-may-be-used-to-calculate-his-annual-income'){
        $data["title"]="Supreme Court- In Motor Accident Compensation Claim Cases, the Deceased's Income Tax Returns May Be Used To Calculate His Annual Income";
        $data["description"]="";
  
        $data["keywords"]="";
  
        $data["og_url"]="https://insaaf99.com/latest-news/supreme-court-in-motor-accident-compensation-claim-cases-the-deceased-s-income-tax-returns-may-be-used-to-calculate-his-annual-income";
  
        $data["og_title"]="Supreme Court- In Motor Accident Compensation Claim Cases, the Deceased's Income Tax Returns May Be Used To Calculate His Annual Income";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="";
  
        $data["twitter_title"]="Supreme Court- In Motor Accident Compensation Claim Cases, the Deceased's Income Tax Returns May Be Used To Calculate His Annual Income";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/supreme-court-in-motor-accident-compensation-claim-cases-the-deceased-s-income-tax-returns-may-be-used-to-calculate-his-annual-income";

      }

      elseif($da[0]->slug_url=='high-court-should-quash-criminal-proceeding-where-civil-dispute-given-colour-of-criminal-offence-supreme-court'){
        $data["title"]="High Court Should Quash Criminal Proceeding Where Civil Dispute Given Colour of Criminal Offence: Supreme Court";
        $data["description"]="";
  
        $data["keywords"]="";
  
        $data["og_url"]="https://insaaf99.com/latest-news/high-court-should-quash-criminal-proceeding-where-civil-dispute-given-colour-of-criminal-offence-supreme-court";
  
        $data["og_title"]="High Court Should Quash Criminal Proceeding Where Civil Dispute Given Colour of Criminal Offence: Supreme Court";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="";
  
        $data["twitter_title"]="High Court Should Quash Criminal Proceeding Where Civil Dispute Given Colour of Criminal Offence: Supreme Court";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/high-court-should-quash-criminal-proceeding-where-civil-dispute-given-colour-of-criminal-offence-supreme-court";

      }
      elseif($da[0]->slug_url=='civil-proceedings-initiated-by-the-partnership-firm-will-not-be-abated-if-one-of-the-partner-dies-during-the-proceedings-supreme-court-order-xxx-rule-4-cpc-order-xx-rule-10-cpc'){
        $data["title"]="Civil Proceedings initiated by the Partnership Firm will not be abated if one of the Partner dies during the proceedings. Supreme Court- Order XXX Rule 4 CPC, Order XX Rule 10 CPC";
        $data["description"]="";
  
        $data["keywords"]="";
  
        $data["og_url"]="https://insaaf99.com/latest-news/civil-proceedings-initiated-by-the-partnership-firm-will-not-be-abated-if-one-of-the-partner-dies-during-the-proceedings-supreme-court-order-xxx-rule-4-cpc-order-xx-rule-10-cpc";
  
        $data["og_title"]="Civil Proceedings initiated by the Partnership Firm will not be abated if one of the Partner dies during the proceedings. Supreme Court- Order XXX Rule 4 CPC, Order XX Rule 10 CPC";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="";
  
        $data["twitter_title"]="Civil Proceedings initiated by the Partnership Firm will not be abated if one of the Partner dies during the proceedings. Supreme Court- Order XXX Rule 4 CPC, Order XX Rule 10 CPC";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/civil-proceedings-initiated-by-the-partnership-firm-will-not-be-abated-if-one-of-the-partner-dies-during-the-proceedings-supreme-court-order-xxx-rule-4-cpc-order-xx-rule-10-cpc";

      }
      elseif($da[0]->slug_url=='motor-vehicle-accident-claims-the-supreme-court-directed-concerned-police-to-file-first-accident-reports-within-48-hours-and-further-orders-the-formation-of-special-police-task'){
        $data["title"]="Motor Vehicle Accident Claims: The Supreme Court Directed Concerned Police to File First Accident Reports within 48 hours and Further Orders the Formation of Special Police Task";
        $data["description"]="";
  
        $data["keywords"]="";
  
        $data["og_url"]="https://insaaf99.com/latest-news/motor-vehicle-accident-claims-the-supreme-court-directed-concerned-police-to-file-first-accident-reports-within-48-hours-and-further-orders-the-formation-of-special-police-task";
  
        $data["og_title"]="Motor Vehicle Accident Claims: The Supreme Court Directed Concerned Police to File First Accident Reports within 48 hours and Further Orders the Formation of Special Police Task";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="";
  
        $data["twitter_title"]="Motor Vehicle Accident Claims: The Supreme Court Directed Concerned Police to File First Accident Reports within 48 hours and Further Orders the Formation of Special Police Task";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/motor-vehicle-accident-claims-the-supreme-court-directed-concerned-police-to-file-first-accident-reports-within-48-hours-and-further-orders-the-formation-of-special-police-task";

      }
      elseif($da[0]->slug_url=='laxmi-anr-vs-shyam-pratap-anr'){
        $data["title"]="Daughter In Law Can Claim Maintenance From Her Father In Law If She Inherited Some Estate From Her Husband: Delhi High Court";
        $data["description"]="";
  
        $data["keywords"]="";
  
        $data["og_url"]="https://insaaf99.com/latest-news/laxmi-anr-vs-shyam-pratap-anr";
  
        $data["og_title"]="Daughter In Law Can Claim Maintenance From Her Father In Law If She Inherited Some Estate From Her Husband: Delhi High Court";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="";
  
        $data["twitter_title"]="Daughter In Law Can Claim Maintenance From Her Father In Law If She Inherited Some Estate From Her Husband: Delhi High Court";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/laxmi-anr-vs-shyam-pratap-anr";

      }
      elseif($da[0]->slug_url=='caesar-s-wife-must-be-above-suspicion-honesty-of-integrity-of-employees-working-in-the-banks-dealing-with-public-money-must-be-paramount-delhi-high-court-upholds-dismissal-of-rbi-employee'){
        $data["title"]="Caesar's wife must be above suspicion honesty of integrity of employees working in the banks dealing with public money must be paramount.Delhi High Court Upholds Dismissal of RBI Employee";
        $data["description"]="";
  
        $data["keywords"]="";
  
        $data["og_url"]="https://insaaf99.com/latest-news/caesar-s-wife-must-be-above-suspicion-honesty-of-integrity-of-employees-working-in-the-banks-dealing-with-public-money-must-be-paramount-delhi-high-court-upholds-dismissal-of-rbi-employee";
  
        $data["og_title"]="Caesar's wife must be above suspicion honesty of integrity of employees working in the banks dealing with public money must be paramount.Delhi High Court Upholds Dismissal of RBI Employee";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="";
  
        $data["twitter_title"]="Caesar's wife must be above suspicion honesty of integrity of employees working in the banks dealing with public money must be paramount.Delhi High Court Upholds Dismissal of RBI Employee";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/caesar-s-wife-must-be-above-suspicion-honesty-of-integrity-of-employees-working-in-the-banks-dealing-with-public-money-must-be-paramount-delhi-high-court-upholds-dismissal-of-rbi-employee";

      }
      elseif($da[0]->slug_url=='section-18-of-sarfaesi-act-borrower-has-to-deposit-50-of-the-amount-of-debt-due-as-claimed-by-the-bank-financial-institution-assignee-along-with-interest-as-claimed-supreme-court'){
        $data["title"]="Section 18 of SARFAESI Act- Borrower has to deposit 50% of the amount of “debt due” as claimed by the bank/financial institution/assignee along with interest as claimed- Supreme Court";
        $data["description"]="";
  
        $data["keywords"]="";
  
        $data["og_url"]="https://insaaf99.com/latest-news/section-18-of-sarfaesi-act-borrower-has-to-deposit-50-of-the-amount-of-debt-due-as-claimed-by-the-bank-financial-institution-assignee-along-with-interest-as-claimed-supreme-court";
  
        $data["og_title"]="Section 18 of SARFAESI Act- Borrower has to deposit 50% of the amount of “debt due” as claimed by the bank/financial institution/assignee along with interest as claimed- Supreme Court";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="";
  
        $data["twitter_title"]="Section 18 of SARFAESI Act- Borrower has to deposit 50% of the amount of “debt due” as claimed by the bank/financial institution/assignee along with interest as claimed- Supreme Court";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/section-18-of-sarfaesi-act-borrower-has-to-deposit-50-of-the-amount-of-debt-due-as-claimed-by-the-bank-financial-institution-assignee-along-with-interest-as-claimed-supreme-court";

      }
      elseif($da[0]->slug_url=='bombay-high-court-restrains-saregama-from-infringing-shemaroo-s-copyright-in-disco-dancer-movie-allows-london-show-to-go-on'){
        $data["title"]="Bombay High Court Restrains Saregama From Infringing Shemaroo's Copyright In 'Disco Dancer' Movie, Allows London Show To Go On";
        $data["description"]="";
  
        $data["keywords"]="";
  
        $data["og_url"]="https://insaaf99.com/latest-news/bombay-high-court-restrains-saregama-from-infringing-shemaroo-s-copyright-in-disco-dancer-movie-allows-london-show-to-go-on";
  
        $data["og_title"]="Bombay High Court Restrains Saregama From Infringing Shemaroo's Copyright In 'Disco Dancer' Movie, Allows London Show To Go On";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="";
  
        $data["twitter_title"]="Bombay High Court Restrains Saregama From Infringing Shemaroo's Copyright In 'Disco Dancer' Movie, Allows London Show To Go On";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/bombay-high-court-restrains-saregama-from-infringing-shemaroo-s-copyright-in-disco-dancer-movie-allows-london-show-to-go-on";

      }
      elseif($da[0]->slug_url=='delhi-high-court-every-child-is-a-gift-from-god-so-prospective-adoptive-parents-cannot-pick-or-choose-which-child-they-will-adopt'){
        $data["title"]="Delhi High Court- Every child is a gift from God, so prospective adoptive parents cannot pick or choose which child they will adopt";
        $data["description"]="";
  
        $data["keywords"]="";
  
        $data["og_url"]="https://insaaf99.com/latest-news/delhi-high-court-every-child-is-a-gift-from-god-so-prospective-adoptive-parents-cannot-pick-or-choose-which-child-they-will-adopt";
  
        $data["og_title"]="Delhi High Court- Every child is a gift from God, so prospective adoptive parents cannot pick or choose which child they will adopt";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="";
  
        $data["twitter_title"]="Delhi High Court- Every child is a gift from God, so prospective adoptive parents cannot pick or choose which child they will adopt";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/delhi-high-court-every-child-is-a-gift-from-god-so-prospective-adoptive-parents-cannot-pick-or-choose-which-child-they-will-adopt";

      }
      elseif($da[0]->slug_url=='section-29-of-n-i-act-legal-representative-of-the-father-the-accused-is-liable-to-repay-the-loan-to-the-complainant-under-n-i-act-karnataka-hc'){
        $data["title"]="Section 29 of N.I Act-Legal Representative of the father, the accused is liable to repay the loan to the complainant under N.I Act- Karnataka HC";
        $data["description"]="";
  
        $data["keywords"]="";
  
        $data["og_url"]="https://insaaf99.com/latest-news/section-29-of-n-i-act-legal-representative-of-the-father-the-accused-is-liable-to-repay-the-loan-to-the-complainant-under-n-i-act-karnataka-hc";
  
        $data["og_title"]="Section 29 of N.I Act-Legal Representative of the father, the accused is liable to repay the loan to the complainant under N.I Act- Karnataka HC";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="";
  
        $data["twitter_title"]="Section 29 of N.I Act-Legal Representative of the father, the accused is liable to repay the loan to the complainant under N.I Act- Karnataka HC";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/section-29-of-n-i-act-legal-representative-of-the-father-the-accused-is-liable-to-repay-the-loan-to-the-complainant-under-n-i-act-karnataka-hc";

      }
      elseif($da[0]->slug_url=='effecting-transfer-of-property-subject-to-condition-of-providing-basic-amenities-physical-needs-to-transferor-senior-citizen-is-sine-qua-non-for-applicability-of-sec-23-1-of-senior-citizens-act-sc'){
        $data["title"]="Effecting transfer of property subject to condition of providing basic amenities & physical needs to transferor-senior citizen, is sine qua non for applicability of Sec.23 (1) of Senior Citizens Act: SC";
        $data["description"]="";
  
        $data["keywords"]="";
  
        $data["og_url"]="https://insaaf99.com/latest-news/effecting-transfer-of-property-subject-to-condition-of-providing-basic-amenities-physical-needs-to-transferor-senior-citizen-is-sine-qua-non-for-applicability-of-sec-23-1-of-senior-citizens-act-sc";
  
        $data["og_title"]="Effecting transfer of property subject to condition of providing basic amenities & physical needs to transferor-senior citizen, is sine qua non for applicability of Sec.23 (1) of Senior Citizens Act: SC";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="";
  
        $data["twitter_title"]="Effecting transfer of property subject to condition of providing basic amenities & physical needs to transferor-senior citizen, is sine qua non for applicability of Sec.23 (1) of Senior Citizens Act: SC";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/effecting-transfer-of-property-subject-to-condition-of-providing-basic-amenities-physical-needs-to-transferor-senior-citizen-is-sine-qua-non-for-applicability-of-sec-23-1-of-senior-citizens-act-sc";

      }
      elseif($da[0]->slug_url=='supreme-court-upholds-validity-of-10-percent-quota-for-economically-weaker-section-the-majority-bench-upheld-the-103rd-constitutional-amendment-cji-uu-lalit-justice-s-ravindra-bhat-dissent'){
        $data["title"]="Supreme Court upholds validity of 10 percent quota for Economically Weaker Section; The majority Bench upheld the 103rd Constitutional Amendment. CJI UU Lalit, Justice S Ravindra Bhat dissent";
        $data["description"]="";
  
        $data["keywords"]="";
  
        $data["og_url"]="https://insaaf99.com/latest-news/supreme-court-upholds-validity-of-10-percent-quota-for-economically-weaker-section-the-majority-bench-upheld-the-103rd-constitutional-amendment-cji-uu-lalit-justice-s-ravindra-bhat-dissent";
  
        $data["og_title"]="Supreme Court upholds validity of 10 percent quota for Economically Weaker Section; The majority Bench upheld the 103rd Constitutional Amendment. CJI UU Lalit, Justice S Ravindra Bhat dissent";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="";
  
        $data["twitter_title"]="Supreme Court upholds validity of 10 percent quota for Economically Weaker Section; The majority Bench upheld the 103rd Constitutional Amendment. CJI UU Lalit, Justice S Ravindra Bhat dissent";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/supreme-court-upholds-validity-of-10-percent-quota-for-economically-weaker-section-the-majority-bench-upheld-the-103rd-constitutional-amendment-cji-uu-lalit-justice-s-ravindra-bhat-dissent";

      }
      elseif($da[0]->slug_url=='can-sexual-harassment-enquiry-proceedings-be-quashed-only-because-icc-failed-to-complete-it-in-90-days-answers-delhi-hc'){
        $data["title"]="Can Sexual Harassment Enquiry Proceedings Be Quashed Only Because ICC failed to Complete it in 90 Days? Answers Delhi HC";
        $data["description"]="";
  
        $data["keywords"]="";
  
        $data["og_url"]="https://insaaf99.com/latest-news/can-sexual-harassment-enquiry-proceedings-be-quashed-only-because-icc-failed-to-complete-it-in-90-days-answers-delhi-hc";
  
        $data["og_title"]="Can Sexual Harassment Enquiry Proceedings Be Quashed Only Because ICC failed to Complete it in 90 Days? Answers Delhi HC";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="";
  
        $data["twitter_title"]="Can Sexual Harassment Enquiry Proceedings Be Quashed Only Because ICC failed to Complete it in 90 Days? Answers Delhi HC";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/can-sexual-harassment-enquiry-proceedings-be-quashed-only-because-icc-failed-to-complete-it-in-90-days-answers-delhi-hc";

      }
      elseif($da[0]->slug_url=='big-relief-for-parents-schools-are-directed-to-adjust-15-excess-fee-paid-during-covid-times-2020-21-to-be-adjusted-in-future-to-students-allahabad-hc'){
        $data["title"]="Big Relief for Parents Schools are directed to adjust 15% excess fee paid during Covid Times (2020-21) to be adjusted in Future to Students - Allahabad HC";
        $data["description"]="";
  
        $data["keywords"]="";
  
        $data["og_url"]="https://insaaf99.com/latest-news/big-relief-for-parents-schools-are-directed-to-adjust-15-excess-fee-paid-during-covid-times-2020-21-to-be-adjusted-in-future-to-students-allahabad-hc";
  
        $data["og_title"]="Big Relief for Parents Schools are directed to adjust 15% excess fee paid during Covid Times (2020-21) to be adjusted in Future to Students - Allahabad HC";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="";
  
        $data["twitter_title"]="Big Relief for Parents Schools are directed to adjust 15% excess fee paid during Covid Times (2020-21) to be adjusted in Future to Students - Allahabad HC";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/big-relief-for-parents-schools-are-directed-to-adjust-15-excess-fee-paid-during-covid-times-2020-21-to-be-adjusted-in-future-to-students-allahabad-hc";

      }
      elseif($da[0]->slug_url=='the-delhi-high-court-granted-relief-in-a-trademark-dispute-by-describing-itc-maurya-s-bukhara-as-a-well-known-brand'){
        $data["title"]="";
        $data["description"]="";
  
        $data["keywords"]="";
  
        $data["og_url"]="https://insaaf99.com/latest-news/the-delhi-high-court-granted-relief-in-a-trademark-dispute-by-describing-itc-maurya-s-bukhara-as-a-well-known-brand";
  
        $data["og_title"]="";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="";
  
        $data["twitter_title"]="";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/the-delhi-high-court-granted-relief-in-a-trademark-dispute-by-describing-itc-maurya-s-bukhara-as-a-well-known-brand";

      }

      elseif($da[0]->slug_url=='supreme-court-section-300-of-cr-pc-bars-that-no-person-shall-be-prosecuted-or-punished-for-the-same-offence-more-than-once'){
        $data["title"]="Supreme Court- Section 300 of Cr.PC Bars that no person shall be prosecuted or punished for the same offence, more than once";
        $data["description"]="";
  
        $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, free legal advice, legal response, law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";
  
        $data["og_url"]="https://insaaf99.com/latest-news/supreme-court-section-300-of-cr-pc-bars-that-no-person-shall-be-prosecuted-or-punished-for-the-same-offence-more-than-once";
  
        $data["og_title"]="Supreme Court- Section 300 of Cr.PC Bars that no person shall be prosecuted or punished for the same offence, more than once";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="summary";
  
        $data["twitter_title"]="Supreme Court- Section 300 of Cr.PC Bars that no person shall be prosecuted or punished for the same offence, more than once";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/supreme-court-section-300-of-cr-pc-bars-that-no-person-shall-be-prosecuted-or-punished-for-the-same-offence-more-than-once";

      }
      elseif($da[0]->slug_url=='supreme-court-mother-being-the-only-natural-guardian-of-the-child-has-the-right-to-decide-the-surname-of-the-child'){
        $data["title"]="Supreme Court: Mother being the only natural guardian of the child has the right to decide the surname of the child";
        $data["description"]="";
  
        $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, free legal advice, legal response, law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";
  
        $data["og_url"]="https://insaaf99.com/latest-news/supreme-court-mother-being-the-only-natural-guardian-of-the-child-has-the-right-to-decide-the-surname-of-the-child";
  
        $data["og_title"]="Supreme Court: Mother being the only natural guardian of the child has the right to decide the surname of the child";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="summary";
  
        $data["twitter_title"]="Supreme Court: Mother being the only natural guardian of the child has the right to decide the surname of the child";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/supreme-court-mother-being-the-only-natural-guardian-of-the-child-has-the-right-to-decide-the-surname-of-the-child";

      }
      elseif($da[0]->slug_url=='under-section-138-of-ni-act-merely-signing-a-cheque-does-not-constitute-an-offense-delhi-high-court'){
        $data["title"]="Under Section 138 of NI Act, Merely Signing a Cheque Does Not Constitute an Offense- Delhi High Court";
        $data["description"]="";
  
        $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, free legal advice, legal response, law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";
  
        $data["og_url"]="https://insaaf99.com/latest-news/under-section-138-of-ni-act-merely-signing-a-cheque-does-not-constitute-an-offense-delhi-high-court";
  
        $data["og_title"]="Under Section 138 of NI Act, Merely Signing a Cheque Does Not Constitute an Offense- Delhi High Court";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="summary";
  
        $data["twitter_title"]="Under Section 138 of NI Act, Merely Signing a Cheque Does Not Constitute an Offense- Delhi High Court";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/under-section-138-of-ni-act-merely-signing-a-cheque-does-not-constitute-an-offense-delhi-high-court";

      }
      elseif($da[0]->slug_url=='delhi-high-court-grants-protection-to-trademark-rooh-afza-being-a-highly-reputed-mark-and-has-acquire-immense-goodwill-in-the-mark'){
        $data["title"]="Delhi high court grants protection to trademark rooh afza being a highly reputed mark and has acquire immense goodwill in the mark";
        $data["description"]="";
  
        $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, free legal advice, legal response, law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";
  
        $data["og_url"]="https://insaaf99.com/latest-news/delhi-high-court-grants-protection-to-trademark-rooh-afza-being-a-highly-reputed-mark-and-has-acquire-immense-goodwill-in-the-mark";
  
        $data["og_title"]="Delhi high court grants protection to trademark rooh afza being a highly reputed mark and has acquire immense goodwill in the mark";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="summary";
  
        $data["twitter_title"]="Delhi high court grants protection to trademark rooh afza being a highly reputed mark and has acquire immense goodwill in the mark";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/delhi-high-court-grants-protection-to-trademark-rooh-afza-being-a-highly-reputed-mark-and-has-acquire-immense-goodwill-in-the-mark";

      }
      elseif($da[0]->slug_url=='continuing-illegal-activities-reflected-in-more-than-one-chargesheet-a-must-to-establish-organised-crime-supreme-court'){
        $data["title"]="Continuing illegal activities reflected in more than one chargesheet a must to establish organised crime: Supreme Court";
        $data["description"]="";
  
        $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, free legal advice, legal response, law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";
  
        $data["og_url"]="https://insaaf99.com/latest-news/continuing-illegal-activities-reflected-in-more-than-one-chargesheet-a-must-to-establish-organised-crime-supreme-court";
  
        $data["og_title"]="Continuing illegal activities reflected in more than one chargesheet a must to establish organised crime: Supreme Court";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="summary";
  
        $data["twitter_title"]="Continuing illegal activities reflected in more than one chargesheet a must to establish organised crime: Supreme Court";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/continuing-illegal-activities-reflected-in-more-than-one-chargesheet-a-must-to-establish-organised-crime-supreme-court";

      }
      elseif($da[0]->slug_url=='the-supreme-court-upholds-the-dismissal-of-the-cisf-officer-who-harassed-a-couple-at-night-said-police-officers-are-not-required-to-practise-moral-policing'){
        $data["title"]="The Supreme Court upholds the dismissal of the CISF officer who harassed a couple at night, said- police officers are not required to practise moral policing.";
        $data["description"]="";
  
        $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, free legal advice, legal response, law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";
  
        $data["og_url"]="https://insaaf99.com/latest-news/the-supreme-court-upholds-the-dismissal-of-the-cisf-officer-who-harassed-a-couple-at-night-said-police-officers-are-not-required-to-practise-moral-policing";
  
        $data["og_title"]="The Supreme Court upholds the dismissal of the CISF officer who harassed a couple at night, said- police officers are not required to practise moral policing.";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="summary";
  
        $data["twitter_title"]="The Supreme Court upholds the dismissal of the CISF officer who harassed a couple at night, said- police officers are not required to practise moral policing.";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/the-supreme-court-upholds-the-dismissal-of-the-cisf-officer-who-harassed-a-couple-at-night-said-police-officers-are-not-required-to-practise-moral-policing";

      }
      elseif($da[0]->slug_url=='calcutta-high-court-cannot-allow-to-initiate-criminal-proceedings-for-recovery-of-amount-due-under-the-arbitration-award'){
        $data["title"]="Calcutta High Court- Cannot allow to initiate Criminal Proceedings For Recovery Of Amount Due Under The Arbitration Award";
        $data["description"]="";
  
        $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, free legal advice, legal response, law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";
  
        $data["og_url"]="https://insaaf99.com/latest-news/calcutta-high-court-cannot-allow-to-initiate-criminal-proceedings-for-recovery-of-amount-due-under-the-arbitration-award";
  
        $data["og_title"]="Calcutta High Court- Cannot allow to initiate Criminal Proceedings For Recovery Of Amount Due Under The Arbitration Award";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="summary";
  
        $data["twitter_title"]="Calcutta High Court- Cannot allow to initiate Criminal Proceedings For Recovery Of Amount Due Under The Arbitration Award";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/calcutta-high-court-cannot-allow-to-initiate-criminal-proceedings-for-recovery-of-amount-due-under-the-arbitration-award";

      }
      elseif($da[0]->slug_url=='the-hon-ble-justice-tirthankar-ghosh'){
        $data["title"]="THE HON’BLE JUSTICE TIRTHANKAR GHOSH";
        $data["description"]="";
  
        $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, free legal advice, legal response, law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";
  
        $data["og_url"]="https://insaaf99.com/latest-news/the-hon-ble-justice-tirthankar-ghosh";
  
        $data["og_title"]="THE HON’BLE JUSTICE TIRTHANKAR GHOSH";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="summary";
  
        $data["twitter_title"]="THE HON’BLE JUSTICE TIRTHANKAR GHOSH";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/the-hon-ble-justice-tirthankar-ghosh";

      }
      elseif($da[0]->slug_url=='supreme-court-constitutional-bench-direct-evidence-of-bribe-not-necessary-to-convict-public-servant-under-prevention-of-corruption-act'){
        $data["title"]="Supreme Court Constitutional Bench - Direct Evidence Of Bribe Not Necessary To Convict Public Servant Under Prevention Of Corruption Act";
        $data["description"]="";
  
        $data["keywords"]="Supreme Court Constitutional Bench - Direct Evidence Of Bribe Not Necessary To Convict Public Servant Under Prevention Of Corruption Act";
  
        $data["og_url"]="https://insaaf99.com/latest-news/supreme-court-constitutional-bench-direct-evidence-of-bribe-not-necessary-to-convict-public-servant-under-prevention-of-corruption-act";
  
        $data["og_title"]="Supreme Court Constitutional Bench - Direct Evidence Of Bribe Not Necessary To Convict Public Servant Under Prevention Of Corruption Act";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="summary";
  
        $data["twitter_title"]="Supreme Court Constitutional Bench - Direct Evidence Of Bribe Not Necessary To Convict Public Servant Under Prevention Of Corruption Act";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/supreme-court-constitutional-bench-direct-evidence-of-bribe-not-necessary-to-convict-public-servant-under-prevention-of-corruption-act";

      }
      elseif($da[0]->slug_url=='mohana-krishnan-s-versus-k-balasubramaniyam-ors'){
        $data["title"]="Motor Accident Claims : Does Third Party Insurance Cover Pillion Rider? Supreme Court Refers To Larger Bench";
        $data["description"]="";
  
        $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, free legal advice, legal response, law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";
  
        $data["og_url"]="https://insaaf99.com/latest-news/mohana-krishnan-s-versus-k-balasubramaniyam-ors";
  
        $data["og_title"]="Motor Accident Claims : Does Third Party Insurance Cover Pillion Rider? Supreme Court Refers To Larger Bench";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="summary";
  
        $data["twitter_title"]="Motor Accident Claims : Does Third Party Insurance Cover Pillion Rider? Supreme Court Refers To Larger Bench";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/mohana-krishnan-s-versus-k-balasubramaniyam-ors";

      }
      elseif($da[0]->slug_url=='landmark-judgment-supreme-court-waives-six-months-cooling-off-period-grants-mutual-divorce-to-couple'){
        $data["title"]="Landmark judgment- Supreme Court waives six-months cooling-off period, grants mutual divorce to couple";
        $data["description"]="";
  
        $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, free legal advice, legal response, law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";
  
        $data["og_url"]="https://insaaf99.com/latest-news/landmark-judgment-supreme-court-waives-six-months-cooling-off-period-grants-mutual-divorce-to-couple";
  
        $data["og_title"]="Landmark judgment- Supreme Court waives six-months cooling-off period, grants mutual divorce to couple";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="summary";
  
        $data["twitter_title"]="Landmark judgment- Supreme Court waives six-months cooling-off period, grants mutual divorce to couple";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/landmark-judgment-supreme-court-waives-six-months-cooling-off-period-grants-mutual-divorce-to-couple";

      }
      elseif($da[0]->slug_url=='ncw-moves-sc-to-raise-minimum-age-of-marriage-for-muslim-women'){
        $data["title"]="NCW moves SC to raise minimum age of marriage for Muslim women";
        $data["description"]="";
  
        $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, free legal advice, legal response, law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";
  
        $data["og_url"]="https://insaaf99.com/latest-news/ncw-moves-sc-to-raise-minimum-age-of-marriage-for-muslim-women";
  
        $data["og_title"]="NCW moves SC to raise minimum age of marriage for Muslim women";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="summary";
  
        $data["twitter_title"]="NCW moves SC to raise minimum age of marriage for Muslim women";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/ncw-moves-sc-to-raise-minimum-age-of-marriage-for-muslim-women";

      }
      elseif($da[0]->slug_url=='naturals-v-nic-natural-delhi-hc-restrains-nic-natural-ice-creams-from-using-naturals-trademark'){
        $data["title"]="NATURALS v NIC Natural : Delhi HC restrains NIC Natural ice creams from using NATURALS trademark";
        $data["description"]="Accident Claims: Does Third Party Insurance Cover Pillion Rider? Supreme Court Refers the Matter to Larger Bench.";
  
        $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, free legal advice, legal response, law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";
  
        $data["og_url"]="https://insaaf99.com/latest-news/naturals-v-nic-natural-delhi-hc-restrains-nic-natural-ice-creams-from-using-naturals-trademark";
  
        $data["og_title"]="NATURALS v NIC Natural : Delhi HC restrains NIC Natural ice creams from using NATURALS trademark";
  
        $data["og_description"]="Accident Claims: Does Third Party Insurance Cover Pillion Rider? Supreme Court Refers the Matter to Larger Bench.";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="summary";
  
        $data["twitter_title"]="NATURALS v NIC Natural : Delhi HC restrains NIC Natural ice creams from using NATURALS trademark";
  
        $data["twitter_description"]="Accident Claims: Does Third Party Insurance Cover Pillion Rider? Supreme Court Refers the Matter to Larger Bench.";
  
        $data["canonical"]="https://insaaf99.com/latest-news/naturals-v-nic-natural-delhi-hc-restrains-nic-natural-ice-creams-from-using-naturals-trademark";

      }
      elseif($da[0]->slug_url=='vasant-vs-the-state-of-maharashtra-ors'){
        $data["title"]="Dowry demand even by rich persons against poor family members of wife is rampant: Bombay High Court";
        $data["description"]="Demand of dowry even by rich persons against poor family members of the wife is rampant,” Justice Deshpande said. The high court also pulled up.";
  
        $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, free legal advice, legal response, law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";
  
        $data["og_url"]="https://insaaf99.com/latest-news/vasant-vs-the-state-of-maharashtra-ors";
  
        $data["og_title"]="Dowry demand even by rich persons against poor family members of wife is rampant: Bombay High Court";
  
        $data["og_description"]="Demand of dowry even by rich persons against poor family members of the wife is rampant,” Justice Deshpande said. The high court also pulled up.";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="summary";
  
        $data["twitter_title"]="Dowry demand even by rich persons against poor family members of wife is rampant: Bombay High Court";
  
        $data["twitter_description"]="Demand of dowry even by rich persons against poor family members of the wife is rampant,” Justice Deshpande said. The high court also pulled up.";
  
        $data["canonical"]="https://insaaf99.com/latest-news/vasant-vs-the-state-of-maharashtra-ors";

      }
      elseif($da[0]->slug_url=="oriental-bank-of-commerce-vs-prabodh-kumar-tewari"){
        $data["title"]=" Drawer Liable Even If Details Of Cheque Was Filled Up By Some Other ";
        $data["description"]="Drawer Liable Even If Details Of Cheque Was Filled Up By Some Other Person; Handwriting Expert's Report Cannot Rebut Presumption U/s 139 NI Act.";
  
        $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, free legal advice, legal response, law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";
  
        $data["og_url"]="https://insaaf99.com/latest-news/oriental-bank-of-commerce-vs-prabodh-kumar-tewari";
  
        $data["og_title"]="Person; Handwriting Expert's Report Cannot Rebut Presumption U/s 139 NI ";
  
        $data["og_description"]="Drawer Liable Even If Details Of Cheque Was Filled Up By Some Other Person; Handwriting Expert's Report Cannot Rebut Presumption U/s 139 NI Act.";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="summary";
  
        $data["twitter_title"]="Act: Supreme Court ";
  
        $data["twitter_description"]="Drawer Liable Even If Details Of Cheque Was Filled Up By Some Other Person; Handwriting Expert's Report Cannot Rebut Presumption U/s 139 NI Act.";
  
        $data["canonical"]="https://insaaf99.com/latest-news/oriental-bank-of-commerce-vs-prabodh-kumar-tewari";

      }
      elseif($da[0]->slug_url=="personal-liberty-can-t-be-taken-away-even-temporarily-without-following-procedure-under-law-supreme-court"){
        $data["title"]=" Personal liberty can't be taken away even temporarily without following procedure under law: Supreme Court  ";
        $data["description"]="Personal liberty can't be taken away even temporarily without following procedure under law: Supreme Court.";
  
        $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, free legal advice, legal response, law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";
  
        $data["og_url"]="https://insaaf99.com/latest-news/personal-liberty-can-t-be-taken-away-even-temporarily-without-following-procedure-under-law-supreme-court";
  
        $data["og_title"]="Personal liberty can't be taken away even temporarily without following procedure under law: Supreme Court ";
  
        $data["og_description"]="Personal liberty can't be taken away even temporarily without following procedure under law: Supreme Court.";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="summary";
  
        $data["twitter_title"]="Personal liberty can't be taken away even temporarily without following procedure under law: Supreme Court  ";
  
        $data["twitter_description"]="Personal liberty can't be taken away even temporarily without following procedure under law: Supreme Court.";
  
        $data["canonical"]="https://insaaf99.com/latest-news/personal-liberty-can-t-be-taken-away-even-temporarily-without-following-procedure-under-law-supreme-court";

      }
      elseif($da[0]->slug_url=="before-the-national-green-tribunal-principal-bench-new-delhi-by-video-conferencing"){
        $data["title"]=" NGT orders Rajasthan Government to pay ?3,000 crore compensation for improper waste management  ";
        $data["description"]="NGT has directed the Rajasthan government to pay Rs 3000 cr as environmental compensation for improper management of solid";
  
        $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, free legal advice, legal response, law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";
  
        $data["og_url"]="https://insaaf99.com/latest-news/before-the-national-green-tribunal-principal-bench-new-delhi-by-video-conferencing";
  
        $data["og_title"]="NGT orders Rajasthan Government to pay ?3,000 crore compensation for improper waste management ";
  
        $data["og_description"]="NGT has directed the Rajasthan government to pay Rs 3000 cr as environmental compensation for improper management of solid";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="summary";
  
        $data["twitter_title"]="NGT orders Rajasthan Government to pay ?3,000 crore compensation for improper waste management  ";
  
        $data["twitter_description"]="NGT has directed the Rajasthan government to pay Rs 3000 cr as environmental compensation for improper management of solid";
  
        $data["canonical"]="https://insaaf99.com/latest-news/before-the-national-green-tribunal-principal-bench-new-delhi-by-video-conferencing";

      }

      elseif($da[0]->slug_url=="smt-harsha-sharma-v-rakesh-sharma"){
        $data["title"]=" More Weightage To Be Given To Husband's Convenience When He's Taking Care Of Children: MP High Court  ";
        $data["description"]="More Weightage To Be Given To Husband's Convenience When He's Taking Care Of Children: MP High Court ";
  
        $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, free legal advice, legal response, law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";
  
        $data["og_url"]="https://insaaf99.com/latest-news/smt-harsha-sharma-v-rakesh-sharma";
  
        $data["og_title"]="More Weightage To Be Given To Husband's Convenience When He's Taking Care Of Children: MP High Court ";
  
        $data["og_description"]="More Weightage To Be Given To Husband's Convenience When He's Taking Care Of Children: MP High Court ";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="summary";
  
        $data["twitter_title"]="More Weightage To Be Given To Husband's Convenience When He's Taking Care Of Children: MP High Court  ";
  
        $data["twitter_description"]="More Weightage To Be Given To Husband's Convenience When He's Taking Care Of Children: MP High Court ";
  
        $data["canonical"]="https://insaaf99.com/latest-news/smt-harsha-sharma-v-rakesh-sharma";

      }

      elseif($da[0]->slug_url=="patil-rail-infrastructure-pvt-ltd-vs-ministry-of-railway-anr-on-22-july-2021"){
        $data["title"]="   Whether the right of a party to appoint an arbitrator gets forfeited in case it fails to appoint an arbitrator prior to the filing of the petition u/s 11 of the Act?  ";
        $data["description"]="  Whether the right of a party to appoint an arbitrator gets forfeited in case it fails to appoint an arbitrator prior to the filing of the petition u/s 11 of the Act? ";
  
        $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, free legal advice, legal response, law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";
  
        $data["og_url"]="https://insaaf99.com/latest-news/patil-rail-infrastructure-pvt-ltd-vs-ministry-of-railway-anr-on-22-july-2021";
  
        $data["og_title"]="  Whether the right of a party to appoint an arbitrator gets forfeited in case it fails to appoint an arbitrator prior to the filing of the petition u/s 11 of the Act? ";
  
        $data["og_description"]="  Whether the right of a party to appoint an arbitrator gets forfeited in case it fails to appoint an arbitrator prior to the filing of the petition u/s 11 of the Act? ";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="summary";
  
        $data["twitter_title"]="  Whether the right of a party to appoint an arbitrator gets forfeited in case it fails to appoint an arbitrator prior to the filing of the petition u/s 11 of the Act?  ";
  
        $data["twitter_description"]="  Whether the right of a party to appoint an arbitrator gets forfeited in case it fails to appoint an arbitrator prior to the filing of the petition u/s 11 of the Act? ";
  
        $data["canonical"]="https://insaaf99.com/latest-news/patil-rail-infrastructure-pvt-ltd-vs-ministry-of-railway-anr-on-22-july-2021";

      }

      elseif($da[0]->slug_url=="delhi-high-court-awards-3-lakh-damages-to-rajnigandha-for-dishonest-adoption-of-trademark-by-rajni-paan"){
        $data["title"]="   Delhi High Court awards ?3 lakh damages to Rajnigandha  ";
        $data["description"]="  Delhi High Court awards ?3 lakh damages to Rajanigandha for dishonest adoption of trademark by Rajni Paan ";
  
        $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, free legal advice, legal response, law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";
  
        $data["og_url"]="https://insaaf99.com/latest-news/delhi-high-court-awards-3-lakh-damages-to-rajnigandha-for-dishonest-adoption-of-trademark-by-rajni-paan";
  
        $data["og_title"]="  Delhi High Court awards ?3 lakh damages to Rajnigandha ";
  
        $data["og_description"]="  Delhi High Court awards ?3 lakh damages to Rajanigandha for dishonest adoption of trademark by Rajni Paan ";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="summary";
  
        $data["twitter_title"]="  Delhi High Court awards ?3 lakh damages to Rajnigandha  ";
  
        $data["twitter_description"]="  Delhi High Court awards ?3 lakh damages to Rajanigandha for dishonest adoption of trademark by Rajni Paan ";
  
        $data["canonical"]="https://insaaf99.com/latest-news/delhi-high-court-awards-3-lakh-damages-to-rajnigandha-for-dishonest-adoption-of-trademark-by-rajni-paan";

      }

      elseif($da[0]->slug_url=="question-whether-cheque-was-issued-for-a-time-barred-debt-or-not-cannot-be-decided-in-a-petition-under-section-482-crpc-supreme-court"){
        $data["title"]="    Plea Before Kerala High Court Seeks Law against Black Magic, witchcraft: Enactment Of Bill Against Superstition and Human Sacrifice ";
        $data["description"]="These appeals are at the instance of the original complainant of a complaint lodged under Section 138 of the Negotiable Instruments Act,";
  
        $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, free legal advice, legal response, law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";
  
        $data["og_url"]="https://insaaf99.com/latest-news/question-whether-cheque-was-issued-for-a-time-barred-debt-or-not-cannot-be-decided-in-a-petition-under-section-482-crpc-supreme-court";
  
        $data["og_title"]="   Plea Before Kerala High Court Seeks Law against Black Magic, witchcraft: Enactment Of Bill Against Superstition and Human Sacrifice  ";
  
        $data["og_description"]=" Plea Before Kerala High Court Seeks Law against Black Magic, witchcraft: Enactment Of Bill Against Superstition and Human Sacrifice";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="summary";
  
        $data["twitter_title"]="   Plea Before Kerala High Court Seeks Law against Black Magic, witchcraft: Enactment Of Bill Against Superstition and Human Sacrifice  ";
  
        $data["twitter_description"]="  Plea Before Kerala High Court Seeks Law against Black Magic, witchcraft:Enactment Of Bill Against Superstition and Human Sacrifice";
  
        $data["canonical"]="https://insaaf99.com/latest-news/question-whether-cheque-was-issued-for-a-time-barred-debt-or-not-cannot-be-decided-in-a-petition-under-section-482-crpc-supreme-court";

      }

      elseif($da[0]->slug_url=="pradeep-kumar-vs-smt-bhawana-ors"){
        $data["title"]="    Denial Of Maintenance To Estranged Wife & Child Is Worst Offence From Humanitarian Perspective: Delhi High Court Imposes 20K Cost On Husband  ";
        $data["description"]="This petition has been filed under Section 482 Cr.P.C. for quashing of an order dated 10th December, 2021, passed by the learned Family Court, North-East";
  
        $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, free legal advice, legal response, law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";
  
        $data["og_url"]="https://insaaf99.com/latest-news/pradeep-kumar-vs-smt-bhawana-ors";
  
        $data["og_title"]="   Denial Of Maintenance To Estranged Wife & Child Is Worst Offence From Humanitarian Perspective: Delhi High Court Imposes 20K Cost On Husband   ";
  
        $data["og_description"]=" Denial Of Maintenance To Estranged Wife & Child Is Worst Offence From Humanitarian Perspective: Delhi High Court Imposes 20K Cost On Husband ";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="summary";
  
        $data["twitter_title"]="   Denial Of Maintenance To Estranged Wife & Child Is Worst Offence From Humanitarian Perspective: Delhi High Court Imposes 20K Cost On Husband   ";
  
        $data["twitter_description"]="  Denial Of Maintenance To Estranged Wife & Child Is Worst Offence From Humanitarian Perspective: Delhi High Court Imposes 20K Cost On Husband ";
  
        $data["canonical"]="https://insaaf99.com/latest-news/pradeep-kumar-vs-smt-bhawana-ors";

      }

      elseif($da[0]->slug_url=="u-n-krishnamurthy-since-deceased-thr-lrs-versus-a-m-krishnamurthy"){
        $data["title"]="     Plaintiff should prove readiness to perform his part of contract for obtaining relief of specific performance: Supreme Cour ";
        $data["description"]="  Plea Before Kerala High Court Seeks Law against Black Magic, witchcraft:  ";
  
        $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, free legal advice, legal response, law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";
  
        $data["og_url"]="https://insaaf99.com/latest-news/u-n-krishnamurthy-since-deceased-thr-lrs-versus-a-m-krishnamurthy";
  
        $data["og_title"]="    Plaintiff should prove readiness to perform his part of contract for obtaining relief of specific performance: Supreme Cour  ";
  
        $data["og_description"]="  Plaintiff should prove readiness to perform his part of contract for obtaining relief of specific performance: Supreme Cour";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="summary";
  
        $data["twitter_title"]="    Plaintiff should prove readiness to perform his part of contract for obtaining relief of specific performance: Supreme Cour  ";
  
        $data["twitter_description"]="   Plaintiff should prove readiness to perform his part of contract for obtaining relief of specific performance: Supreme Cour";
  
        $data["canonical"]="https://insaaf99.com/latest-news/u-n-krishnamurthy-since-deceased-thr-lrs-versus-a-m-krishnamurthy";

      }

      elseif($da[0]->slug_url=="in-the-high-court-of-delhi-at-new-delhi"){
        $data["title"]="     Eurosport reaches for the 'stars', but Delhi High Court rules in favour of Star in logo dispute  ";
        $data["description"]="  Plea Before Kerala High Court Seeks Law against Black Magic, witchcraft:  ";
  
        $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, free legal advice, legal response, law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";
  
        $data["og_url"]="https://insaaf99.com/latest-news/in-the-high-court-of-delhi-at-new-delhi";
  
        $data["og_title"]="Eurosport reaches for the 'stars', but Delhi High Court rules in favour of Star in logo dispute   ";
  
        $data["og_description"]="  Eurosport reaches for the 'stars', but Delhi High Court rules in favour of Star in logo dispute ";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="summary";
  
        $data["twitter_title"]="    Eurosport reaches for the 'stars', but Delhi High Court rules in favour of Star in logo dispute   ";
  
        $data["twitter_description"]="   Eurosport reaches for the 'stars', but Delhi High Court rules in favour of Star in logo dispute ";
  
        $data["canonical"]="https://insaaf99.com/latest-news/in-the-high-court-of-delhi-at-new-delhi";

      }

      elseif($da[0]->slug_url=="anandam-gundluru-v-inspector-of-police"){
        $data["title"]="      Madras High Court Acquits Man Who Possessed 1.5 Kg Heroin Believing It To Be Wheat Flour  ";
        $data["description"]="   Madras High Court Acquits Man Who Possessed 1.5 Kg Heroin Believing It To Be Wheat Flour   ";
  
        $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, free legal advice, legal response, law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";
  
        $data["og_url"]="https://insaaf99.com/latest-news/anandam-gundluru-v-inspector-of-police";
  
        $data["og_title"]=" Madras High Court Acquits Man Who Possessed 1.5 Kg Heroin Believing It To Be Wheat Flour   ";
  
        $data["og_description"]="   Madras High Court Acquits Man Who Possessed 1.5 Kg Heroin Believing It To Be Wheat Flour ";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="summary";
  
        $data["twitter_title"]="     Madras High Court Acquits Man Who Possessed 1.5 Kg Heroin Believing It To Be Wheat Flour   ";
  
        $data["twitter_description"]="    Madras High Court Acquits Man Who Possessed 1.5 Kg Heroin Believing It To Be Wheat Flour ";
  
        $data["canonical"]="https://insaaf99.com/latest-news/anandam-gundluru-v-inspector-of-police";

      }

      elseif($da[0]->slug_url=="m-s-ss-engineers-ors-vs-hindustan-petroleum-corporation-ltd"){
        $data["title"]="       NCLT Not A Debt Collection Forum ; Operational Creditor's Application To Initiate CIRP Must Be Dismissed If The Debt Is Disputed: Supreme Court ";
        $data["description"]="    NCLT Not A Debt Collection Forum ; Operational Creditor's Application To         Initiate CIRP Must Be Dismissed If The Debt Is Disputed: Supreme Court";
  
        $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, free legal advice, legal response, law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";
  
        $data["og_url"]="https://insaaf99.com/latest-news/m-s-ss-engineers-ors-vs-hindustan-petroleum-corporation-ltd";
  
        $data["og_title"]="  NCLT Not A Debt Collection Forum ; Operational Creditor's Application To Initiate CIRP Must Be Dismissed If The Debt Is Disputed: Supreme Court  ";
  
        $data["og_description"]="    NCLT Not A Debt Collection Forum ; Operational Creditor's Application To Initiate CIRP Must Be Dismissed If The Debt Is Disputed: Supreme Court";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="summary";
  
        $data["twitter_title"]="      NCLT Not A Debt Collection Forum ; Operational Creditor's Application To Initiate CIRP Must Be Dismissed If The Debt Is Disputed: Supreme Court  ";
  
        $data["twitter_description"]="     NCLT Not A Debt Collection Forum ; Operational Creditor's Application To Initiate CIRP Must Be Dismissed If The Debt Is Disputed: Supreme Court";
  
        $data["canonical"]="https://insaaf99.com/latest-news/m-s-ss-engineers-ors-vs-hindustan-petroleum-corporation-ltd";

      }

      elseif($da[0]->slug_url=="rajesh-giri-vs-subhash-mittal-and-others"){
        $data["title"]="        Private temple does not become a public one because it is open to public on certain festivals: Delhi High Court  ";
        $data["description"]="     Private temple does not become a public one because it is open to public on certain festivals: Delhi High Court ";
  
        $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, free legal advice, legal response, law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";
  
        $data["og_url"]="https://insaaf99.com/latest-news/rajesh-giri-vs-subhash-mittal-and-others";
  
        $data["og_title"]="   Private temple does not become a public one because it is open to public on certain festivals: Delhi High Court   ";
  
        $data["og_description"]="     Private temple does not become a public one because it is open to public on certain festivals: Delhi High Court ";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="summary";
  
        $data["twitter_title"]="       Private temple does not become a public one because it is open to public on certain festivals: Delhi High Court   ";
  
        $data["twitter_description"]="      Private temple does not become a public one because it is open to public on certain festivals: Delhi High Court ";
  
        $data["canonical"]="https://insaaf99.com/latest-news/rajesh-giri-vs-subhash-mittal-and-others";

      }

      elseif($da[0]->slug_url=="hijab-verdict-judges-express"){
        $data["title"]="Arbitral Tribunal Must Give Reasons For Fixing Interest Rate; Award Holder ";
        $data["description"]="Hijab Verdict : Judges Express Contrasting Views Regarding Fraternity &Discipline Since divergent views expressed by the Bench, the matter be placed before Honble The Chief Justice of India for constitution of an appropriate Bench.  ";
  
        $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, free legal advice, legal response, law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";
  
        $data["og_url"]="https://insaaf99.com/latest-news/hijab-verdict-judges-express";
  
        $data["og_title"]="   Hijab Verdict : Judges Express Contrasting Views Regarding Fraternity & Discipline Since divergent views expressed by the Bench, the matter be placed before Honble The Chief Justice of India for constitution of an  appropriate Bench.    ";
  
        $data["og_description"]="     Hijab Verdict : Judges Express Contrasting Views Regarding Fraternity & Discipline Since divergent views expressed by the Bench, the matter be placed before Honble The Chief Justice of India for constitution of an appropriate Bench.  ";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="summary";
  
        $data["twitter_title"]="       Hijab Verdict : Judges Express Contrasting Views Regarding Fraternity & Discipline Since divergent views expressed by the Bench, the matter be placed before Honble The Chief Justice of India for constitution of an appropriate Bench.    ";
  
        $data["twitter_description"]="      Hijab Verdict : Judges Express Contrasting Views Regarding Fraternity & Discipline Since divergent views expressed by the Bench, the matter be placed before Honble The Chief Justice of India for constitution of an  appropriate Bench.  ";
  
        $data["canonical"]="https://insaaf99.com/latest-news/hijab-verdict-judges-express";

      }
      
      elseif($da[0]->slug_url=="arbitral-tribunal-must-give-reasons-for-fixing-interest-rate-award-holder-not-entitled-to-interest-for-delay-caused-by-it-supreme-court"){
        $data["title"]=" Arbitral Tribunal Must Give Reasons For Fixing Interest Rate; Award Holder Not Entitled To Interest For Delay Caused By It : Supreme Court ";
        $data["description"]="      Arbitral Tribunal Must Give Reasons For Fixing Interest Rate; Award Holder Not Entitled To Interest For Delay Caused By It : Supreme Court  ";
  
        $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, free legal advice, legal response, law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";
  
        $data["og_url"]="https://insaaf99.com/latest-news/arbitral-tribunal-must-give-reasons-for-fixing-interest-rate-award-holder-not-entitled-to-interest-for-delay-caused-by-it-supreme-court";
  
        $data["og_title"]="    Arbitral Tribunal Must Give Reasons For Fixing Interest Rate; Award Holder Not Entitled To Interest For Delay Caused By It : Supreme Court  ";
  
        $data["og_description"]="Arbitral Tribunal Must Give Reasons For Fixing Interest Rate; Award Holder Not Entitled To Interest For Delay Caused By It : Supreme Court ";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="summary";
  
        $data["twitter_title"]=" Arbitral Tribunal Must Give Reasons For Fixing Interest Rate; Award Holder Not Entitled To Interest For Delay Caused By It : Supreme Court ";
  
        $data["twitter_description"]=" Arbitral Tribunal Must Give Reasons For Fixing Interest Rate; Award Holder Not Entitled To Interest For Delay Caused By It : Supreme Court ";
  
        $data["canonical"]="https://insaaf99.com/latest-news/arbitral-tribunal-must-give-reasons-for-fixing-interest-rate-award-holder-not-entitled-to-interest-for-delay-caused-by-it-supreme-court";

      }
   
      elseif($da[0]->slug_url=="bright-lifecare-pvt-ltd-vs-vini-cosmetics-pvt-ltd-anr"){
        $data["title"]="Distinctive elements in advertising campaigns can be protected under intellectual property laws: Delhi High Court";
        $data["description"]="Distinctive elements in advertising campaigns can be protected under intellectual property laws: Delhi High Court  ";
  
        $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, free legal advice, legal response, law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";
  
        $data["og_url"]="https://insaaf99.com/latest-news/bright-lifecare-pvt-ltd-vs-vini-cosmetics-pvt-ltd-anr";
  
        $data["og_title"]="Distinctive elements in advertising campaigns can be protected under intellectual property laws: Delhi High Court  ";
  
        $data["og_description"]="Distinctive elements in advertising campaigns can be protected under intellectual property laws: Delhi High Court ";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="summary";
  
        $data["twitter_title"]="Distinctive elements in advertising campaigns can be protected under intellectual property laws: Delhi High Court";
  
        $data["twitter_description"]="Distinctive elements in advertising campaigns can be protected under intellectual property laws: Delhi High Court";
  
        $data["canonical"]="https://insaaf99.com/latest-news/bright-lifecare-pvt-ltd-vs-vini-cosmetics-pvt-ltd-anr";

      }

      elseif($da[0]->slug_url=="termination-of-service-has-no-nexus-with-discharge-of-public-duty-mp-high-court-dismisses-writ-against-private-educational-institution"){
        $data["title"]="  Termination of Service Has No Nexus With Discharge of Public Duty: MP High Court Dismisses Writ Against Private Educational Institution  ";
        $data["description"]="Termination of Service Has No Nexus With Discharge of Public Duty: MP High Court Dismisses Writ Against Private Educational Institution   ";
  
        $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, free legal advice, legal response, law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";
  
        $data["og_url"]="https://insaaf99.com/latest-news/termination-of-service-has-no-nexus-with-discharge-of-public-duty-mp-high-court-dismisses-writ-against-private-educational-institution";
  
        $data["og_title"]="     Termination of Service Has No Nexus With Discharge of Public Duty: MP High Court Dismisses Writ Against Private Educational Institution   ";
  
        $data["og_description"]="   Termination of Service Has No Nexus With Discharge of Public Duty: MP High Court Dismisses Writ Against Private Educational Institution  ";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="summary";
  
        $data["twitter_title"]="  Termination of Service Has No Nexus With Discharge of Public Duty: MP High Court Dismisses Writ Against Private Educational Institution  ";
  
        $data["twitter_description"]="  Termination of Service Has No Nexus With Discharge of Public Duty: MP High Court Dismisses Writ Against Private Educational Institution  ";
  
        $data["canonical"]="https://insaaf99.com/latest-news/termination-of-service-has-no-nexus-with-discharge-of-public-duty-mp-high-court-dismisses-writ-against-private-educational-institution";

      } 

      elseif($da[0]->slug_url=="termination-of-service-has-no-nexus-with-discharge-of-public-duty-mp-high-court-dismisses-writ-against-private-educational-institution"){
        $data["title"]="  Termination of Service Has No Nexus With Discharge of Public Duty: MP High Court Dismisses Writ Against Private Educational Institution  ";
        $data["description"]="Termination of Service Has No Nexus With Discharge of Public Duty: MP High Court Dismisses Writ Against Private Educational Institution   ";
  
        $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, free legal advice, legal response, law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";
  
        $data["og_url"]="https://insaaf99.com/latest-news/termination-of-service-has-no-nexus-with-discharge-of-public-duty-mp-high-court-dismisses-writ-against-private-educational-institution";
  
        $data["og_title"]="     Termination of Service Has No Nexus With Discharge of Public Duty: MP High Court Dismisses Writ Against Private Educational Institution   ";
  
        $data["og_description"]="   Termination of Service Has No Nexus With Discharge of Public Duty: MP High Court Dismisses Writ Against Private Educational Institution  ";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="summary";
  
        $data["twitter_title"]="  Termination of Service Has No Nexus With Discharge of Public Duty: MP High Court Dismisses Writ Against Private Educational Institution  ";
  
        $data["twitter_description"]="  Termination of Service Has No Nexus With Discharge of Public Duty: MP High Court Dismisses Writ Against Private Educational Institution  ";
  
        $data["canonical"]="https://insaaf99.com/latest-news/termination-of-service-has-no-nexus-with-discharge-of-public-duty-mp-high-court-dismisses-writ-against-private-educational-institution";

      }

      

      elseif($da[0]->slug_url=="question-whether-cheque-was-issued-for-a-time-barred-debt-or-not-cannot-be-decided-in-a-petition-under-section-482-crpc-supreme-court"){
        $data["title"]="   Question Whether Cheque Was Issued For A Time Barred Debt Or Not Cannot Be Decided In A Petition Under Section 482 CrPC : Supreme Court ";
        $data["description"]=" The Supreme Court observed that the question whether the cheque in question had been issued for a time barred debt or not cannot be decided in a petition under Section 482 CrPC.The bench of Justices";
  
        $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, free legal advice, legal response, law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";
  
        $data["og_url"]="https://insaaf99.com/latest-news/question-whether-cheque-was-issued-for-a-time-barred-debt-or-not-cannot-be-decided-in-a-petition-under-section-482-crpc-supreme-court";
  
        $data["og_title"]="  Question Whether Cheque Was Issued For A Time Barred Debt Or Not Cannot Be Decided In A Petition Under Section 482 CrPC : Supreme Court";
  
        $data["og_description"]=" The Supreme Court observed that the question whether the cheque in question had been issued for a time barred debt or not cannot be decided in a petition under Section 482 CrPC.The bench of Justices";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="summary";
  
        $data["twitter_title"]="  Question Whether Cheque Was Issued For A Time Barred Debt Or Not Cannot Be Decided In A Petition Under Section 482 CrPC : Supreme Court ";
  
        $data["twitter_description"]=" The Supreme Court observed that the question whether the cheque in question had been issued for a time barred debt or not cannot be decided in a petition under Section 482 CrPC.The bench of Justices";
  
        $data["canonical"]="https://insaaf99.com/latest-news/question-whether-cheque-was-issued-for-a-time-barred-debt-or-not-cannot-be-decided-in-a-petition-under-section-482-crpc-supreme-court";

      }
       
      elseif($da[0]->slug_url=="m-s-108-super-complex-r-w-a-vs-uttar-pradesh-pollution-control-board-ors"){
        $data["title"]="    NGT Orders Removal Of Temple Structure From Govt Land Meant For 'Open ";
        $data["description"]=" The Supreme Court observed that the question whether the cheque in question had been issued for a time barred debt or not cannot be decided in a petition under Section 482 CrPC.The bench of Justices";
  
        $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, free legal advice, legal response, law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";
  
        $data["og_url"]="https://insaaf99.com/latest-news/m-s-108-super-complex-r-w-a-vs-uttar-pradesh-pollution-control-board-ors";
  
        $data["og_title"]="   NGT Orders Removal Of Temple Structure From Govt Land Meant For 'Open Space' ";
  
        $data["og_description"]=" NGT Orders Removal Of Temple Structure From Govt Land Meant For 'Open Space";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="summary";
  
        $data["twitter_title"]="  Space' ";
  
        $data["twitter_description"]=" NGT Orders Removal Of Temple Structure From Govt Land Meant For 'Open Space";
  
        $data["canonical"]="https://insaaf99.com/latest-news/m-s-108-super-complex-r-w-a-vs-uttar-pradesh-pollution-control-board-ors";

      }
       
      elseif($da[0]->slug_url=="plea-before-kerala-high-court-seeks-law-against-black-magic-witchcraft-enactment-of-bill-against-superstition-and-human-sacrifice"){
        $data["title"]="    Plea Before Kerala High Court Seeks Law against Black Magic, witchcraft:Enactment Of Bill Against Superstition and Human Sacrifice  ";
        $data["description"]=" Enactment Of Bill Against Superstition and Human Sacrifice";
  
        $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, free legal advice, legal response, law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";
  
        $data["og_url"]="https://insaaf99.com/latest-news/plea-before-kerala-high-court-seeks-law-against-black-magic-witchcraft-enactment-of-bill-against-superstition-and-human-sacrifice";
  
        $data["og_title"]="  Plea Before Kerala High Court Seeks Law against Black Magic, witchcraft: Enactment Of Bill Against Superstition and Human Sacrifice  ";
  
        $data["og_description"]=" NGT Orders Removal Of Temple Structure From Govt Land Meant For 'Open Space";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="summary";
  
        $data["twitter_title"]="  Plea Before Kerala High Court Seeks Law against Black Magic, witchcraft: Enactment Of Bill Against Superstition and Human Sacrifice  ";
  
        $data["twitter_description"]=" NGT Orders Removal Of Temple Structure From Govt Land Meant For 'Open Space";
  
        $data["canonical"]="https://insaaf99.com/latest-news/plea-before-kerala-high-court-seeks-law-against-black-magic-witchcraft-enactment-of-bill-against-superstition-and-human-sacrifice";

      }
      elseif($da[0]->slug_url=="m-s-patil-automation-pvt-ltd-vs-rakheja-engineers-pvt-ltd"){
        $data["title"]="  Court Can Suo Motu Reject A Plaint Under Order VII Rule 11 CPC : Supreme Court  ";
        $data["description"]=" Court Can Suo Motu Reject A Plaint Under Order VII Rule 11 CPC : Supreme Court ";
  
        $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, free legal advice, legal response, law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";
  
        $data["og_url"]="https://insaaf99.com/latest-news/m-s-patil-automation-pvt-ltd-vs-rakheja-engineers-pvt-ltd";
  
        $data["og_title"]=" Court Can Suo Motu Reject A Plaint Under Order VII Rule 11 CPC : Supreme Court ";
  
        $data["og_description"]=" Court Can Suo Motu Reject A Plaint Under Order VII Rule 11 CPC : Supreme Court ";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="summary";
  
        $data["twitter_title"]=" Court Can Suo Motu Reject A Plaint Under Order VII Rule 11 CPC : Supreme Court  ";
  
        $data["twitter_description"]=" Court Can Suo Motu Reject A Plaint Under Order VII Rule 11 CPC : Supreme Court ";
  
        $data["canonical"]="https://insaaf99.com/latest-news/m-s-patil-automation-pvt-ltd-vs-rakheja-engineers-pvt-ltd";

      }

      elseif($da[0]->slug_url=="in-the-supreme-court-of-india-civil-appellate-jurisdiction"){
        $data["title"]=" Merely because maintainability issue was not specifically dealt with by court will not vitiate judgment: Supreme Court ";
        $data["description"]="Merely because maintainability issue was not specifically dealt with by court will not vitiate judgment: Supreme Court.";
  
        $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, free legal advice, legal response, law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";
  
        $data["og_url"]="https://insaaf99.com/latest-news/in-the-supreme-court-of-india-civil-appellate-jurisdiction";
  
        $data["og_title"]="Merely because maintainability issue was not specifically dealt with by ourt will not vitiate judgment: Supreme Court ";
  
        $data["og_description"]="Merely because maintainability issue was not specifically dealt with by court will not vitiate judgment: Supreme Court.";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="summary";
  
        $data["twitter_title"]="Merely because maintainability issue was not specifically dealt with by court will not vitiate judgment: Supreme Court ";
  
        $data["twitter_description"]="Merely because maintainability issue was not specifically dealt with by court will not vitiate judgment: Supreme Court.";
  
        $data["canonical"]="https://insaaf99.com/latest-news/in-the-supreme-court-of-india-civil-appellate-jurisdiction";

      }

      elseif($da[0]->slug_url=="married-daughter-can-t-be-said-to-be-dependant-on-mother-for-compassionate-appointment-supreme-court"){
        $data["title"]=" Married Daughter Can't Be Said To Be Dependant On Mother For Compassionate Appointment: Supreme Court  ";
        $data["description"]="Married Daughter Can't Be Said To Be Dependant On Mother For Compassionate Appointment: Supreme Court ";
  
        $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, free legal advice, legal response, law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";
  
        $data["og_url"]="https://insaaf99.com/latest-news/married-daughter-can-t-be-said-to-be-dependant-on-mother-for-compassionate-appointment-supreme-court";
  
        $data["og_title"]="Married Daughter Can't Be Said To Be Dependant On Mother For Compassionate Appointment: Supreme Court  ";
  
        $data["og_description"]="Married Daughter Can't Be Said To Be Dependant On Mother For Compassionate Appointment: Supreme Court .";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="summary";
  
        $data["twitter_title"]="Married Daughter Can't Be Said To Be Dependant On Mother For Compassionate Appointment: Supreme Court  ";
  
        $data["twitter_description"]="Married Daughter Can't Be Said To Be Dependant On Mother For Compassionate  Appointment: Supreme Court ";
  
        $data["canonical"]="https://insaaf99.com/latest-news/married-daughter-can-t-be-said-to-be-dependant-on-mother-for-compassionate-appointment-supreme-court";

      }

      elseif($da[0]->slug_url=="shaileshbhai-kandubhai-rathwa-v-s-gurjar-shankarlal-devalal"){
        $data["title"]="IN THE HIGH COURT OF GUJARAT AT AHMEDABAD";
        $data["description"]="IN THE HIGH COURT OF GUJARAT AT AHMEDABAD ";
  
        $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, free legal advice, legal response, law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";
  
        $data["og_url"]="https://insaaf99.com/latest-news/shaileshbhai-kandubhai-rathwa-v-s-gurjar-shankarlal-devalal";
  
        $data["og_title"]="IN THE HIGH COURT OF GUJARAT AT AHMEDABAD  ";
  
        $data["og_description"]="IN THE HIGH COURT OF GUJARAT AT AHMEDABAD .";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="summary";
  
        $data["twitter_title"]="IN THE HIGH COURT OF GUJARAT AT AHMEDABAD  ";
  
        $data["twitter_description"]="IN THE HIGH COURT OF GUJARAT AT AHMEDABAD ";
  
        $data["canonical"]="https://insaaf99.com/latest-news/shaileshbhai-kandubhai-rathwa-v-s-gurjar-shankarlal-devalal";

      }
      elseif($da[0]->slug_url=="negotiable-instrument-act-presumption-under-section-139-includes-the-presumption-that-a-debt-or-liability-is-legally-enforceable"){
        $data["title"]="Negotiable Instrument Act - Presumption under Section 139 includes the presumption that a debt or liability is legally enforceable";
        $data["description"]="Negotiable Instrument Act - Presumption under Section 139 includes the presumption that a debt or liability is legally enforceable ";
  
        $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, free legal advice, legal response, law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";
  
        $data["og_url"]="https://insaaf99.com/latest-news/negotiable-instrument-act-presumption-under-section-139-includes-the-presumption-that-a-debt-or-liability-is-legally-enforceable";
  
        $data["og_title"]="Negotiable Instrument Act - Presumption under Section 139 includes the presumption that a debt or liability is legally enforceable  ";
  
        $data["og_description"]="Negotiable Instrument Act - Presumption under Section 139 includes the presumption that a debt or liability is legally enforceable .";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="summary";
  
        $data["twitter_title"]="Negotiable Instrument Act - Presumption under Section 139 includes the presumption that a debt or liability is legally enforceable  ";
  
        $data["twitter_description"]="Negotiable Instrument Act - Presumption under Section 139 includes the presumption that a debt or liability is legally enforceable ";
  
        $data["canonical"]="https://insaaf99.com/latest-news/negotiable-instrument-act-presumption-under-section-139-includes-the-presumption-that-a-debt-or-liability-is-legally-enforceable";

      }
      elseif($da[0]->slug_url=="article-226-petition-cannot-be-filed-seeking-alteration-in-contract-delhi-high-court"){
        $data["title"]="Article 226 petition cannot be filed seeking alteration in contract: Delhi High Court";
        $data["description"]=" ";
  
        $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, free legal advice, legal response, law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";
  
        $data["og_url"]="https://insaaf99.com/latest-news/article-226-petition-cannot-be-filed-seeking-alteration-in-contract-delhi-high-court";
  
        $data["og_title"]="Article 226 petition cannot be filed seeking alteration in contract: Delhi High Court ";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="summary";
  
        $data["twitter_title"]="Article 226 petition cannot be filed seeking alteration in contract: Delhi High Court ";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/article-226-petition-cannot-be-filed-seeking-alteration-in-contract-delhi-high-court";

      }
      elseif($da[0]->slug_url=="when-two-opinions-are-formed-regarding-land-acquisition-compensation-the-supreme-court-has-ruled-that-the-opinion-that-advances-the-cause-of-justice-should-be-preferred"){
        $data["title"]="When two opinions are Formed regarding land acquisition compensation, the Supreme Court has ruled that the opinion that advances the cause of justice should be preferred.";
        $data["description"]=" ";
  
        $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, free legal advice, legal response, law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";
  
        $data["og_url"]="https://insaaf99.com/latest-news/when-two-opinions-are-formed-regarding-land-acquisition-compensation-the-supreme-court-has-ruled-that-the-opinion-that-advances-the-cause-of-justice-should-be-preferred";
  
        $data["og_title"]="When two opinions are Formed regarding land acquisition compensation, the Supreme Court has ruled that the opinion that advances the cause of justice should be preferred. ";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="summary";
  
        $data["twitter_title"]="When two opinions are Formed regarding land acquisition compensation, the Supreme Court has ruled that the opinion that advances the cause of justice should be preferred. ";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/when-two-opinions-are-formed-regarding-land-acquisition-compensation-the-supreme-court-has-ruled-that-the-opinion-that-advances-the-cause-of-justice-should-be-preferred";

      }
      elseif($da[0]->slug_url=="the-six-6-most-important-judgments-under-arbitration-law-in-india"){
        $data["title"]="The Six (6) Most Important Judgments Under Arbitration Law in India";
        $data["description"]=" ";
  
        $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, free legal advice, legal response, law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";
  
        $data["og_url"]="https://insaaf99.com/latest-news/the-six-6-most-important-judgments-under-arbitration-law-in-india";
  
        $data["og_title"]="The Six (6) Most Important Judgments Under Arbitration Law in India ";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="summary";
  
        $data["twitter_title"]="The Six (6) Most Important Judgments Under Arbitration Law in India ";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/the-six-6-most-important-judgments-under-arbitration-law-in-india";

      }
      elseif($da[0]->slug_url=="choice-of-the-mother-high-court-allows-termination-of-33-week-pregnancy"){
        $data["title"]="Choice Of The Mother: High Court Allows Termination Of 33-Week Pregnancy";
        $data["description"]=" ";
  
        $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, free legal advice, legal response, law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";
  
        $data["og_url"]="https://insaaf99.com/latest-news/choice-of-the-mother-high-court-allows-termination-of-33-week-pregnancy";
  
        $data["og_title"]="Choice Of The Mother: High Court Allows Termination Of 33-Week Pregnancy ";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="summary";
  
        $data["twitter_title"]="Choice Of The Mother: High Court Allows Termination Of 33-Week Pregnancy ";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com/latest-news/choice-of-the-mother-high-court-allows-termination-of-33-week-pregnancy";

      }

      else{
        $data["title"]="Latest news";
        $data["description"]="";
  
        $data["keywords"]="";
  
        $data["og_url"]="https://insaaf99.com";
  
        $data["og_title"]="";
  
        $data["og_description"]="";
  
        $data["og_site_name"]="insaaf99.com";
  
        $data["twitter_card"]="summary";
  
        $data["twitter_title"]="";
  
        $data["twitter_description"]="";
  
        $data["canonical"]="https://insaaf99.com";
      }




      $data['news_detail'] =$da[0];
      $data["file"]="front/news_detail";
      $this->load->view('front/template',$data);

        }else{
          echo " Invalid Crediantial";
        }
    }

      // turms =============================================================
    public function turms()
    {
      $data1['table']  = 'category';
      $data1['id']     = '-id'; // Desc when - add
      $data1['limit']     = '20'; // Desc when - add
      $data['categoryMenu']           = $this->getCategory($data1); 
        // Define =========================== 
       
        $data["title"]="Terms of Us | Insaaf99";
        $data["description"]="Free legal advice from top rated advocates in. Consult online, by email and book appointments. Get online legal help.";

        $data["keywords"]="law consultants, legal advisers ask, ask a legal question needs legal help, legal assistance, free legal answers, get free legal answer, find a local lawyers";

        $data["og_url"]="https://insaaf99.com/terms-condition";

        $data["og_title"]="Terms of Us | Insaaf99";

        $data["og_description"]="Free legal advice from top rated advocates in. Consult online, by email and book appointments. Get online legal help";

        $data["og_site_name"]="insaaf99.com";

        $data["twitter_card"]="summary";

        $data["twitter_title"]="Terms of Us | Insaaf99";

        $data["twitter_description"]="Free legal advice from top rated advocates in. Consult online, by email and book appointments. Get online legal help.";

        $data["canonical"]="https://insaaf99.com/terms-condition";
        

       $data["file"]="front/turms";
       $this->load->view('front/template',$data);
    } 
      // policy =============================================================
      public function policy()
      {
        $data1['table']  = 'category';
        $data1['id']     = '-id'; // Desc when - add
        $data1['limit']     = '20'; // Desc when - add
        $data['categoryMenu']           = $this->getCategory($data1); 
  
          // Define =========================== 
          $data["title"]="Privacy Policy | Insaaf99";
          $data["description"]="Consult & Hire the Best Lawyers in India. Top Rated Advocates available for Consultation by Phone, Meeting, Video Call, at your Home";
  
          $data["keywords"]="Free legal advice, lawyer, law, legal advice, legal assistance, legal issues, legal questions, find a lawyer, legal advice, a lawyer, legal questions, legal answers, ";
  
          $data["og_url"]="https://insaaf99.com/privacy-policy";
  
          $data["og_title"]="Privacy & Policy | insaaf99";
  
          $data["og_description"]="Consult & Hire the Best Lawyers in India. Top Rated Advocates available for Consultation by Phone, Meeting, Video Call, at your Home";
  
          $data["og_site_name"]="insaaf99.com";
  
          $data["twitter_card"]="summary";
  
          $data["twitter_title"]="Privacy & Policy | insaaf99";
  
          $data["twitter_description"]="Consult & Hire the Best Lawyers in India. Top Rated Advocates available for Consultation by Phone, Meeting, Video Call, at your Home";
  
          $data["canonical"]="https://insaaf99.com/privacy-policy";

         $data["file"]="front/policy";
         $this->load->view('front/template',$data);
      } 
      // refund =============================================================
      public function refund()
      {
         $data["title"]="refund";
         $data["file"]="front/refund";
         $this->load->view('front/template',$data);
      }
      public function student()
      {
        $data1['table']  = 'category';
        $data1['id']     = '-id'; // Desc when - add
        $data1['limit']     = '20'; // Desc when - add
        $data['categoryMenu']           = $this->getCategory($data1); 
        
        $where=array();
        $where['status']=1;
        $where['orderby']='-id';

        $result=$this->blogs_model->findDynamic($where);
        if(!empty($result)){
                $data['blog_data']=$result;
        }
      

         $data["description"]="Login with Google. Or login with your email. Email address. Password. Forgot your password? Sign in. Benefits. For Students · For Educators";
         $data["title"]="Student Corner";
         $data["file"]="front/student";
         $this->load->view('front/template',$data);
      }
      public function dictionay()
      {
        $data1['table']  = 'category';
        $data1['id']     = '-id'; // Desc when - add
        $data1['limit']     = '20'; // Desc when - add
        $data['categoryMenu']           = $this->getCategory($data1); 

      
        $w['field']='alphabet';
        $alphabet=$this->dictionary_model->findDynamic($w);
        foreach( $alphabet as $key=> $val){
          $res[$key]=$val->alphabet;
          $data['alphabet'][]=$res[$key];
        }
        $data['alphabetForJson']=json_encode($data['alphabet']);

        $w1['limit']=1;
        $result=$this->dictionary_model->findDynamic($w1);
        if(!empty($result)){
          $data['dictionary_data']=$result[0];
        }
      


         $data["title"]="Dictionay";
         $data["file"]="front/dictionay";
         $this->load->view('front/template',$data);
      }

      public function study_materials()
      {
        $data1['table']  = 'category';
        $data1['id']     = '-id'; // Desc when - add
        $data1['limit']     = '20'; // Desc when - add
        $data['categoryMenu']           = $this->getCategory($data1); 

         $data["title"]="Study Materials";
         $data["file"]="front/study_materials";
         $this->load->view('front/template',$data);
      }
     // get data from dictionary table using ajax
      public function getdictionary()
      {
      
        if(isset($_POST['alphabet']) && !empty($_POST['alphabet'])){

          $w['alphabet']=$_POST['alphabet'];
          $result=$this->dictionary_model->findDynamic($w);
              echo json_encode(array($result));
          exit();
        }
          
      }

      public function english()
      {
        if(!empty($_POST)){

          $backPage   = base_url();
          if(isset($_SERVER['HTTP_REFERER'])){
             $backPage  =  $_SERVER['HTTP_REFERER']; 
          }

        
        if(isset($_POST['english']) && !empty($_POST['english'])){
          $language=$_POST['english'];
         setcookie('lang',$language,time()+(86400 * 30),'/');
         setcookie('langText','English',time()+(86400 * 30),'/');

          echo json_encode(array(
            'res'=>'yes',
            'reload' => $backPage
        ));
        exit();
         
        }
       else if(isset($_POST['hindi']) && !empty($_POST['hindi'])){
        $language=$_POST['hindi'];
        setcookie('lang',$language,time()+(86400 * 30),'/');
        setcookie('langText','हिन्दी',time()+(86400 * 30),'/');
   
        echo json_encode(array(
          'res'=>'yes',
          'reload' => $backPage
      ));
      exit();
         
      
        }
        }else{
          echo json_encode(array(
            'res'=>'no',
            'reload' => base_url()
        ));
        exit();
          
        }
        
      }

     
      // set cookie for discleamer 
       public function setCookie(){
        setcookie('disclamer',$_POST['disclamer'],time()+(86400),'/');
       }
      // set cookie for discleamer  end


  
    

   
}

?>