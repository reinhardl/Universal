{serendipity_hookPlugin hook="entries_header"}
{if $template_option.show_pic_in_archive=="TRUE"}
	<article class="archives">
	<h2>{$CONST.TOPICS_OF} {$dateRange.0|formatTime:"%B %Y"}</h2>
    

	
	<div class="row">
	  <h5 id="archiv">&nbsp;</h5>
	 {foreach from=$entries item="sentries"}
        {foreach from=$sentries.entries item="entry"}
     
       <div class="col-sm-6 col-md-4">
				<div class="thumbnail" >
					<h4 class="text-center"><span class="label label-info">  {$entry.properties.entry_subtitle|escape}</span></h4>
					 
					{if $entry.properties.entry_specific_header_image !=''}
						 <a  href="{$entry.link}" rel="bookmark" title="Permanent link: {$entry.title}"><img class="img-responsive" src="{$entry.properties.entry_specific_header_image}" alt="{$entry.properties.entry_specific_header_image}" /></a>
					{/if}
					<div class="caption">
						<div class="row">
							<div class="col-md-6 col-xs-6">
								<a  href="{foreach from=$entry.categories item="entry_category"}{$entry_category.category_link}{/foreach}">{foreach from=$entry.categories item="entry_category"}{$entry_category.category_name|@escape}{/foreach}</a> 
							</div>
							<div class="col-md-12">
								 <h5 ><a class="title" href="{$entry.link}" rel="bookmark">{$entry.title|@default:$entry.id}&raquo;</a> </h5>
							</div>
						</div>
						<p><small>{$entry.body|strip_tags|truncate:$textlaenge:" ..."} 

						</small></p>
						<div class="row">
							<div class="col-md-4">
								<a href="{$entry.link}" class="btn btn-primary btn-product"><span class="glyphicon glyphicon-thumbs-up"></span> Details</a> 
							</div>
							<div class="col-md-8">
								{if $entry.is_entry_owner and not $is_preview}&nbsp;&nbsp;<a href="{$entry.link_edit}"  title="{$CONST.EDIT_ENTRY}"><button class="btn-primary btn-xs"><small>  {$CONST.EDIT_ENTRY}</small> </button></a>{/if}
								
								</div>
						</div>

						<p> </p>
					</div>
				</div>
			</div>
        {/foreach}
    {/foreach}
	 
	</div>
	
</article>
{else}
{counter start=0 assign='entry_count'}
{foreach from=$entries item="countme"}
    {foreach from=$countme.entries item="entry"}
        {counter assign='entry_count'}
    {/foreach}
{/foreach}

<article class="archive-summary">
    <h2>{if $category}{$category_info.category_name} - {/if}{$entry_count} {$CONST.TOPICS_OF} {$dateRange.0|@formatTime:"%B, %Y"}</h2>
    <ul class="archives_summary plainList">
    {foreach from=$entries item="sentries"}
        {foreach from=$sentries.entries item="entry"}
        <li><h3><a href="{$entry.link}">{$entry.title}</a></h3>
             <p class="post-meta">{$CONST.POSTED_BY} <a href="{$entry.link_author}">{$entry.author}</a> {$CONST.ON} <time datetime="{$entry.timestamp|@serendipity_html5time}">{$entry.timestamp|@formatTime:$template_option.date_format}</time></p>
        </li>
        {/foreach}
    {/foreach}
    </ul>
</article>	
	{/if}
{serendipity_hookPlugin hook="entries_footer"}
 