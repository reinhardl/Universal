<?php
if (IN_serendipity !== true) {
  die ("Don't hack!");
}

@serendipity_plugin_api::load_language(dirname(__FILE__));

$serendipity['smarty']->assign('archiveURL', serendipity_rewriteURL(PATH_ARCHIVE));
$serendipity['smarty']->assign(array('currpage'  => "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],
                                     'currpage2' => $_SERVER['REQUEST_URI'])); 
									 
									 
									 	

//  Gallery via entryproperties plugin for single entries 
 
function serendipity_template_smarty_getdir($params, $smarty)  {
    global $serendipity;
       if (!empty($params['element'])) {
        foreach (glob($serendipity['serendipityPath'].$params['element'] . '/*.serendipityThumb.*') as $file) {$filelist[] = basename($file); }
        asort($filelist); }
    $smarty->assign('filelist', $filelist);}                    
$serendipity['smarty']->registerPlugin('function', 'serendipity_template_getdir', 'serendipity_template_smarty_getdir'); 
  

  
// tags in statischen Seiten									 
 function smarty_show_tags($params, &$smarty) {
    global $serendipity;
    echo "<!-- SMARTY SHOW CALL: " . htmlspecialchars(serialize($params)) . " -->\n";
    $o = $serendipity['GET']['tag'];
    echo "<!-- Preserving original tag: " . htmlspecialchars($o) . " -->\n";
    $serendipity['GET']['tag'] = $params['tag'];
    echo "<!-- Filter by tag: " . htmlspecialchars($serendipity['GET']['tag']) . " -->\n";
    $e = serendipity_smarty_fetchPrintEntries($params, $smarty);
    echo "<!-- TPL output start... -->\n";
    echo $e;
    echo "<!-- TPL output end... -->\n";
    if (!empty($o)) {
        $serendipity['GET']['tag'] = $o;
    } else {
        unset($serendipity['GET']['tag']);
    }
    //print_r($params);
}
$serendipity['smarty']->register_function('show_tags', 'smarty_show_tags');

 

  function smarty_function_global($params, Smarty_Internal_Template $template) {
    if (isset($params['put'])) {
         // assign variable to template object scope
         $template->assign($params['put'], $params['value']);
    }

    if (isset($params['get'])) {
        return $params['get'];
    }
}

$serendipity['smarty']->registerPlugin('function', 'global', 'smarty_function_global'); 


 
 
 
 
	
// show elapsed time in words, such as x hours ago.
function distanceOfTimeInWords($fromTime, $toTime = 0) {
    $distanceInSeconds = round(abs($toTime - $fromTime));
    $distanceInMinutes = round($distanceInSeconds / 60);
       
    if ( $distanceInMinutes <= 1 ) {
        if ( $distanceInSeconds < 60 ) {
            return ELAPSED_LESS_THAN_MINUTE_AGO;
        }
        return ELAPSED_ONE_MINUTE_AGO;
    }
    if ( $distanceInMinutes < 45 ) {
        return (sprintf(ELAPSED_MINUTES_AGO, $distanceInMinutes));
    }
    if ( $distanceInMinutes < 90 ) {
        return ELAPSED_ABOUT_ONE_HOUR_AGO;
    }
    // less than 24 hours
    if ( $distanceInMinutes < 1440 ) {
        return (sprintf(ELAPSED_HOURS_AGO, round(floatval($distanceInMinutes) / 60.0)));
    }
    //less than 48hours
    if ( $distanceInMinutes < 2880 ) {
        return ELAPSED_ONE_DAY_AGO;
    }
    // less than 30 days
    if ( $distanceInMinutes < 43200 ) {
        return (sprintf(ELAPSED_DAYS_AGO, round(floatval($distanceInMinutes) / 1440)));
    }
    //less than 60 days
    if ( $distanceInMinutes < 86400 ) {
        return ELAPSED_ABOUT_ONE_MONTH_AGO;
    }
    // less than 365 days
    if ( $distanceInMinutes < 525600 ) {
        return (sprintf(ELAPSED_MONTHS_AGO, round(floatval($distanceInMinutes) / 43200)));
    }
    // less than 2 years
    if ( $distanceInMinutes < 1051199 ) {
        return ELAPSED_ABOUT_ONE_YEAR_AGO;
    }
    return (sprintf(ELAPSED_OVER_YEARS_AGO, round(floatval($distanceInMinutes) / 525600)));
}

// smarty function to use distanceOfTimeInWords function
// call from tpl as {elapsed_time_words from_time=$comment.timestamp}
$serendipity['smarty']->register_function('elapsed_time_words', 'timeAgoInWords');

function timeAgoInWords($params, &$smarty) {
        return distanceOfTimeInWords($params['from_time'], time());
    }

if (class_exists('serendipity_event_entryproperties')) {
    $ep_msg=THEME_EP_YES;
    } else {
    $ep_msg=THEME_EP_NO;
} 
 $all_cats1 = serendipity_fetchCategories('all');$kategorien = array();$catdata = array();
  $catselurl = array();
  $catselurl[0] = NONE;
foreach($all_cats1 as $cat) {
					   $catselurl[$cat['categoryid']] = serendipity_categoryURL($cat);
                       $cat['link'] = serendipity_categoryURL($cat);
                       $cat['name'] = $cat['category_name'];
                       $kategorien[$cat['categoryid']] = $cat;
					   $catdata[$cat['categoryid']] = $cat;
                     }
$serendipity['smarty']->assign_by_ref('kategorien', $kategorien);


 $all_cats = serendipity_fetchCategories('all');
  $all_cats = serendipity_walkRecursive($all_cats, 'categoryid', 'parentid', VIEWMODE_THREADED);
  $catsel = array();
  $catsel[0] = NONE;
  foreach($all_cats AS $cat) {
    $catsel[$cat['categoryid']] = str_repeat('-', $cat['depth']) . $cat['category_name'];
  }
 $all_cats = serendipity_fetchCategories('all');
 

 

 
