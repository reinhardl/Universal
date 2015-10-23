 
         
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-custom navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                {* Brand and toggle get grouped for better mobile display *}
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">{$CONST.TOGGLE_NAV}</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{$serendipityBaseURL}" title="{$CONST.HOMEPAGE}">{$template_option.home_link_text}</a>
                    <a class="navbar-brand" href="#basicModal" data-toggle="modal" data-target="#basicModal" title="{$CONST.SEARCH}"><i class="fa fa-search" aria-hidden="true"></i></a>
                    <a class="navbar-brand" href="{$archiveURL}" title="{$CONST.ARCHIVES}"><i class="fa fa-calendar" aria-hidden="true"></i></a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              
 <ul class="nav navbar-nav navbar-right">
							  {if $template_option.navlink_home}<li {if $currpage==$serendipityBaseURL}class="active"{/if} ><a href="{$serendipityBaseURL}">Home</a></li> {/if}	
							  {if $template_option.navlink_archive}	<li {if $view=='archive' or $currpage2=='/index2.php?/archive'}class="active"{/if} ><a href="{$serendipityRewritePrefix}archive">Archive</a></li>  {/if}	            
			
				
							  {foreach from=$hauptmenue item="hauptmenupunkt" name="navbar2"}
									{if !empty($hauptmenupunkt.untermenue)} 
									<li  class="dropdown">  
										{else} 
									<li>	
									{/if}
									<a  {if !empty($hauptmenupunkt.untermenue)}class="dropdown-toggle" data-toggle="dropdown"{/if} href="{$hauptmenupunkt.href}" title="{$hauptmenupunkt.title}"{if $hauptmenupunkt.target=='true'} target="_blank"{/if}>{$hauptmenupunkt.title}{if !empty($hauptmenupunkt.untermenue)}&nbsp;  {else}  {/if}{if !empty($hauptmenupunkt.untermenue)}<i class="icon-angle-down"></i>{/if}</a>
					   				
									{if !empty($hauptmenupunkt.untermenue)} 
									<ul class="dropdown-menu" >
										{foreach from=$hauptmenupunkt.untermenue item="sub" name=subnavbar2}
											<li><a href="{$sub.href}" title="{$sub.title}"{if $sub.target=='true'} target="_blank"{/if}>{$sub.title}</a></li>
										{/foreach}
									</ul>
									{/if}
									</li> 									
								{/foreach}				
 
                </ul>



			  </div>
            </div>
        </nav>
  