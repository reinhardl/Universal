{serendipity_hookPlugin hook="entries_header" addData="$entry_id"}
	        		<!-- Featured News -->
	        		<div class="col-sm-6 featured-news">
	        			<h2>{$template_option.latestPost_header1}</h2>			
					{foreach from=$entries item="dategroup"}
					{foreach from=$dategroup.entries item="entry"}
						<div class="row">
							<div class="col-xs-4"><a href="{$entry.link}" rel="bookmark" title="Permanent link: {$entry.title}"><img class="img-responsive maxPicHeight" src="{$entry.properties.entry_specific_header_image}" alt="Post Title"></a></div>
							<div class="col-xs-8">
								<div class="caption"><a href="{$entry.link}" rel="bookmark">{$entry.title|@default:$entry.id}&raquo;</a></div>
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
					{/foreach}												
	        		</div>	
 {serendipity_hookPlugin hook="entries_footer"}