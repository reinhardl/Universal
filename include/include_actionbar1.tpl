<div class="section">
	 
			{foreach from=$actionbars item="actionbar" name="worker" key=worker}           
				
				  		{if $sequence== $actionbar.bars_seq && $actionbar.enable_actionbar=="TRUE"}   
							<div class="container">			
								<div class="row">
									<div class="col-md-12">
									<hr>
										 {$actionbar.atext}	  										
										{If $is_logged_in == '1'} 								
											<a class=" btn-primary btn-xs" href="{$serendipityBaseURL}serendipity_admin.php?serendipity[adminModule]=templates&serendipity[adminAction]=editConfiguration" role="button">Theme-Config</a>																	
										{/if} 
										<hr>
									</div>
								</div>
							</div>
							
				 	  {/if}             
						
				</div>
			{/foreach}	
</div>