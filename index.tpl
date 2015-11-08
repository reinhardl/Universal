{if $is_embedded != true}
<!DOCTYPE html>
<html lang="{$lang}">
<head>
    <meta charset="{$head_charset}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="generator" content="Serendipity v.{$serendipityVersion}">
    <title>{$head_title|default:$blogTitle}{if $head_subtitle} | {$head_subtitle}{/if}</title>
{* CANONICAL *}
    {if ($view == "entry" || $view == "start" || $view == "feed" || $view == "plugin" || $staticpage_pagetitle != "" || $robots_index == 'index')}
       <meta name="robots" content="index,follow">
    {else}
       <meta name="robots" content="noindex,follow">
    {/if}
    {if ($view == "entry")}
       <link rel="canonical" href="{$entry.rdf_ident}">
    {/if}
    {if ($view == "start")}
       <link rel="canonical" href="{$serendipityBaseURL}">
    {/if}    
{* BOOTSTRAP CORE CSS  *}
   {if $template_option.bootstrap =="bootstrap"}    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">  {else} <link href="/templates/Universal-master/css/{$template_option.bootstrap}.css" rel="stylesheet">{/if}   
{* S9Y CSS *}
    <link rel="stylesheet" href="{$head_link_stylesheet}"> 
    <link rel="alternate" type="application/rss+xml" title="{$blogTitle} RSS feed" href="{$serendipityBaseURL}{$serendipityRewritePrefix}feeds/index.rss2">
    <link rel="alternate" type="application/x.atom+xml"  title="{$blogTitle} Atom feed"  href="{$serendipityBaseURL}{$serendipityRewritePrefix}feeds/atom.xml">
    {if $entry_id}
        <link rel="pingback" href="{$serendipityBaseURL}comment.php?type=pingback&amp;entry_id={$entry_id}">
    {/if}   

    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
{*  CUSTOM FONTS   <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,600,800|Lora:400,400italic' rel='stylesheet' type='text/css'> *}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
   
{* HEADER IMAGE *}
   {if $startpage =='true' && $view == 'start' && $staticpage_pagetitle == '' } 
   <link href="{$serendipityBaseURL}/templates/Universal-master/css/Mitarbeiter.css" rel="stylesheet">  
   <link href="{$serendipityBaseURL}/templates/Universal-master/css/mySlider.css" rel="stylesheet">   
   <link href="{$serendipityBaseURL}/templates/Universal-master/css/RowHoverAnimation.css" rel="stylesheet">
     {/if}
 <link href="{$serendipityBaseURL}/templates/Universal-master/css/ResponsiveTimeline.css" rel="stylesheet">   
    {serendipity_hookPlugin hook="frontend_header"}
    <script src="{$head_link_script}"></script>
</head>
<body>
{else}
{serendipity_hookPlugin hook="frontend_header"}
{/if}
{if $is_raw_mode != true}
    {if $template_option.use_corenav}
        <a class="sr-only sr-only-focusable" href="#maincontent"><span lang="en">Skip to main content</span></a>    
        <!-- Navigation -->

		 {include file='include/include_header.tpl'}  
		<div class="section jumbotron section-breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						
 <h1> &nbsp;</h1>
					</div>
				</div>
			</div>
		</div>		
		
		
		
		
    {/if}  
    <div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" title="{$CONST.CLOSE}" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">{$CONST.SEARCH_WHAT}</h4>
                </div>
                <div class="modal-body">
                    <form id="searchform" action="{$serendipityHTTPPath}{$serendipityIndexFile}" method="get">
                        <div>
                            <input type="hidden" name="serendipity[action]" value="search">
                            <label for="serendipityQuickSearchTermField" class="sr-only">{$CONST.QUICKSEARCH}</label>
                            <input id="serendipityQuickSearchTermField" name="serendipity[searchTerm]" type="search" value="" placeholder="{$CONST.SEARCH} ...">
                                     
                        </div>
                        <div class="modal-footer">
                            <input class="btn btn-primary" id="gobutton" name="serendipity[searchButton]" type="submit" value="{$CONST.GO}">   
                            <button type="button" class="btn btn-default" data-dismiss="modal">{$CONST.CLOSE}</button>
                        </div>
                    </form>
                    {serendipity_hookPlugin hook="quicksearch_plugin" hookAll="true"}
                </div>
            </div>
        </div>
    </div>
    

 
	
	
 
 
 
{* MAIN CONTENT *}

 
 <main id="maincontent"  >
 
 {if $startpage =='true' && $view == 'start' && $staticpage_pagetitle == '' } 

 
            
             {* Startpage*}
			{for $sequence=0 to 9}
			
 
			
				{* Advertising /Actionbar*}
				 
					{include file='include/include_actionbar1.tpl'}	
					
				 
			
				{* CatLead*}
				{if $template_option.catlead_seq== $sequence && $template_option.enable_catlead =="true"}			    	
						<div id="lead1" > 
							{serendipity_fetchPrintEntries limit="0,1" entryprops="entry_specific_header_image != ''" category=$template_option.catlead noCache=false fetchDrafts=false full=true use_footer=false noSticky=true  template="entries_lead.tpl"}  
						</div><!-- /#lead -->
						 
				{/if}
				
	 						
				{* LatestPosts*}
				{if  $template_option.latestPost_seq== $sequence && $template_option.latestPost_enable=="true" }	
					<div class="section">
						<div class="container">
							<div class="row">
								{assign var='total1' value=$template_option.latestPost_amount1}
								{assign var='total2' value=$template_option.latestPost_amount2}
								 
								{serendipity_fetchPrintEntries limit="0,$total1" entryprops="entry_specific_header_image != ''" category=$template_option.latestPost_cat1 noCache=false fetchDrafts=false full=true use_footer=false noSticky=true  template="entries_latestPosts.tpl"}                      
								{* Show entries Latest News: If choose no category in theme config *}
								{if $template_option.latestPost_cat2 =="0"}
									{serendipity_fetchPrintEntries   entryprops="entry_category.category_name != 'K1'" full=true fetchDrafts=false noSticky=true limit="0,$total2" template="entries_latestNews.tpl"}
								{else}
									{serendipity_fetchPrintEntries   category=$template_option.latestPost_cat2  full=true fetchDrafts=false noSticky=true limit="0,$total2" template="entries_latestNews.tpl"}
								{/if}
							</div>
						</div>
					</div>	
					 
				{/if}			


				{* Slider*}
				{if $template_option.rlslider1_seq== $sequence && $template_option.rlslider1_enable =="true"}			    	
						 {include file='include/mySlider.tpl'}
						<br/>
				{/if}				
 
				{* 3 Boxes in one row on startpage*}
				{if $template_option.startpagerows_seq== $sequence && $template_option.startpagerows_enable=="true"}	
					{include file='include/include_content3box.tpl'} 
				{/if}	
				
				{* our team on startpage*}
				{if $template_option.startpagerows_seq== $sequence && $template_option.enable_workers=="true"}	
					{include file='include/include_team.tpl'}	
				{/if}
			{/for}	
         
				
  {else}{* normaler Content *}
	{if $view=='404'}
          <p class="alert alert-danger alert-error"><span class="fa-stack" aria-hidden="true"><i class="fa fa-circle-thin fa-stack-2x"></i><i class="fa fa-exclamation fa-stack-1x"></i></span> {$CONST.ERROR_404}</p>
           <nav role="navigation">
               <ul class="pager">                
                    <li class="previous"><a href="{$serendipityBaseURL}">{$CONST.HOMEPAGE} - {$blogTitle}</a></li>
               </ul>
            </nav>
     {else}
	   {if $currpage== $template_option.google_map_staticpage && $template_option.googlemap_support=='true'}  
			 {include file='include/include_googlemaps.tpl'}<hr>
		   {/if}  
	 	 <div class="container">
			<div class="row">
				
{*	{if $staticpage_custom.show_sidebars !="true" && $staticpage_pagetitle !=""}	*}
	
			{if $staticpage_pagetitle !=""}
				{if $staticpage_custom.show_sidebars !="true"}<div class="col-sm-12">{else} <div class="col-sm-8">{/if}
					{$CONTENT}
				</div>
			
			{else}
	
	
				{if $template_option.show_rightsidebar =="1"} 


				 <div class="col-sm-8">	
				 {else} 
				<div class="col-sm-12">{/if}


				{$CONTENT}
				</div>
			{/if}	
				
				
				
				{if $template_option.show_rightsidebar =="1"}
				<div class="col-sm-1">	</div><div class="col-sm-3">	
					<div id="bothsidbars" class="bss">
 					 {if $leftSidebarElements > 0}{serendipity_printSidebar side="left"}{/if}
					 {if $rightSidebarElements > 0}{serendipity_printSidebar side="right"}{/if}
					</div> 
				</div>	
				{/if}
			</div>
		</div>	
      {/if}
 {/if}	
 </main>
	
	
	
	 
    <hr> 
{* FOOTER *}
    
	 
   {include file='include/include_footer.tpl'} 
 
	 
	
	 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="/templates/Universal-master/js/jquery-1.9.1.min.js"><\/script>')</script>
        <script src="/templates/Universal-master/js/bootstrap.min.js"></script>
	
	<script src="{$serendipityBaseURL}/templates/Universal-master/js/mySlider.js"></script>
		<script src="{$serendipityBaseURL}/templates/Universal-master/js/bootstrap-cookie-consent.js"></script>
			<!-- Scrolling Nav JavaScript -->
		<script src="{$serendipityBaseURL}/templates/Universal-master/js/jquery.easing.1.3.js"></script>
		<script src="{$serendipityBaseURL}/templates/Universal-master/js/navigation-easy.js"></script>	
  {* FOOTER  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script> *} 
 
{/if}
{$raw_data}
{serendipity_hookPlugin hook="frontend_footer"}

{$template_option.bootstrap}
{if $is_embedded != true}
</body>
</html>
{/if}