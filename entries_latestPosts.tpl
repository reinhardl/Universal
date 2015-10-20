{serendipity_hookPlugin hook="entries_header" addData="$entry_id"}
	        		<!-- Featured News -->
	        		<div class="col-sm-6 featured-news">
	        			<h2>{$template_option.latestPost_header1}</h2>										 
					{foreach from=$entries item="dategroup"}
					{foreach from=$dategroup.entries item="entry"}
						<div class="row">
							<div class="col-xs-4"><a href="{$entry.link}" rel="bookmark" title="Permanent link: {$entry.title}"><img class="img-responsive maxPicHeight" src="{$entry.properties.entry_specific_header_image}" alt="Post Title"></a></div>
							<div class="col-xs-8">
								<div class="caption"><a href="{$entry.link}" rel="bookmark"><h4>{$entry.title|@default:$entry.id}&raquo;</h4></a></div>
								<div class="date">{$entry.timestamp|@formatTime:DATE_FORMAT_ENTRY}</div>
								<div class="intro"><p> {$entry.body|strip_tags|truncate:$template_option.latestPost_textcount1:" ..."}</p> 
								  <a class="btn btn-primary btn-xs" href="{$entry.link}" role="button">{$CONST.READ_MORE}</a> 
								  {if $entry.is_entry_owner and not $is_preview}
									<a class=" btn-primary btn-xs" href="{$entry.link_edit}" role="button">{$CONST.EDIT_ENTRY}</a>
									{/if}
								 
								 </div>
							</div>
						</div>       <br/>
					{/foreach}
					{/foreach}		{If $is_logged_in == '1'} 
									
								 	<a class=" btn-primary btn-xs" href="{$serendipityBaseURL}serendipity_admin.php?serendipity[adminModule]=templates&serendipity[adminAction]=editConfiguration" role="button">Theme-Config</a>	 							
									
									 {else}  <br/>{/if}	 										
	        		</div>	
 {serendipity_hookPlugin hook="entries_footer"}