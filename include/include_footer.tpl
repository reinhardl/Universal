<div class="footer">
	    	<div class="container">		
		    	<div class="row">			
		    		<div class="col-footer col-md-4 ">
		    			{if $template_option.nav_position=='left'}{include file='include/include_global_nav.tpl'} 		{/if}
						{if $template_option.social_position=='left'}{include file='include/include_social_icons.tpl'}	{/if}						
		    		</div>
					
					
					
					
		    		<div class="col-footer col-md-4 ">
		    			{if $template_option.nav_position=='middle'}{include file='include/include_global_nav.tpl'} 	{/if}			 
						{if $template_option.social_position=='middle'}{include file='include/include_social_icons.tpl'}{/if}
		    		</div>
					
					
					
		    		<div class="col-footer col-md-4 ">
		    			{if $template_option.nav_position=='right'} {include file='include/include_global_nav.tpl'} 	{/if}					
						{if $template_option.social_position=='right'}{include file='include/include_social_icons.tpl'}{/if}					
							
							 {serendipity_showPlugin class="serendipity_plugin_freetag"}	 			
					
					
					
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
					{If $is_logged_in == '1'}  
						<div class="footer-copyright">
						&copy; 2014 <a class=" btn-primary btn-xs" href="{$serendipityBaseURL}serendipity_admin.php?serendipity[adminModule]=templates&serendipity[adminAction]=editConfiguration" role="button">Theme-Config</a>	 							
						</div>
					{/if}	
					</div>
					</div>
				</div>
			 
</div>