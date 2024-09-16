<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


require APPPATH . '/libraries/BaseController.php';

use Razorpay\Api\Api;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class Sitemap extends BaseController
{
    
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('base_library');
        $this->load->model('admin/Category_model');
        $this->load->model('admin/latest_News_model');
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

        $a               = array();
        $a['table']  = 'news';
        $data['latest_news'] = $this->latest_News_model->findDynamic($a);

        $c               = array();
        $c['table']  = 'dictionary';
        $data['dictionaryData'] = $this->latest_News_model->findDynamic($c);

        $d               = array();
        $d['table']  = 'acts';
        $d['act_type']  = 4;
        $data['constitutionData'] = $this->latest_News_model->findDynamic($d);

        $e               = array();
        $e['table']  = 'acts';
        $e['act_type']  = 5;
        $data['ipcData'] = $this->latest_News_model->findDynamic($e);

        $f               = array();
        $f['table']  = 'acts';
        $f['act_type']  = 6;
        $data['crpcData'] = $this->latest_News_model->findDynamic($f);

        $f               = array();
        $f['table']  = 'acts';
        $f['act_type']  = 7;
        $data['cpcData'] = $this->latest_News_model->findDynamic($f);

        $f               = array();
        $f['table']  = 'acts';
        $f['act_type']  = 8;
        $data['dvData'] = $this->latest_News_model->findDynamic($f);

        $lang               = array();
        $lang['table']  = 'acts';
        $lang['act_type']  = 9;
        $data['mvData'] = $this->latest_News_model->findDynamic($lang);

        $lang               = array();
        $lang['table']  = 'acts';
        $lang['act_type']  = 11;
        $data['ieData'] = $this->latest_News_model->findDynamic($lang);

        $lang               = array();
        $lang['table']  = 'acts';
        $lang['act_type']  = 12;
        $data['hmaData'] = $this->latest_News_model->findDynamic($lang);

        $lang               = array();
        $lang['table']  = 'acts';
        $lang['act_type']  = 13;
        $data['icaData'] = $this->latest_News_model->findDynamic($lang);

        $lang               = array();
        $lang['table']  = 'acts';
        $lang['act_type']  = 14;
        $data['esiaData'] = $this->latest_News_model->findDynamic($lang);

        $lang               = array();
        $lang['table']  = 'acts';
        $lang['act_type']  = 15;
        $data['epfaData'] = $this->latest_News_model->findDynamic($lang);

        $base_url=base_url();
        $pr='1.0';
        $spr='0.80';
        $dpr='0.64';

        $html1='';
        $html1.='<urlset xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

      if($base_url="https://insaaf99.com/"){
        $html1.= '<url>'.PHP_EOL;
           $html1.= '<loc>https://insaaf99.com</loc>'.PHP_EOL;
           $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
           $html1.= '<priority>'.$pr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;
        }
        
        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'legal-advice</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;
        
        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'specialization</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;

        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'specialization/what-is-intellectual-property-rights</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;

        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'specialization/cyber-crimes</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;

        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'specialization/litigation-lawyer</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;

        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'specialization/real-estate-practice</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;

        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'specialization/what-is-family-law-practice</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;

        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'specialization/start-ups</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;

        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'specialization/arbitration-and-dispute-resolution</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;
        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'specialization/banking-insolvency-law</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;


        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'specialization/start-up/partnership-firm</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;

        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'specialization/start-up/proprietorship-one-person-company</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;

        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'specialization/start-up/limited-liability-partnership</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;

        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'specialization/start-up/private-limited-company</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;

        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'specialization/start-up/design</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;

        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'specialization/start-up/patents</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;

        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'specialization/start-up/trademark</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;
        
        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'specialization/start-up/copyright</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;
        
        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'specialization/documentation/non-disclosure-agreement</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;
        
        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'specialization/documentation/non-compete-agreement</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;
        
        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'specialization/documentation/service-agreement</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;
        
        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'specialization/documentation/franchise-agreement</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;
        
        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'specialization/documentation/partnership-deed</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;
        
        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'specialization/documentation/memorandum-of-understanding</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;
        
        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'specialization/documentation/joint-venture-agreement</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;
        
        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'specialization/documentation/sale-deed</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;
        
        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'specialization/documentation/rent-agreement</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;
        
        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'specialization/documentation/lease-license-agreement</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;
        
        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'specialization/documentation/gift-deed</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;
        
        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'specialization/documentation/eviction-notice</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;
        
        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'specialization/documentation/partition-deed</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;
        
        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'specialization/documentation/relinquishment-deed</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;
        
        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'specialization/documentation/power-of-attorney</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;
        
        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'specialization/documentation/will</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;
        
        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'specialization/documentation/termination-notice</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;
        
        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'specialization/documentation/legal-recovery-notice</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;
        
        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'specialization/documentation/cheque-bounce</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;
        
        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'specialization/documentation/promissory-note</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;
        
        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'specialization/documentation/loans-agreements</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;
        
        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'specialization/documentation/refund-of-security-notices</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;
        
        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'specialization/documentation/recovery-of-dues</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;
        
        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'specialization/documentation/terms-of-use</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;
        
        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'specialization/documentation/website-development-agreement</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;
        
        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'specialization/documentation/privacy-policy</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;
        
        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'specialization/documentation/website-maintanence-agreement</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;
        
        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'specialization/documentation/appointment-letter</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;
        
        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'specialization/documentation/employment-contract-agreement</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;

        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'specialization/documentation/indemnity-bond</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;

        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'specialization/documentation/consultancy-agreement</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;

        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'signup?type=lawyer</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;

        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'lawyer-terms-conditions</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;

        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'signup?type=client</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;

        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'client-terms-conditions</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;

        
        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'about-us</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;
        
        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'contact-us</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;
        
        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'terms-condition</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;
        
        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'privacy-policy</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;
        
        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'student-corner</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;

        $html1.= '<url>'.PHP_EOL;
        $html1.= '<loc>'.$base_url.'blog</loc>'.PHP_EOL;
        $html1.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html1.= '<priority>'.$dpr.'</priority>'.PHP_EOL;
        $html1.= '</url>'.PHP_EOL;

        
        $data['html']= $html1;
        $html1.= '</urlset>'.PHP_EOL;
        $file=fopen('sitemap1.xml','w');
        fwrite($file,$html1);



        // news sitemap start 
        $html2='';
        $html2.='<urlset xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

        $html2.= '<url>'.PHP_EOL;
        $html2.= '<loc>'.$base_url.'all-news</loc>'.PHP_EOL;
        $html2.= '<changefreq>weekly</changefreq>'.PHP_EOL;
        $html2.= '<priority>'.$spr.'</priority>'.PHP_EOL;
        $html2.= '</url>'.PHP_EOL;

        foreach($data['latest_news'] as $value)
        {
          $html2.= '<url>'.PHP_EOL;
          $html2.= '<loc>'.$base_url.'latest-news/'.$value->slug_url.'</loc>'.PHP_EOL;
          $html2.= '<changefreq>weekly</changefreq>'.PHP_EOL;
          $html2.= '<priority>'.$dpr.'</priority>'.PHP_EOL;
          $html2.= '</url>'.PHP_EOL; 
          
        }
        $html2.= '</urlset>'.PHP_EOL;
        $file=fopen('sitemap2.xml','w');
        fwrite($file,$html2);
        // news sitemap end

          // dictionary  sitemap start
          $html4='';
          $html4.='<urlset xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

          $html4.= '<url>'.PHP_EOL;
          $html4.= '<loc>'.$base_url.'student-corner/dictionay</loc>'.PHP_EOL;
          $html4.= '<changefreq>weekly</changefreq>'.PHP_EOL;
          $html4.= '<priority>'.$dpr.'</priority>'.PHP_EOL;
          $html4.= '</url>'.PHP_EOL;

          foreach($data['dictionaryData'] as $value)
          {
            $html4.= '<url>'.PHP_EOL;
            $html4.= '<loc>'.$base_url.'student-corner/dictionay#'.ucfirst($value->slug).'</loc>'.PHP_EOL;
            $html4.= '<changefreq>weekly</changefreq>'.PHP_EOL;
            $html4.= '<priority>'.$dpr.'</priority>'.PHP_EOL;
            $html4.= '</url>'.PHP_EOL; 
          }
          $html4.= '</urlset>'.PHP_EOL;
          $file=fopen('sitemap3.xml','w');
          fwrite($file,$html4);
          // dictionaryData sitemap end

          // constitution  sitemap start
          $html5='';
          $html5.='<urlset xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;
          
          $html5.= '<url>'.PHP_EOL;
          $html5.= '<loc>'.$base_url.'student-corner/bare-acts</loc>'.PHP_EOL;
          $html5.= '<changefreq>weekly</changefreq>'.PHP_EOL;
          $html5.= '<priority>'.$dpr.'</priority>'.PHP_EOL;
          $html5.= '</url>'.PHP_EOL; 

          foreach($data['constitutionData'] as $value)
          {
            $html5.= '<url>'.PHP_EOL;
            $html5.= '<loc>'.$base_url.'student-corner/bare-acts/detail/'.$value->slug_url.'</loc>'.PHP_EOL;
            $html5.= '<changefreq>weekly</changefreq>'.PHP_EOL;
            $html5.= '<priority>'.$dpr.'</priority>'.PHP_EOL;
            $html5.= '</url>'.PHP_EOL; 
            
          }
          $html5.= '</urlset>'.PHP_EOL;
          $file=fopen('sitemap4.xml','w');
          fwrite($file,$html5);
          // constitution  sitemap end

          // Indian Penal Code  sitemap start
          $html6='';
          $html6.='<urlset xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

          foreach($data['ipcData'] as $value)
          {
            $html6.= '<url>'.PHP_EOL;
            $html6.= '<loc>'.$base_url.'student-corner/bare-acts/detail/'.$value->slug_url.'</loc>'.PHP_EOL;
            $html6.= '<changefreq>weekly</changefreq>'.PHP_EOL;
            $html6.= '<priority>'.$dpr.'</priority>'.PHP_EOL;
            $html6.= '</url>'.PHP_EOL; 
            
          }

          $html6.= '</urlset>'.PHP_EOL;
          $file=fopen('sitemap5.xml','w');
          fwrite($file,$html6);
          // Indian Penal Code  sitemap end


          // Code Of Criminal Procedure 1973  sitemap start
          $html7='';
          $html7.='<urlset xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

          foreach($data['crpcData'] as $value)
          {
            $html7.= '<url>'.PHP_EOL;
            $html7.= '<loc>'.$base_url.'student-corner/bare-acts/detail/'.$value->slug_url.'</loc>'.PHP_EOL;
            $html7.= '<changefreq>weekly</changefreq>'.PHP_EOL;
            $html7.= '<priority>'.$dpr.'</priority>'.PHP_EOL;
            $html7.= '</url>'.PHP_EOL; 
            
          }
          $html7.= '</urlset>'.PHP_EOL;
  
          $file=fopen('sitemap6.xml','w');
          fwrite($file,$html7);
          // Code Of Criminal Procedure 1973  sitemap end

          // The Civil Procedure Code 1908 sitemap start
          $html8='';
          $html8.='<urlset xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

          foreach($data['cpcData'] as $value)
          {
            $html8.= '<url>'.PHP_EOL;
            $html8.= '<loc>'.$base_url.'student-corner/bare-acts/detail/'.$value->slug_url.'</loc>'.PHP_EOL;
            $html8.= '<changefreq>weekly</changefreq>'.PHP_EOL;
            $html8.= '<priority>'.$dpr.'</priority>'.PHP_EOL;
            $html8.= '</url>'.PHP_EOL; 
            
          }
          $html8.= '</urlset>'.PHP_EOL;
          $file=fopen('sitemap7.xml','w');
          fwrite($file,$html8);
          // The Civil Procedure Code 1908 sitemap end

          // Protection of Women from Domestic Violence Act, 20 sitemap start
          $html9='';
          $html9.='<urlset xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

          foreach($data['dvData'] as $value)
          {
            $html9.= '<url>'.PHP_EOL;
            $html9.= '<loc>'.$base_url.'student-corner/bare-acts/detail/'.$value->slug_url.'</loc>'.PHP_EOL;
            $html9.= '<changefreq>weekly</changefreq>'.PHP_EOL;
            $html9.= '<priority>'.$dpr.'</priority>'.PHP_EOL;
            $html9.= '</url>'.PHP_EOL; 
            
          }
          $html9.= '</urlset>'.PHP_EOL;
          $file=fopen('sitemap8.xml','w');
          fwrite($file,$html9);
          // Protection of Women from Domestic Violence Act, 20 sitemap end

          // Motor Vehicle Act ,1988 sitemap start
          $html10='';
          $html10.='<urlset xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;
          foreach($data['mvData'] as $value)
          {
            $html10.= '<url>'.PHP_EOL;
            $html10.= '<loc>'.$base_url.'student-corner/bare-acts/detail/'.$value->slug_url.'</loc>'.PHP_EOL;
            $html10.= '<changefreq>weekly</changefreq>'.PHP_EOL;
            $html10.= '<priority>'.$dpr.'</priority>'.PHP_EOL;
            $html10.= '</url>'.PHP_EOL; 
            
          }
          $html10.= '</urlset>'.PHP_EOL;
          $file=fopen('sitemap9.xml','w');
          fwrite($file,$html10);
          // Motor Vehicle Act ,1988 sitemap end

          // The Indian Evidence Act 1872 sitemap start
          $html11='';
          $html11.='<urlset xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

          foreach($data['ieData'] as $value)
          {
            $html11.= '<url>'.PHP_EOL;
            $html11.= '<loc>'.$base_url.'student-corner/bare-acts/detail/'.$value->slug_url.'</loc>'.PHP_EOL;
            $html11.= '<changefreq>weekly</changefreq>'.PHP_EOL;
            $html11.= '<priority>'.$dpr.'</priority>'.PHP_EOL;
            $html11.= '</url>'.PHP_EOL; 
            
          }
          $html11.= '</urlset>'.PHP_EOL;
          $file=fopen('sitemap10.xml','w');
          fwrite($file,$html11);
          // The Indian Evidence Act 1872 sitemap end
          
          // THE HINDU MARRIAGE ACT, 1955 sitemap start
          $html12='';
          $html12.='<urlset xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

          foreach($data['hmaData'] as $value)
          {
            $html12.= '<url>'.PHP_EOL;
            $html12.= '<loc>'.$base_url.'student-corner/bare-acts/detail/'.$value->slug_url.'</loc>'.PHP_EOL;
            $html12.= '<changefreq>weekly</changefreq>'.PHP_EOL;
            $html12.= '<priority>'.$dpr.'</priority>'.PHP_EOL;
            $html12.= '</url>'.PHP_EOL; 
            
          }

          $html12.= '</urlset>'.PHP_EOL;
          $file=fopen('sitemap11.xml','w');
          fwrite($file,$html12);
          // THE HINDU MARRIAGE ACT, 1955 sitemap end


          // THE INDIAN CONTRACT ACT, 1872 sitemap start
          $html13='';
          $html13.='<urlset xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

          foreach($data['icaData'] as $value)
          {
            $html13.= '<url>'.PHP_EOL;
            $html13.= '<loc>'.$base_url.'student-corner/bare-acts/detail/'.$value->slug_url.'</loc>'.PHP_EOL;
            $html13.= '<changefreq>weekly</changefreq>'.PHP_EOL;
            $html13.= '<priority>'.$dpr.'</priority>'.PHP_EOL;
            $html13.= '</url>'.PHP_EOL; 
            
          }

          $html13.= '</urlset>'.PHP_EOL;
  
          $file=fopen('sitemap12.xml','w');
          fwrite($file,$html13);
          // THE INDIAN CONTRACT ACT, 1872 sitemap end
          
          // THE EMPLOYEES’ STATE INSURANCE ACT, 1948 sitemap start
          $html14='';
          $html14.='<urlset xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

          foreach($data['esiaData'] as $value)
          {
            $html14.= '<url>'.PHP_EOL;
            $html14.= '<loc>'.$base_url.'student-corner/bare-acts/detail/'.$value->slug_url.'</loc>'.PHP_EOL;
            $html14.= '<changefreq>weekly</changefreq>'.PHP_EOL;
            $html14.= '<priority>'.$dpr.'</priority>'.PHP_EOL;
            $html14.= '</url>'.PHP_EOL; 
            
          }

          $html14.= '</urlset>'.PHP_EOL;
  
          $file=fopen('sitemap13.xml','w');
          fwrite($file,$html14);
          // THE EMPLOYEES’ STATE INSURANCE ACT, 1948 sitemap end
          
          // THE EMPLOYEES’ STATE INSURANCE ACT, 1948 sitemap start
          $html15='';
          $html15.='<urlset xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

          foreach($data['epfaData'] as $value)
          {
            $html15.= '<url>'.PHP_EOL;
            $html15.= '<loc>'.$base_url.'student-corner/bare-acts/detail/'.$value->slug_url.'</loc>'.PHP_EOL;
            $html15.= '<changefreq>weekly</changefreq>'.PHP_EOL;
            $html15.= '<priority>'.$dpr.'</priority>'.PHP_EOL;
            $html15.= '</url>'.PHP_EOL; 
            
          }

          $html15.= '</urlset>'.PHP_EOL;
  
          $file=fopen('sitemap14.xml','w');
          fwrite($file,$html15);
          // THE EMPLOYEES’ STATE INSURANCE ACT, 1948 sitemap end
        

        // base sitemap file start
        $html ='';
        $html.='<sitemapindex  xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

        $html.='<sitemap>'.PHP_EOL;
        $html.='<loc>'.$base_url.'sitemap1.xml</loc>'.PHP_EOL;
        $html.='</sitemap>'.PHP_EOL;
        $html.='<sitemap>'.PHP_EOL;
        $html.='<loc>'.$base_url.'sitemap2.xml</loc>'.PHP_EOL;
        $html.='</sitemap>'.PHP_EOL;
        $html.='<sitemap>'.PHP_EOL;
        $html.='<loc>'.$base_url.'sitemap3.xml</loc>'.PHP_EOL;
        $html.='</sitemap>'.PHP_EOL;
        $html.='<sitemap>'.PHP_EOL;
        $html.='<loc>'.$base_url.'sitemap4.xml</loc>'.PHP_EOL;
        $html.='</sitemap>'.PHP_EOL;
        $html.='<sitemap>'.PHP_EOL;
        $html.='<loc>'.$base_url.'sitemap5.xml</loc>'.PHP_EOL;
        $html.='</sitemap>'.PHP_EOL;
        $html.='<sitemap>'.PHP_EOL;
        $html.='<loc>'.$base_url.'sitemap6.xml</loc>'.PHP_EOL;
        $html.='</sitemap>'.PHP_EOL;
        $html.='<sitemap>'.PHP_EOL;
        $html.='<loc>'.$base_url.'sitemap7.xml</loc>'.PHP_EOL;
        $html.='</sitemap>'.PHP_EOL;
        $html.='<sitemap>'.PHP_EOL;
        $html.='<loc>'.$base_url.'sitemap8.xml</loc>'.PHP_EOL;
        $html.='</sitemap>'.PHP_EOL;
        $html.='<sitemap>'.PHP_EOL;
        $html.='<loc>'.$base_url.'sitemap9.xml</loc>'.PHP_EOL;
        $html.='</sitemap>'.PHP_EOL;
        $html.='<sitemap>'.PHP_EOL;
        $html.='<loc>'.$base_url.'sitemap10.xml</loc>'.PHP_EOL;
        $html.='</sitemap>'.PHP_EOL;
        $html.='<sitemap>'.PHP_EOL;
        $html.='<loc>'.$base_url.'sitemap11.xml</loc>'.PHP_EOL;
        $html.='</sitemap>'.PHP_EOL;
        $html.='<sitemap>'.PHP_EOL;
        $html.='<loc>'.$base_url.'sitemap12.xml</loc>'.PHP_EOL;
        $html.='</sitemap>'.PHP_EOL;
        $html.='<sitemap>'.PHP_EOL;
        $html.='<loc>'.$base_url.'sitemap13.xml</loc>'.PHP_EOL;
        $html.='</sitemap>'.PHP_EOL;
        $html.='<sitemap>'.PHP_EOL;
        $html.='<loc>'.$base_url.'sitemap14.xml</loc>'.PHP_EOL;
        $html.='</sitemap>'.PHP_EOL;
        $html.= '</sitemapindex>'.PHP_EOL;
        
        $file=fopen('sitemap.xml','w');
        fwrite($file,$html);
        // base sitemap file end 
    } 
     
      
}

?>