$template_config = array(
    array(
        'var'           => 'startpagerows_enable',
        'name'          => STARTPAGEROWS_ENABLE,
        'type'          => 'boolean',
        'default'       => false,
    ), 
	array(
      'var'           => 'startpagerows_seq',
      'name'          => REIHENFOLGE,
	  'description'   => REIHENFOLGE_DESC,	  
      'type'          => 'select',
      'default'       => '4',
      'select_values' => array('1','2','3','4','5','6','7','8','9'),
    ),
    array(
        'var'           => 'latestPost_enable',
        'name'          => LATEST_POST_ENABLE,
        'type'          => 'boolean',
        'default'       => false,
    ), 
	
	    array(
        'var'           => 'latestPost_description',
        'name'          => LATESTPOST_DESCRIPTION,
        'type'          => 'content',
        'default'       =>  LATESTPOST_DESCRIPTION,
    ),	
	
	
     array(
      'var'           => 'latestPost_cat1',
      'name'          => LATEST_POST_CAT1,
      'type'          => 'select',
      'default'       => '',
      'select_values' => $catsel,
    ),
      array(
      'var'           => 'latestPost_cat2',
      'name'          => LATEST_POST_CAT2,
      'type'          => 'select',
      'default'       => '',
      'select_values' => $catsel,
    ),
    array(
        'var'           => 'latestPost_amount1',
        'name'          => LATEST_POST_AMOUNT1,
        'type'          => 'string',
        'default'       => '3',
    ),		
    array(
        'var'           => 'latestPost_amount2',
        'name'          => LATEST_POST_AMOUNT2,
        'type'          => 'string',
        'default'       => '3',
    ),
    array(
        'var'           => 'latestPost_header1',
        'name'          => LATEST_POST_HEADER1,
        'type'          => 'string',
        'default'       => LATEST_POST_HEADER1,
    ),		
    array(
        'var'           => 'latestPost_header2',
        'name'          => LATEST_POST_HEADER2,
        'type'          => 'string',
        'default'       => LATEST_POST_HEADER2,
    ),		
    array(
        'var'           => 'latestPost_textcount1',
        'name'          => LATEST_POST_TEXTCOUNT1,
        'type'          => 'string',
        'default'       => '100',
    ),		
    array(
        'var'           => 'latestPost_textcount2',
        'name'          => LATEST_POST_TEXTCOUNT2,
        'type'          => 'string',
        'default'       => '130',
    ),	
 	array(
      'var'           => 'latestPost_seq',
      'name'          => REIHENFOLGE,
	  'description'   => REIHENFOLGE_DESC,
      'type'          => 'select',
      'default'       => '3',
      'select_values' => array('1','2','3','4','5','6','7','8','9'),
    ),	
	
     array(
        'var'           => 'catlead_textcount',
        'name'          => CATLEAD_TEXTCOUNT,
        'type'          => 'string',
        'default'       => '222',
    ),	
    array(
      'var'           => 'catlead',
      'name'          => CAT_LEAD,
      'type'          => 'select',
      'default'       => '',
      'select_values' => $catsel,
    ),
    array(
        'var'           => 'enable_catlead',
        'name'          => ENABLE_CATLEAD,
        'type'          => 'boolean',
        'default'       => false,
    ),	
	array(
      'var'           => 'catlead_seq',
      'name'          => REIHENFOLGE,
      'type'          => 'select',
      'default'       => '2',
	  	  'description'   => REIHENFOLGE_DESC,
      'select_values' => array('1','2','3','4','5','6','7','8','9'),
    ),
    array(
        'var'           => 'enable_workers',
        'name'          => ENABLE_WORKERS,
        'type'          => 'boolean',
        'default'       => false,
    ),
	
    array(
        'var'           => 'worker1_title',
        'name'          => WORKER_TITLE,
        'type'          => 'string',
        'default'       => 'Workers Title',
    ),	
    array(
        'var'           => 'worker1_desc',
        'name'          => WORKER_DESC,
        'type'          => 'string',
        'default'       => 'Workers Description',
    ),	
		
	
	
	array(
      'var'           => 'workers_seq',
      'name'          => REIHENFOLGE,
      'type'          => 'select',
      'default'       => '7',
	  	  'description'   => REIHENFOLGE_DESC,
      'select_values' => array('1','2','3','4','5','6','7','8','9'),
    ),	
	
    array(
        'var'           => 'worker_description',
        'name'          => WORKERS_DESCRIPTION,
        'type'          => 'content',
        'default'       => WORKERS_DESCRIPTION,
    ),	
	
    array(
        'var'           => 'worker1_amount',
        'name'          => WORKER1_AMOUNT,
        'type'          => 'string',
        'default'       => '3',
    ),	
	 
    array(
        'var'           => 'theme_instructions',
        'type'          => 'content',
        'default'       => $ep_msg . THEME_INSTRUCTIONS . '<p>' . CATEGORIES_ON_ARCHIVE_DESC . '</p><p>' . TAGS_ON_ARCHIVE_DESC . '<p>',
    ),
    array(
        'var'           => 'startpage_instructions',
        'type'          => 'content',
        'default'       =>  STARTPAGE_INSTRUCTIONS ,
    ),
	    array(
        'var'           => 'lead_cat_instructions',
        'type'          => 'content',
        'default'       =>  LEAD_CAT_INSTRUCTIONS ,
    ),
    array(
        'var'           => 'stdnavigation_instructions',
        'type'          => 'content',
        'default'       =>  STDNAVIGATION_INSTRUCTIONS ,
    ),		
    array(
        'var'           => 'default_header_image',
        'name'          => DEFAULT_HEADER_IMAGE,
        'description'   => DEFAULT_HEADER_IMAGE_DESC,
        'type'          => 'media',
        'default'       => serendipity_getTemplateFile('img/home-bg.jpg', 'serendipityHTTPPath', true)
    ),
    array(
        'var'           => 'entry_default_header_image',
        'name'          => ENTRY_DEFAULT_HEADER_IMAGE,
        'description'   => ENTRY_DEFAULT_HEADER_IMAGE_DESC,
        'type'          => 'media',
        'default'       => serendipity_getTemplateFile('img/post-bg.jpg', 'serendipityHTTPPath', true)
    ),
    array(
        'var'           => 'staticpage_header_image',
        'name'          => STATICPAGE_DEFAULT_HEADER_IMAGE,
        'description'   => STATICPAGE_DEFAULT_HEADER_IMAGE_DESC,
        'type'          => 'media',
        'default'       => serendipity_getTemplateFile('img/about-bg.jpg', 'serendipityHTTPPath', true)
    ),
 
     array(
        'var'           => 'contactform_header_image',
        'name'          => CONTACTFORM_HEADER_IMAGE,
        'type'          => 'media',
        'default'       => serendipity_getTemplateFile('img/contact-bg.jpg', 'serendipityHTTPPath', true)
    ),
     array(
        'var'           => 'archive_header_image',
        'name'          => ARCHIVE_HEADER_IMAGE,
        'type'          => 'media',
        'default'       => serendipity_getTemplateFile('img/archive-bg.jpg', 'serendipityHTTPPath', true)
    ),    
    array(
        'var'           => 'date_format',
        'name'          => ENTRY_DATE_FORMAT . ' (http://php.net/strftime)',
        'type'          => 'string',
        'default'       => DATE_FORMAT_ENTRY,
    ),
    array(
        'var'           => 'comment_time_format',
        'name'          => COMMENT_TIME_FORMAT,
        'type'          => 'select',
        'default'       => 'words',
        'select_values' => array('words' => WORDS,
                                 'time'  => TIMESTAMP)
    ),
    array(
        'var'           => 'googlemap_support',
        'name'          => GOOGLE_MAP_SUPPORT,
        'type'          => 'boolean',
        'default'       => false,
    ),	
    array(
        'var'           => 'google_map_url',
        'name'          => GOOGLE_MAP_URL,
		'description'   => GOOGLE_MAP_URL_DESC,
        'type'          => 'string',
        'default'       => 'https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Twitter,+Inc.,+Market+Street,+San+Francisco,+CA&amp;aq=0&amp;oq=twitter&amp;sll=28.659344,-81.187888&amp;sspn=0.128789,0.264187&amp;ie=UTF8&amp;hq=Twitter,+Inc.,+Market+Street,+San+Francisco,+CA&amp;t=m&amp;z=15&amp;iwloc=A&amp;output=embed',
    ),	
    array(
        'var'           => 'google_map_staticpage',
        'name'          => GOOGLE_MAP_STATICPAGE,
		'description'   => GOOGLE_MAP_STATICPAGE_DESC,	
        'type'          => 'string',
        'default'       => $serendipity['baseURL'] .'pages/contactform.html',
    ),		
    array(
        'var'           => 'subtitle_use_entrybody',
        'name'          => SUBTITLE_USE_ENTRYBODY,
        'type'          => 'boolean',
        'default'       => false,
    ),
    array(
        'var'           => 'entrybody_detailed_only',
        'name'          => ENTRYBODY_DETAILED_ONLY,
        'type'          => 'boolean',
        'default'       => true,
    ), 
    array(
        'var'           => 'show_comment_link',
        'name'          => SHOW_COMMENT_LINK,
        'type'          => 'boolean',
        'default'       => false,
    ),     
    array(
        'var'           => 'categories_on_archive',
        'name'          => CATEGORIES_ON_ARCHIVE,
        'description'   => CATEGORIES_ON_ARCHIVE_DESC,
        'type'          => 'boolean',
        'default'       => false,
    ),
    array(
        'var'           => 'tags_on_archive',
        'name'          => TAGS_ON_ARCHIVE,
        'description'   => TAGS_ON_ARCHIVE_DESC,
        'type'          => 'boolean',
        'default'       => false,
    ),
    array(
        'var'           => 'use_corenav',
        'name'          => USE_CORENAV,
        'type'          => 'boolean',
        'default'       => true,
    ),
     array(
        'var'           => 'nav_headline',
        'name'          => NAV_HEADLINE,
        'type'          => 'string',
        'default'       => 'Menue',
    ),	
	 array(
        'var'           => 'nav_position',
        'name'          => NAV_POSITION,
        'type'          => 'select',
        'default'       => 'left' ,
		'select_values' => array('left' =>NAVPOS_LEFT,
                                 'middle' => NAVPOS_MIDDLE,
                                 'right' => NAVPOS_RIGHT
                                ),
      ),		
 	
    array(
        'var'           => 'home_link_text',
        'name'          => HOME_LINK_TEXT,
        'type'          => 'string',
        'default'       => $serendipity['blogTitle'],
    ), 


 	
    array(
        'var'           => 'show_rightsidebar',
        'name'          => SHOW_RIGHTSIDEBAR,
        'description'   => SHOW_RIGHTSIDEBAR_USE_DESC,			
        'type'          => 'boolean',
        'default'       => true,
    ),	
    array(
        'var'           => 'show_pic_in_archive',
        'name'          => SHOW_PIC_IN_ARCHIVE,
        'description'   => SHOW_PIC_IN_ARCHIVE_DESC,			
        'type'          => 'boolean',
        'default'       => false,
    ),		
    array(
        'var'           => 'enable_social',
        'name'          => ENABLE_SOCIAL,
        'description'   => ENABLE_SOCIAL_DESC,
        'type'          => 'boolean', 
        'default'       => true,
    ),	
	 array(
        'var'           => 'social_position',
        'name'          => SOCIAL_POSITION,
        'type'          => 'select',
        'default'       => 'middle' ,
		'select_values' => array('left' =>NAVPOS_LEFT,
                                 'middle' => NAVPOS_MIDDLE,
                                 'right' => NAVPOS_RIGHT
                                ),
      ),	
     array(
        'var'           => 'social_header',
        'name'          => SOCIAL_HEADER,
        'type'          => 'string',
        'default'       => 'Social Networking',
	),		  
     array(
        'var'           => 'social_description',
        'name'          => SOCIAL_DESCRIPTION,
        'type'          => 'string',
        'default'       => 'Finde uns in den sozialen Netzwerken',
	),	
	  array(
        'var'           => 'twitter_url',
        'name'          => TWITTER_URL,
        'type'          => 'string',
        'default'       => '',
    ),
     array(
        'var'           => 'linkedin_url',
        'name'          => LINKEDIN_URL,
        'type'          => 'string',
        'default'       => '',
    ),
     array(
        'var'           => 'dribbble_url',
        'name'          => DRIBBBLE_URL,
        'type'          => 'string',
        'default'       => '',
    ),	
     array(
        'var'           => 'facebook_url',
        'name'          => FACEBOOK_URL,
        'type'          => 'string',
        'default'       => '',
    ),
     array(
        'var'           => 'youtube_url',
        'name'          => YOUTUBE_URL,
        'type'          => 'string',
        'default'       => '',
    ),

	array(
        'var'           => 'rss_url',
        'name'          => RSS_URL,
        'type'          => 'string',
        'default'       => $serendipity['baseURL'] . 'index.php?/feeds/index.rss2',
    ), 
      array(
        'var'           => 'github_url',
        'name'          => GITHUB_URL,
        'type'          => 'string',
        'default'       => '',
    ), 
      array(
        'var'           => 'instagram_url',
        'name'          => INSTAGRAM_URL,
        'type'          => 'string',
        'default'       => '',
    ),  
        array(
        'var'           => 'pinterest_url',
        'name'          => PINTEREST_URL,
        'type'          => 'string',
        'default'       => '',
    ),   
        array(
        'var'           => 'copyright',
        'name'          => COPYRIGHT,
        'type'          => 'string',
        'default'       => 'Copyright &copy; ' . $serendipity['blogTitle'] . ' ' . date(Y) . ' | <a href="' . $serendipity['baseURL'] . 'serendipity_admin.php">Admin</a>',
    ),  
          array(
        'var'           => 'displaycatname',
        'name'          => DISPLAY_CAT_NAME,
        'type'          => 'boolean',
        'default'       => 'true'
    ),
 	
    array(
        'var'           => 'rlslider1_amount',
        'name'          => RLSLIDER1_LINK_AMOUNT,
        'type'          => 'string',
        'default'       => '5',
    ),	
    array(
        'var'           => 'rlslider1_enable',
        'name'          => RLSLIDER1_ENABLE,
        'type'          => 'boolean',
        'default'       => 'true'
    ),	
		array(
      'var'           => 'rlslider1_seq',
      'name'          => REIHENFOLGE,
	  'description'   => REIHENFOLGE_DESC,	  
      'type'          => 'select',
      'default'       => '1',
      'select_values' => array('1','2','3','4','5','6','7','8','9'),
    ),
	    array(
        'var'           => 'businessgallery1_amount',
        'name'          => BUSINESSGALLERY_AMOUNT,
		'description'   => BUSINESSGALLERY_DESC,
        'type'          => 'string',
        'default'       => '5',
    ),	
    array(
        'var'           => 'businessgallery_enable',
        'name'          => BUSINESSGALLERY_ENABLE,
        'type'          => 'boolean',
        'default'       => 'true',
    ),
    array(
        'var'           => 'businessgallery_head',
        'name'          => BUSINESSGALLERY_HEAD,
        'type'          => 'string',
        'default'       => 'Überschrift Galerie',
    ),	
	array(
       'var'           => 'navlinkinfo2',
       'name'          => NAVLINK_INFO2,
       'type'          => 'custom',
       'custom'        => NAVLINK_INFO2,
    ),	
	 array(
       'var'           => 'navlinkenable',
       'name'          => NAVLINK_ENABLE,
        'description'   => NAVLINK_USE_DESC,	   
       'type'          => 'boolean',
       'default'       => 'true',
    ),

	 array(
       'var'           => 'navlink_brand',
       'name'          => NAVLINK_BRAND,
       'type'          => 'string',
       'default'       => 'Serendipity'
    ),
		 array(
       'var'           => 'navlink_brand_link',
       'name'          => NAVLINK_BRAND_LINK,
       'type'          => 'string',
       'default'       => '/'
    ),
		 array(
       'var'           => 'navlink_brand_img',
       'name'          => NAVLINK_BRAND_IMG,
       'type'          => 'media',
       'default'       =>  serendipity_getTemplateFile('img/logo.png', 'serendipityHTTPPath', true)
    ),	
    array(
        'var'           => 'enable_navlink_brand',
        'name'          => ENABLE_NAVLINK_BRAND,
        'type'          => 'boolean',
        'default'       => 'true'
    ),	
    array(
        'var'           => 'navlink_search',
        'name'          => NAVLINK_SEARCH,
        'type'          => 'boolean',
        'default'       => 'true'
    ),	
    array(
        'var'           => 'navlink_home',
        'name'          => NAVLINK_HOME,
        'type'          => 'boolean',
        'default'       => 'true'
    ),	
    array(
        'var'           => 'navlink_archive',
        'name'          => NAVLINK_ARCHIVE,
        'type'          => 'boolean',
        'default'       => 'true'
    ),	
     array(
        'var'           => 'amount2',
        'name'          => NAVLINK_AMOUNT2,
        'type'          => 'string',
        'default'       => '5',
    ),	
	array(
       'var'           => 'startpage_cat_windowsinfo',
       'name'          => 'STARTPAGE_CAT_WINDOWSINFO',
       'type'          => 'custom',
       'custom'        => STARTPAGE_CAT_WINDOWSINFO,
    ),
	array(
       'var'           => 'lead_cat_windowsinfo',
       'name'          => 'LEAD_CAT_WINDOWSINFO',
       'type'          => 'custom',
       'custom'        => LEAD_CAT_WINDOWSINFO,
    ),	
	
     array(
        'var'           => 'enable_actionbar',
        'name'          => ENABLE_AKTIONBAR,
        'type'          => 'boolean',
        'default'       => 'true'
    ),	
	
	     array(
        'var'           => 'text_actionbar',
        'name'          => TEXT_AKTIONBAR,
        'type'          => 'string',
        'default'       => 'Welcome to <span style="color:#aec62c; text-transform:uppercase;font-size:24px;">Basica!</span> A free fully responsive Bootstrap 3 HTML5 template!',
    ),
	     array(
        'var'           => 'linktext_actionbar',
        'name'          => LINKTEXT_AKTIONBAR,
        'type'          => 'string',
        'default'       => 'info',
    ),
	     array(
        'var'           => 'linkurl_actionbar',
        'name'          => LINKURL_AKTIONBAR,
        'type'          => 'string',
        'default'       => 'http://s9y.org',
    ),
	    array(
        'var'           => 'actionbar_description',
        'name'          => ACTIONBAR_DESCRIPTION,
        'type'          => 'content',
        'default'       => ACTIONBAR_DESCRIPTION,
    ),
	
	
    array(
        'var'           => 'startpage_cat_windows',
        'name'          => STARTPAGE_REIHE,
	    'description'   => STARTPAGE_ROWS_USE_DESC,		
        'type'          => 'string',
        'default'       => '2', 
    ),		
);

 
$catdata = array();
foreach($all_cats as $cat) {$cat['link'] = serendipity_categoryURL($cat);$catdata[$cat['categoryid']] = $cat;}
$serendipity['smarty']->assign_by_ref('catdata', $catdata);
// Collapse template options into groups.
$template_global_config = array('navigation' => true);
$template_loaded_config = serendipity_loadThemeOptions($template_config, $serendipity['smarty_vars']['template_option'], true);
serendipity_loadGlobalThemeOptions($template_config, $template_loaded_config, $template_global_config);
 
