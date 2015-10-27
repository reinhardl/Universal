							<h3>{$template_option.social_header}</h3>
							<p>{$template_option.social_description}</p>
							<div>	    				 
								{if $template_option.facebook_url !=''}	<a href="{$template_option.facebook_url}"><img alt="facebook" width="32" src="{$serendipityBaseURL}/templates/Basica/img/icons/facebook.png" style="border-width: 0px"  /></a>{/if}						
								{if $template_option.twitter_url !=''}<a href="{$template_option.twitter_url}"><img alt="Twitter" width="32" src="{$serendipityBaseURL}/templates/Basica/img/icons/twitter.png" style="border-width: 0px"  /></a>{/if} 	
								{if $template_option.linkedin_url !=''}<a href="{$template_option.linkedin_url}"><img alt="LinkedIn" width="32" src="{$serendipityBaseURL}/templates/Basica/img/icons/linkedIn.png" style="border-width: 0px"  /></a>{/if} 
								{if $template_option.rss_url !=''}<a href="{$template_option.rss_url}"><img alt="RSS" width="32" src="{$serendipityBaseURL}/templates/Basica/img/icons/rss.png" style="border-width: 0px"  /></a>{/if} 							
								{if $template_option.dribbble_url !=''}<a href="{$template_option.dribbble_url}"><img alt="dribbble" width="32" src="{$serendipityBaseURL}/templates/Basica/img/icons/Dribbble.png" style="border-width: 0px"  /></a>{/if} 	
								{if $template_option.github_url !=''}<a href="{$template_option.github_url}"><img alt="github" width="32" src="{$serendipityBaseURL}/templates/Basica/img/icons/Github.png" style="border-width: 0px"  /></a>{/if} 		    				 
								{if $template_option.instagram_url !=''}<a href="{$template_option.instagram_url}"><img alt="instagram" width="32" src="{$serendipityBaseURL}/templates/Basica/img/icons/Instagram.png" style="border-width: 0px"  /></a>{/if} 						 							
								{if $template_option.pinterest_url !=''}<a href="{$template_option.pinterest_url}"><img alt="pinterest" width="32" src="{$serendipityBaseURL}/templates/Basica/img/icons/Pinterest.png" style="border-width: 0px"  /></a>{/if} 	
								{if $template_option.youtube_url !=''}<a href="{$template_option.youtube_ur}"><img alt="youtube" width="32" src="{$serendipityBaseURL}/templates/Basica/img/icons/youtube.png" style="border-width: 0px"  /></a>{/if} 	
								{if $entry.is_entry_owner and not $is_preview}
									<a class=" btn-primary btn-xs" href="{$serendipityBaseURL}serendipity_admin.php?serendipity[adminModule]=templates&serendipity[adminAction]=editConfiguration" role="button">{$CONST.EDIT_ENTRY}</a>
								{/if} 								
							</div>