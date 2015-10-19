{serendipity_hookPlugin hook="entries_header" addData="$entry_id"}

<div class="section">
	 <div class="container">
		<div class="row">
			{foreach from=$entries item="dategroup"}
				{foreach from=$dategroup.entries item="entry"}	
					<div class="col-sm-4">
						{if $entry.properties.entry_specific_header_image != ''}
							<br/><a href="{$entry.link}" rel="bookmark" title="Permanent link: {$entry.title}"><img id="leadpic" class="img-responsive" src="{$entry.properties.entry_specific_header_image}" /></a>
						{/if}
					</div>
					<div class="col-sm-8">						 
						<h3>
							<a href="{foreach from=$entry.categories item="entry_category"}{$entry_category.category_link}{/foreach}">{foreach from=$entry.categories item="entry_category"}{$entry_category.category_name|@escape}&nbsp;{/foreach}</a>
						</h3>
						<p>
							<h2> {$entry.title|@default:$entry.id}  </h2>
							{if $entry.properties.entry_subtitle}
								<h3 class="post-subtitle">{$entry.properties.entry_subtitle|escape}</h3>
							{elseif $template_option.subtitle_use_entrybody==true && $template_option.entrybody_detailed_only == true}
								<h3 class="post-subtitle">{$entry.body|@strip_tags|@strip|@truncate:70:" ..."}</h3>
							{/if}
							<div class="date">{$entry.timestamp|@formatTime:DATE_FORMAT_ENTRY}</div>
						</p>
						<p>{$entry.body|strip_tags|truncate:$template_option.catlead_textcount:" ..."} 	</p>						
						 
						<p>
							{if $entry.has_extended and not $is_single_entry and not $entry.is_extended}							 
								<a href="{$entry.link}#extended" rel="bookmark" class="btn btn-primary btn-product"><span class="glyphicon glyphicon-thumbs-up"></span> {$CONST.VIEW_EXTENDED_ENTRY|@sprintf:$entry.title}</a> 
							{/if}
							{if $entry.is_entry_owner and not $is_preview}
									<a class=" btn-primary btn-xs" href="{$entry.link_edit}" role="button">{$CONST.EDIT_ENTRY}</a>
							{/if}
						</p>
					</div>
				{/foreach}
			{/foreach}
		</div>
	</div>
</div>