$navlinks_collapse = array('stdnavigation_instructions', 'use_corenav','nav_headline','nav_position', 'amount');
for ($i = 0; $i < $template_loaded_config['amount']; $i++) {
	array_push($navlinks_collapse, 'navlink' . $i . 'text' ,'navlink' . $i . 'url');
}

$latestPosts_collapse =array('latestPost_description','latestPost_enable','latestPost_seq','latestPost_header1','latestPost_header2','latestPost_cat1','latestPost_cat2','latestPost_amount1','latestPost_amount2','latestPost_textcount1','latestPost_textcount2','latestPost_with_pic1','latestPost_with_pic2');

$slider_collapse = array('rlslider1_enable','rlslider1_seq', 'rlslider1_amount');
for ($i = 0; $i < $template_loaded_config['rlslider1_amount']; $i++) {
	array_push($slider_collapse,'slider1' . $i . 'rlslider_intro' , 'slider1' . $i . 'text1' ,'slider1' . $i . 'text2' ,'slider1' . $i. 'text3' ,'slider1' .$i . 'bg_img' ,'slider1' . $i . 'morem');
}
$lead_cat_collapse= array('lead_cat_instructions','lead_cat_windowsinfo', 'enable_catlead','catlead_seq','catlead_textcount','catlead');

