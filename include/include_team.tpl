<div class="section">
	    	<div class="container">
			
			<div class="row">
						<div class="col-md-12"> 
							<h2>{$template_option.worker1_title}</h2> 
							 <h3>{$template_option.worker1_desc}</h3> 
						</div>      
					</div>
			
			
				<div class="row">

				{foreach from=$workers1 item="worker1" name="worker" key=worker}           
					<div class="col-md-4 col-sm-6">
						<div class="mitarbeiter-member">
							<div class="mitarbeiter-member-image">
							<a {if $worker1.link2=='Lightbox'}rel="lightbox" {/if} href="{$worker1.link1}"><img src="{$worker1.bg_img}"  alt="{$worker1.bg_img}"></a>
							 </div>
							 
							<div class="mitarbeiter-member-info">
								<ul>
									<!-- Team Member Info & Social Links -->
									<li class="mitarbeiter-member-name">
										{$worker1.text1}  
										<!-- Team Member Social Links -->
										<span class="mitarbeiter-member-social">
											{if $worker1.facebook !=''}	<a href="{$worker1.facebook}"><i class="icon-facebook"></i></a>{/if}
											{if $worker1.github !=''}	<a href="{$worker1.github}"><i class="icon-github"></i></a>{/if}
											{if $worker1.tumblr !=''}	<a href="{$worker1.tumblr}"><i class="icon-tumblr"></i></a>{/if}
										</span>
									</li>
									<li>{$worker1.text2} {$worker1.link2}</li>
									{If $is_logged_in == '1'} 
									
										<a class=" btn-primary btn-xs" href="{$serendipityBaseURL}serendipity_admin.php?serendipity[adminModule]=templates&serendipity[adminAction]=editConfiguration" role="button">Theme-Config</a>								
									
									  {/if}
								</ul>												 						 
							</div>
						</div>	
					</div>		
				{/foreach}					
		</div>
	</div>
</div>
		
		
 		
		
