
<?php 
//sitemap.php
$connect = mysqli_connect("localhost", "root", "", "testing");

$query = "SELECT page_url FROM page";

$result = mysqli_query($connect, $query);

$base_url = "http://localhost/tutorial/php-sitemap/";

header("Content-Type: application/xml; charset=utf-8");

echo '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL; 

echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . PHP_EOL;

while($row = mysqli_fetch_array($result))
{
 echo '<url>' . PHP_EOL;
 echo '<loc>'.$base_url. $row["page_url"] .'/</loc>' . PHP_EOL;
 echo '<changefreq>daily</changefreq>' . PHP_EOL;
 echo '</url>' . PHP_EOL;
}

echo '</urlset>' . PHP_EOL;

?>


.htaccess


RewriteEngine On

RewriteRule ^sitemap\.xml/?$ sitemap.php


Database


--
-- Database: `testing`
--

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `page_id` int(11) NOT NULL,
  `page_title` text NOT NULL,
  `page_url` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`page_id`, `page_title`, `page_url`) VALUES
(1, 'JSON - Dynamic Dependent Dropdown List using Jquery and Ajax', 'json-dynamic-dependent-dropdown-list-using-jquery-and-ajax'),
(2, 'Live Table Data Edit Delete using Tabledit Plugin in PHP', 'live-table-data-edit-delete-using-tabledit-plugin-in-php'),
(3, 'Create Treeview with Bootstrap Treeview Ajax JQuery in PHP\r\n', 'create-treeview-with-bootstrap-treeview-ajax-jquery-in-php'),
(4, 'Bootstrap Multiselect Dropdown with Checkboxes using Jquery in PHP\r\n', 'bootstrap-multiselect-dropdown-with-checkboxes-using-jquery-in-php'),
(5, 'Facebook Style Popup Notification using PHP Ajax Bootstrap\r\n', 'facebook-style-popup-notification-using-php-ajax-bootstrap'),
(6, 'Modal with Dynamic Previous & Next Data Button by Ajax PHP\r\n', 'modal-with-dynamic-previous-next-data-button-by-ajax-php'),
(7, 'How to Use Bootstrap Select Plugin with Ajax Jquery PHP\r\n', 'how-to-use-bootstrap-select-plugin-with-ajax-jquery-php'),
(8, 'How to Load CSV File data into HTML Table Using AJAX jQuery\r\n', 'how-to-load-csv-file-data-into-html-table-using-ajax-jquery'),
(9, 'Autocomplete Textbox using Typeahead with Ajax PHP Bootstrap\r\n', 'autocomplete-textbox-using-typeahead-with-ajax-php-bootstrap'),
(10, 'Export Data to Excel in Codeigniter using PHPExcel\r\n', 'export-data-to-excel-in-codeigniter-using-phpexcel');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`page_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;

Share This:   Facebook Twitter Google+ Stumble Digg
Email This
BlogThis!
Share to Twitter
Share to Facebook
Related Posts:
Make Dynamic XML sitemap in PHP Script
If you want to create dynamic sitemap for your website in PHP, then you have come very right place, because in this tutorial we have make discuss… Read More
Newer PostOlder PostHome
24 comments:

MD Morsed Alom10 November 2017 at 10:10
http://BDMTube.ga site map

Reply

Unknown16 March 2018 at 08:46
nice!
Big thx!

Reply

Moin Uddin Blog21 March 2018 at 09:10
Thank You

Reply

Anything7 December 2018 at 00:46
I have a Statics Website Solar panel Manufacturers how to create dynamic sitemap for a static website?

Reply
Replies

Davyd8 May 2019 at 04:04
No need to create dynamic sitemap for static website. static means you already know all the url of your website so just include them in your sitemap. Dynamic sitemap are for dynamic websites wher url and pages are created dynamicaly.

Reply

reza4 March 2019 at 08:48
Thank you so much for sharing your code. i wish best for you.

Reply

Unknown19 April 2019 at 06:35
thankyou soo much for making sitemap creation so easy. this really means alot. thankyou once again :)

Reply

sex incest online12 June 2019 at 15:34
i have site https://sexincest.online/ want to see its normal or not

Reply

Team Member5 October 2019 at 09:03
If I write URL domain.com/something-any-word website is running properly. But I need a sitemap in XML format so I write PHP code in sitemap.php. I want in runtime sitemap.xml

my current .htaccess file is working
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php?url=$1 [QSA,L]

but i write in this your suggested RewriteRule website not work. How to solve it? Please guide me.

Reply

Unknown7 February 2020 at 03:33
latest Sarkari Job and Sarkari job searchSarkariresultSarkarijobsearch

Reply

Unknown14 March 2020 at 06:00
nice

Reply

mylyricszone27 April 2020 at 12:08
Hello Sir,

This PHP Scripts something error in hosting thats for not working please help me

This is error URL link - https://prnt.sc/s6yho3

Please sir help me!!

Reply

Trinesh14 May 2020 at 06:22
Thank You! Very Much Sir

Can you please tell me How it use full for SEO?

Reply

Vivek1 July 2020 at 07:05
Go to the https://www.xml-sitemaps.com/
Submit your Website URL
It will automatically generate sitemap.
Download it & upload to your root folder
& submit sitemap uRL to Search Console

Reply
Replies

jonatan26 December 2020 at 11:17
not dynamic

Reply

Admin - HK Technical8 September 2020 at 05:45
Thanks a lot. It solved my problem. Thankyou.

Reply

Doshi Outsourcing9 September 2020 at 05:00
This comment has been removed by a blog administrator.

Reply

Jun Frianto Purba19 April 2021 at 09:18
Whereis the script to update database? I think its not dynamic

Reply

Tamil Lover8 June 2021 at 07:04
thanks a lot thalaivaa

Reply

Unknown28 August 2021 at 16:54
Thank you. Although i have a problem setting it up on code igniter. I mean using controllers

Reply

Unknow27 November 2021 at 06:56
Thanks alot, it really work for me

Reply

Unknow27 November 2021 at 06:57
thanks

Reply

Unknow27 November 2021 at 06:57
thanks

Reply

Aquatec Innovative Private Limited27 January 2022 at 01:53
can you please tell me what editor are you using?

Reply



Popular Posts
Restaurant Management System in PHP With Source Code
Library Management System Project in PHP with Source Code
Bootstrap 5 Select Dropdown with Search Box using Vanilla JavaScript PHP MySQL
Ajax Live Data Search using Jquery PHP MySql
Laravel 8 Tutorial - Join Multiple Table using Eloquent Model
Build Real time Chat Application in PHP Mysql using WebSocket
Build Laravel 9 CRUD Application with MySQL & Bootstrap 5
Online Doctor Appointment System Project in PHP Mysql
How to Display Excel Data in HTML Table using JavaScript
PHP Login Registration with Email Verification using OTP
Search for:
Search
 
Copyright © 2022 Webslesson