$startpagerows_collapse = array('startpage_instructions',  'startpage_cat_windowsinfo','startpagerows_enable','startpagerows_seq','startpage_cat_windows','displaycatname');
for ($i = 0; $i < $template_loaded_config['startpage_cat_windows']; $i++) {
	array_push($startpagerows_collapse, 'startpagerow'.$i.'cat_intro',		'startpagerow' . $i . 'win_column',	'startpagerow' . $i . 'title_text',	'startpagerow' . $i . 'truncated_qty',	'startpagerow' . $i . 'titlesonly_qty',	'startpagerow' . $i . 'thedesign','startpagerow' . $i . 'the_title',	'startpagerow' . $i . 'catdescription',	'startpagerow' . $i . 'show_title',	'startpagerow' . $i . 'kategorie'  );
}

 $business_collapse = array('businessgallery_enable','businessgallery_head','businessgallery1_amount');
for ($i = 0; $i < $template_loaded_config['businessgallery1_amount']; $i++) {
	array_push($business_collapse,'businessgallery1' . $i . 'businessgallery_intro' , 'businessgallery1' . $i . 'text1' ,'businessgallery1' . $i . 'text2' ,'businessgallery1' . $i . 'bg_img' ,'businessgallery1' . $i . 'link1');
}
  $workers_collapse = array('worker_description','enable_workers','workers_seq','worker1_title','worker1_desc','worker1_amount');
