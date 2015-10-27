<h3>{$template_option.nav_headline}&nbsp;</h3>
							<ul>
								{foreach from=$navlinks item="navlink" name="sitenav"}
									 <li><a href="{$navlink.href}" title="{$navlink.title}">{$navlink.title}</a><br/> </li>
								{/foreach} 
								{if $entry.is_entry_owner and not $is_preview}
								 <li>	<a class=" btn-primary btn-xs" href="{$serendipityBaseURL}serendipity_admin.php?serendipity[adminModule]=templates&serendipity[adminAction]=editConfiguration" role="button">{$CONST.EDIT_ENTRY}</a> </li>
									{/if}  
									 
								 
							</ul>