{serendipity_hookPlugin hook="entries_header" addData="$entry_id"}
	        		<div class="col-sm-6 featured-news">
	        			<h2>{$template_option.latestPost_header2}</h2>				
					{foreach from=$entries item="dategroup"}
					{foreach from=$dategroup.entries item="entry"}
						<div class="row">
							 <div class="col-sm-12">
								<div class="caption"><a href="{$entry.link}" rel="bookmark">{$entry.title|@default:$entry.id}&raquo;</a></div>
								<div class="date">{$entry.timestamp|@formatTime:DATE_FORMAT_ENTRY}</div>
								 
								<div class="intro"><p> {$entry.body|strip_tags|truncate:$template_option.latestPost_textcount2:" ..."}  </p> 
								<a class="btn btn-primary btn-xs" href="{$entry.link}" role="button">{$CONST.READ_MORE}</a> 
								{if $entry.is_entry_owner and not $is_preview}
									<a class=" btn-primary btn-xs" href="{$entry.link_edit}" role="button">{$CONST.EDIT_ENTRY}</a>
									{/if}</div>
							</div>
						</div>       
						<br/>
					{/foreach}
					{/foreach}												
	        		</div>
 {serendipity_hookPlugin hook="entries_footer"}