for ($i = 0; $i < $template_loaded_config['worker1_amount']; $i++) {
	array_push($workers_collapse,'worker1' . $i . 'worker1_intro' , 'worker1' . $i . 'text1' ,'worker1' . $i . 'text2' ,'worker1' . $i . 'bg_img' ,'worker1' . $i . 'link1' ,'worker1' . $i . 'link2' ,'worker1' . $i . 'facebook','worker1' . $i . 'github','worker1' . $i . 'tumblr' );
}
  
   $actionbar_collapse = array('actionbar_description','enable_actionbar', 'text_actionbar',  'linktext_actionbar', 'linkurl_actionbar' ); 

$template_config_groups 	= array(
    THEME_README        	=> array('theme_instructions'),
    THEME_PAGE_OPTIONS  	=> array('home_link_text', 'show_rightsidebar','date_format', 'comment_time_format','subtitle_use_entrybody', 'entrybody_detailed_only', 'show_comment_link', 'categories_on_archive','show_pic_in_archive', 'tags_on_archive', 'copyright'),  
	THEME_LEAD_CAT			=> $lead_cat_collapse,
	THEME_STARTSEITE 		=>  $startpagerows_collapse,
	THEME_LATESTPOSTS       => $latestPosts_collapse,
	THEME_STARTSEITE_WORKERS=> $workers_collapse,
	THEME_SLIDER_OPTIONS 	=> $slider_collapse,
	THEME_BUSINESS_GALLERY 	=> $business_collapse,
	THEME_ACTIONBAR         => $actionbar_collapse ,
    THEME_HEADERS       	=> array('default_header_image', 'entry_default_header_image', 'staticpage_header_image', 'contactform_header_image', 'archive_header_image'),  
    THEME_SOCIAL_LINKS  	=> array('enable_social','social_position','social_header','social_description','twitter_url', 'facebook_url','linkedin_url', 'dribbble_url','youtube_url','rss_url', 'github_url', 'instagram_url', 'pinterest_url'),
    THEME_NAVIGATION    	=> $navlinks_collapse,
	THEME_GOOGLEMAPS    	=> array('googlemap_support','google_map_url','google_map_staticpage'),
	THEME_HAUPTMENUE		=>  array('navlinkinfo2', 'navlinkenable', 'navlink_brand', 'navlink_brand_link','navlink_brand_img', 'enable_navlink_brand', 'navlink_search', 'navlink_home', 'navlink_archive','amount2' )
);

//slider
if(isset($_POST['serendipity']['template']['rlslider1_amount']) && serendipity_userLoggedIn() && serendipity_checkPermission('adminTemplates')) {
    $temp_post=$_POST['serendipity']['template']['rlslider1_amount'];
    if(is_numeric($temp_post)) {
       $template_loaded_config['rlslider1_amount'] =$temp_post;
    }
}



$sliders1 = array();
for ($i = 0; $i < $template_loaded_config['rlslider1_amount']; $i++) {
    $template_config[] = array(
        'var'           => 'slider1' . $i . 'rlslider_intro',
        'type'          => 'content',
        'default'       => '<br /><span class="serendipityAdminMsgNote">'. RLSLIDER1_LINK_OPTIONS_TITLE . ' #' . $i .'</span>',
        );
    $template_config[] = array(
        'var'           => 'slider1' . $i . 'text1',
        'name'          => SLIDER_TEXT1,
        'type'          => 'string',
        'default'       => 'Text1 Slide' . $i,
        );
    $template_config[] = array(
        'var'           => 'slider1' . $i . 'text2',
        'name'          => SLIDER_TEXT2,
        'type'          => 'string',
        'default'       => 'Text2 Slide' . $i,
        );	
    $template_config[] = array(
        'var'           => 'slider1' . $i . 'text3',
        'name'          => SLIDER_TEXT3,
        'type'          => 'string',
        'default'       => 'Text3 Slide' . $i,
        );			
    $template_config[] = array(
        'var'           => 'slider1' . $i . 'bg_img',
        'name'          => BG_IMG,
        'type'          => 'media',
        'default'       => $serendipity['baseURL'].$serendipity['templatePath']. $serendipity['template'].'/img/slides/'.$i.'.jpg',
    );
    $template_config[] = array(
        'var'           => 'slider1' . $i . 'morem',
        'name'          => MOREM,
        'type'          => 'string',
        'default'       => $serendipity['baseURL'].'#',
    );	
 
    $sliders1[] = array(
        'rlslider_intro' => $template_loaded_config['slider1' . $i . 'rlslider_intro'],
        'text1'         => $template_loaded_config['slider1' . $i . 'text1'],
        'text2'         => $template_loaded_config['slider1' . $i . 'text2'],	
        'text3'         => $template_loaded_config['slider1' . $i . 'text3'],		
        'bg_img'          => $template_loaded_config['slider1' . $i . 'bg_img'],
        'morem'          => $template_loaded_config['slider1' . $i . 'morem'],		
 
    );
}
$serendipity['smarty']->assign_by_ref('sliders1', $sliders1);

//workers
 
$workers1 = array();
for ($i = 0; $i < $template_loaded_config['worker1_amount']; $i++) {
    $template_config[] = array(
        'var'           => 'worker1' . $i . 'worker1_intro',
        'type'          => 'content',
        'default'       => '<br /><span class="serendipityAdminMsgNote">'. RWORKER1_LINK_OPTIONS_TITLE . ' #' . $i .'</span>',
        );
    $template_config[] = array(
        'var'           => 'worker1' . $i . 'text1',
        'name'          => RWORKER1_TEXT1,
        'type'          => 'string',
        'default'       => 'Überschrift 1-' . $i,
        );
    $template_config[] = array(
        'var'           => 'worker1' . $i . 'text2',
        'name'          => RWORKER1_TEXT2,
        'type'          => 'string',
        'default'       => 'Content 1-' . $i,
        );		
    $template_config[] = array(
        'var'           => 'worker1' . $i . 'link1',
        'name'          => RWORKER1_LINK1,
        'type'          => 'string',
        'default'       => '#' ,
        );	
	    $template_config[] = array(
        'var'           => 'worker1' . $i . 'link2',
        'name'          => RWORKER1_LINK2,
        'type'          => 'select',
        'default'       => 'websw' ,
		'select_values' => array('websw' =>LINKTYPE_WEBSW,
                                 'webnw' => LINKTYPE_WEBNW,
                                 'Lightbox' => LINKTYPE_LIGHTBOX
                                ),
        );		
    $template_config[] = array(
        'var'           => 'worker1' . $i . 'facebook',
        'name'          => FACEBOOK_LINK1,
        'type'          => 'string',
        'default'       => '' ,
        );	
    $template_config[] = array(
        'var'           => 'worker1' . $i . 'github',
        'name'          => GITHUB_LINK,
        'type'          => 'string',
        'default'       => '' ,
        );	
    $template_config[] = array(
        'var'           => 'worker1' . $i . 'tumblr',
        'name'          => TUMBLR_LINK,
        'type'          => 'string',
        'default'       => '' ,
        );		
    $template_config[] = array(
        'var'           => 'worker1' . $i . 'bg_img',
        'name'          => BG_IMG,
        'type'          => 'media',
        'default'       => $serendipity['baseURL'].$serendipity['templatePath']. $serendipity['template'].'/img/team/'.$i.'.jpg',
	 
		
    );
   
 
    $workers1[] = array(
        'workers_intro' => $template_loaded_config['worker1' . $i . 'worker_intro'],
        'text1'         => $template_loaded_config['worker1' . $i . 'text1'],
        'text2'         => $template_loaded_config['worker1' . $i . 'text2'],		
        'bg_img'        => $template_loaded_config['worker1' . $i . 'bg_img'],
        'link1'         => $template_loaded_config['worker1' . $i . 'link1'],		
        'link2'         => $template_loaded_config['worker1' . $i . 'link2'],	
        'facebook'          => $template_loaded_config['worker1' . $i . 'facebook'],
        'github'          => $template_loaded_config['worker1' . $i . 'github'],
        'tumblr'          => $template_loaded_config['worker1' . $i . 'tumblr']
    );   
}
$serendipity['smarty']->assign_by_ref('workers1', $workers1);  
 
//businessgallery
if(isset($_POST['serendipity']['template']['businessgallery1_amount']) && serendipity_userLoggedIn() && serendipity_checkPermission('adminTemplates')) {
    $temp_post=$_POST['serendipity']['template']['businessgallery1_amount'];
    if(is_numeric($temp_post)) {
       $template_loaded_config['businessgallery1_amount'] =$temp_post;
    }
}



$businessgalleries1 = array();
for ($i = 0; $i < $template_loaded_config['businessgallery1_amount']; $i++) {
    $template_config[] = array(
        'var'           => 'businessgallery1' . $i . 'businessgallery_intro',
        'type'          => 'content',
        'default'       => '<br /><span class="serendipityAdminMsgNote">'. RLGALLERY1_LINK_OPTIONS_TITLE . ' #' . $i .'</span>',
        );
    $template_config[] = array(
        'var'           => 'businessgallery1' . $i . 'text1',
        'name'          => RLGALLERY1_TEXT1,
        'type'          => 'string',
        'default'       => 'Überschrift 1-' . $i,
        );
    $template_config[] = array(
        'var'           => 'businessgallery1' . $i . 'text2',
        'name'          => RLGALLERY1_TEXT2,
        'type'          => 'string',
        'default'       => 'Content 1-' . $i,
        );		
    $template_config[] = array(
        'var'           => 'businessgallery1' . $i . 'link1',
        'name'          => RLGALLERY1_LINK1,
        'type'          => 'string',
        'default'       => '#' ,
        );				
    $template_config[] = array(
        'var'           => 'businessgallery1' . $i . 'bg_img',
        'name'          => BG_IMG,
        'type'          => 'media',
        'default'       => $serendipity['baseURL'].$serendipity['templatePath']. $serendipity['template'].'/img/Business/image'.$i.'.jpg',
    );
   
 
    $businessgalleries1[] = array(
        'businessgallery_intro' => $template_loaded_config['businessgallery1' . $i . 'businessgallery_intro'],
        'text1'         => $template_loaded_config['businessgallery1' . $i . 'text1'],
        'text2'         => $template_loaded_config['businessgallery1' . $i . 'text2'],		
        'bg_img'          => $template_loaded_config['businessgallery1' . $i . 'bg_img'],
        'link1'          => $template_loaded_config['businessgallery1' . $i . 'link1'],		
 
    );
}
$serendipity['smarty']->assign_by_ref('businessgalleries1', $businessgalleries1);





//Hauptmenue


$hauptmenue = array();
for ($i = 0; $i < $template_loaded_config['amount2']; $i++) {
    $template_config[] = array(
        'var'           => 'hauptmenupunkt' . $i . 'navlink_intro',
        'type'          => 'content',
        'default'       => '<b><p style="color:#FFFFFF; background-color: green">'. SITENAV2_LINK_OPTIONS_TITLE . ' #' . $i .'</p></b>',
        );
    $template_config[] = array(
        'var'           => 'hauptmenupunkt' . $i . 'text',
        'name'          => HAUPTMENUE_TEXT .$i,
        'type'          => 'string',
        'default'       => 'Link #' . $i,
        );
    $template_config[] = array(
        'var'           => 'hauptmenupunkt' . $i . 'url',
        'name'          => HAUPTMENUE_URL,
        'type'          => 'string',
        'default'       => '#',
    );
    $template_config[] = array(
        'var'           => 'hauptmenupunkt' . $i . 'target',
        'name'          => HAUPTMENUE_BLANK_TARGET,
        'type'          => 'boolean',
        'default'       => 'false',
    );
    $template_config[] = array(
        'var'           => 'hauptmenupunkt' . $i . 'amount2',
        'name'          => SITENAV_SUBNAV_LINK_AMOUNT,
        'type'          => 'string',
        'default'       => '1',
        );
    $untermenue = array();
    for ($k = 0; $k < $template_loaded_config['hauptmenupunkt' . $i . 'amount2']; $k++) {
        $template_config[] = array(
            'var'           => 'hauptmenupunkt' . $i . 'untermenuepunkt' . $k . 'text',
            'name'          => SITENAV_SUBNAV_LINK_TEXT . ' #'. $k,
            'type'          => 'string',
            'default'       => 'Link #' . $i . ' untermenue #' . $k,
            );
        $template_config[] = array(
            'var'           => 'hauptmenupunkt' . $i . 'untermenuepunkt' . $k . 'url',
            'name'          => SITENAV_SUBNAV_LINK_URL . ' #'. $k,
            'type'          => 'string',
            'default'       => '#',
            );
        $template_config[] = array(
            'var'           => 'hauptmenupunkt' . $i . 'untermenuepunkt' . $k . 'target',
            'name'          => SITENAV_SUBNAV_LINK_BLANK_TARGET . ' #'. $k,
            'type'          => 'boolean',
            'default'       => 'false',
            );
        $untermenue[] = array(
            'title'     => $template_loaded_config['hauptmenupunkt' . $i . 'untermenuepunkt' . $k . 'text'],
            'href'      => $template_loaded_config['hauptmenupunkt' . $i . 'untermenuepunkt' . $k . 'url'],
            'target'    => $template_loaded_config['hauptmenupunkt' . $i . 'untermenuepunkt' . $k . 'target'],
            );
    }
    $hauptmenue[] = array(
        'navlink_intro' => $template_loaded_config['hauptmenupunkt' . $i . 'navlink_intro'],
        'title'         => $template_loaded_config['hauptmenupunkt' . $i . 'text'],
        'href'          => $template_loaded_config['hauptmenupunkt' . $i . 'url'],
        'target'        => $template_loaded_config['hauptmenupunkt' . $i . 'target'],
        'untermenue'      => $untermenue,
    );
}
$serendipity['smarty']->assign_by_ref('hauptmenue', $hauptmenue);


 if(isset($_POST['serendipity']['template']['amount2']) && serendipity_userLoggedIn() && serendipity_checkPermission('adminTemplates'))
   {
      $temp_post=$_POST['serendipity']['template']['amount2'];
         if(is_numeric($temp_post))
            $template_loaded_config['amount2'] =$temp_post;
   }
//ende hauptmenue


 

 


$startpagerows = array();
for ($j = 0; $j < $template_loaded_config['startpage_cat_windows']; $j++) {
    $startpagerows[] = array(
     'cat_intro'     => $template_loaded_config['startpagerow' . $j . 'cat_intro'],
     'win_column'     => $template_loaded_config['startpagerow' . $j . 'win_column'],
     'kategorie'         => $template_loaded_config['startpagerow' . $j . 'kategorie'],
     'show_title'    => $template_loaded_config['startpagerow' . $j . 'show_title'],
     'title_text'    => $template_loaded_config['startpagerow' . $j . 'title_text'],
     'truncated_qty' => $template_loaded_config['startpagerow' . $j . 'truncated_qty'],
     'titlesonly_qty'=> $template_loaded_config['startpagerow' . $j . 'titlesonly_qty'],
	 'thedesign'	 => $template_loaded_config['startpagerow' . $j . 'thedesign'],
	 'the_title'	 => $template_loaded_config['startpagerow' . $j . 'the_title'],
	 'catdescription'=> $template_loaded_config['startpagerow' . $j . 'catdescription'],


    );
    $template_config[] = array(
        'var'           => 'startpagerow' . $j . 'cat_intro',
        'type'          => 'content',
        'default'       => ' <b><p style="color:#FFFFFF; background-color: blue">' . STARTROWS_TITLE . ' #' . $j .STARTROW.' </p></b>',
        );
    $template_config[] = array(
        'var'           => 'startpagerow' . $j . 'win_column',
        'name'          => WIN_COLUMN,
       'type'          => 'select',
        'default'       => '3',
		'select_values' => array(
                                 
								'3' => '3 Spalten'
								  )
								
    );		
    $template_config[] = array(
        'var'           => 'startpagerow' . $j . 'kategorie',
        'name'          => STARTROW_ASSIGN_ID,
        'type'          => 'select',
        'default'       => '',
        'select_values'   => $catsel
        );
    $template_config[] = array(
        'var'           => 'startpagerow' . $j . 'show_title',
        'name'          => STARTROW_SHOW_TITLE,
        'type'          => 'boolean',
        'default'       => 'true'
    );
	
    $template_config[] = array(
        'var'           => 'startpagerow' . $j . 'title_text',
        'name'          => STARTROW_TITLE_TEXT,
        'type'          => 'string',
        'default'       => '',
    );
    $template_config[] = array(
        'var'           => 'startpagerow' . $j . 'truncated_qty',
        'name'          => STARTROW_TRUNCATE_QTY,
        'type'          => 'string',
        'default'       => '100',
    );
    $template_config[] = array(
        'var'           => 'startpagerow' . $j . 'titlesonly_qty',
        'name'          => STARTROW_TITLES_ONLY_QTY,
        'type'          => 'string',
        'default'       => '3',
    );
    $template_config[] = array(
        'var'           => 'startpagerow' . $j . 'thedesign',
        'name'          => THE_DESIGN,
       'type'          => 'select',
        'default'       => 'design1',
		'select_values' => array(
                                'design1' => 'Design 1',
                                'design2' => 'Design 2',
								'designac' => 'Acordion',
								'designslide' =>'Slider Design',
                                'designtabs' => 'Design Tabs')
								
    );
   $template_config[] = array(
        'var'           => 'startpagerow' . $j . 'the_title',
        'name'          => THE_TITLE,
        'type'          => 'string',
        'default'       => 'A Title for row '. $j ,
    );
    $template_config[] = array(
        'var'           => 'startpagerow' . $j . 'catdescription',
        'name'          => CATDESCRIPTION,
        'type'          => 'string',
        'default'       => 'This  is Description '. $j,
    );
}

$serendipity['smarty']->assign_by_ref('startpagerows', $startpagerows); 
 
  if(isset($_POST['serendipity']['template']['startpage_cat_windows']) && serendipity_userLoggedIn() && serendipity_checkPermission('adminTemplates'))
   {
      $temp_post=$_POST['serendipity']['template']['startpage_cat_windows'];
         if(is_numeric($temp_post))
            $template_loaded_config['startpage_cat_windows'] =$temp_post;
   }
 
 


 




// Save custom field variables within the serendipity "Edit/Create Entry" backend.
//                Any custom variables can later be queried inside the .tpl files through
//                  {if $entry.properties.key_value == 'true'}...{/if}

// Function to get the content of a non-boolean entry variable
function entry_option_get_value($property_key, &$eventData) {
    global $serendipity;
    if (isset($eventData['properties'][$property_key])) return $eventData['properties'][$property_key];
    if (isset($serendipity['POST']['properties'][$property_key])) return $serendipity['POST']['properties'][$property_key];
     return false;    
}

// Function to store form values into the serendipity database, so that they will be retrieved later.
function entry_option_store($property_key, $property_val, &$eventData) {
    global $serendipity;

    $q = "DELETE FROM {$serendipity['dbPrefix']}entryproperties WHERE entryid = " . (int)$eventData['id'] . " AND property = '" . serendipity_db_escape_string($property_key) . "'";
    serendipity_db_query($q);

    if (!empty($property_val)) {
        $q = "INSERT INTO {$serendipity['dbPrefix']}entryproperties (entryid, property, value) VALUES (" . (int)$eventData['id'] . ", '" . serendipity_db_escape_string($property_key) . "', '" . serendipity_db_escape_string($property_val) . "')";
        serendipity_db_query($q);
    }
}

function serendipity_plugin_api_pre_event_hook($event, &$bag, &$eventData, &$addData) {
    global $serendipity;

    // Check what Event is coming in, only react to those we want.
    switch($event) {

        // Displaying the backend entry section
        case 'backend_display':
            // INFO: The whole 'entryproperties' injection is easiest to store any data you want. The entryproperties plugin
            // should actually not even be required to do this, as serendipity loads all properties regardless of the installed plugin

            // The name of the variable
            $entry_subtitle_key = 'entry_subtitle';
            $entry_specific_header_image_key = 'entry_specific_header_image';
			$entry_photo_gallery_path_key= 'entry_photo_gallery_path';
			$entry_pic_position_key = 'entry_pic_position';

            // Check what our special key is set to (checks both POST data as well as the actual data)
            $is_entry_subtitle = (function_exists('serendipity_specialchars') ? serendipity_specialchars(entry_option_get_value($entry_subtitle_key, $eventData)) : htmlspecialchars(entry_option_get_value($entry_subtitle_key, $eventData), ENT_COMPAT, LANG_CHARSET));
            
			$is_entry_specific_header_image = entry_option_get_value ($entry_specific_header_image_key, $eventData);

			$is_entry_photo_gallery_path=(function_exists('serendipity_specialchars') ? serendipity_specialchars(entry_option_get_value($entry_photo_gallery_path_key, $eventData)) : htmlspecialchars(entry_option_get_value($entry_photo_gallery_path_key, $eventData), ENT_COMPAT, LANG_CHARSET));
			
			$is_entry_pic_position = (function_exists('serendipity_specialchars') ? serendipity_specialchars(entry_option_get_value($entry_pic_position_key, $eventData)) : htmlspecialchars(entry_option_get_value($entry_pic_position_key, $eventData), ENT_COMPAT, LANG_CHARSET));
			
            // This is the actual HTML output on the backend screen.
            //DEBUG: echo '<pre>' . print_r($eventData, true) . '</pre>';  
            echo '<div class="entryproperties">';
            echo '  <input type="hidden" value="true" name="serendipity[propertyform]">';
            echo '  <h3>' . THEME_ENTRY_PROPERTIES_HEADING . '</h3>';
            echo '      <div class="entryproperties_customfields adv_opts_box">';
            echo '          <h4>' . THEME_CUSTOM_FIELD_HEADING . '</h4>';
            echo '          <span>' . THEME_CUSTOM_FIELD_DEFINITION . '</span>';
            echo '          <div class="serendipity_customfields clearfix">';
            echo '              <div class="clearfix form_area media_choose" id="ep_column_' . $entry_subtitle_key . '">'; 
            echo '                  <label for="'. $entry_subtitle_key . '">' . THEME_ENTRY_SUBTITLE . '</label>';
            echo '                  <input id="' . $entry_subtitle_key . '" type="text" value="' . $is_entry_subtitle . '" name="serendipity[properties][' . $entry_subtitle_key . ']" style="width: 100%;">';
            echo '              </div>';
            echo '          </div>';    
 

            echo '          <div class="serendipity_customfields clearfix">';
            echo '              <div class="clearfix form_area media_choose" id="ep_column_' . $entry_photo_gallery_path_key . '">'; 
            echo '                  <label for="'. $entry_photo_gallery_path_key . '">' . THEME_ENTRY_PHOTO_GALLERY . '</label>';
            echo '                  <input id="' . $entry_photo_gallery_path_key . '" type="text" value="' . $is_entry_photo_gallery_path . '" name="serendipity[properties][' . $entry_photo_gallery_path_key . ']" style="width: 100%;">';
            echo '              </div>';
            echo '          </div>'; 

            echo '          <div class="serendipity_customfields clearfix">';
            echo '              <div class="clearfix form_area media_choose" id="ep_column_' . $entry_pic_position_key . '">'; 
            echo '                  <label for="'. $entry_pic_position_key . '">' . THEME_ENTRY_PICPOSITION . '</label>';
            echo '                  <input id="' . $entry_pic_position_key . '" type="text" value="' . $is_entry_pic_position . '" name="serendipity[properties][' . $entry_pic_position_key . ']" style="width: 100%;">';
            echo '              </div>';
            echo '          </div>'; 
			
            echo '          <div class="serendipity_customfields clearfix">';
            echo '              <div class="clearfix form_area media_choose" id="ep_column_' . $entry_specific_header_image_key . '">';
            echo '                  <label for="' . $entry_specific_header_image_key . '">' . THEME_ENTRY_HEADER_IMAGE. '</label>';
            echo '                  <textarea data-configitem="' . $entry_specific_header_image_key . '" name="serendipity[properties][' . $entry_specific_header_image_key . ']" class="change_preview" id="prop' . $entry_specific_header_image_key . '">' . $is_entry_specific_header_image . '</textarea>';
            echo '                  <button title="' . MEDIA . '" name="insImage" type="button" class="customfieldMedia"><span class="icon-picture"></span><span class="visuallyhidden">' . MEDIA . '</span></button>';
            echo '                  <figure id="' . $entry_specific_header_image_key . '_preview">';
            echo '                      <figcaption>' . PREVIEW . '</figcaption>';
            echo '                      <img alt="" src="' . $is_entry_specific_header_image . '">';
            echo '                  </figure>';
            echo '              </div>';
            echo '          </div>';
            echo '      </div>';
            echo ' </div>';    

            break;

        // To store the value of our entryproperties
        case 'backend_publish':
        case 'backend_save':
            // Call the helper function with all custom variables here.
            entry_option_store('entry_subtitle', $serendipity['POST']['properties']['entry_subtitle'], $eventData);
            entry_option_store('entry_specific_header_image', $serendipity['POST']['properties']['entry_specific_header_image'], $eventData);
			entry_option_store('entry_photo_gallery_path', $serendipity['POST']['properties']['entry_photo_gallery_path'], $eventData);
			entry_option_store('entry_pic_position', $serendipity['POST']['properties']['entry_pic_position'], $eventData);
            break;
    }
}
