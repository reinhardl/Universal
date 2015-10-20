
    

{serendipity_hookPlugin hook="entries_header" addData="$entry_id"}
 

<div class="container">
    <div class="row">
    	<div class="col-md-12">
		
 
	{foreach from=$entries item="dategroup"}
		{foreach from=$dategroup.entries item="entry"}
		  {assign var="entry" value=$entry scope="parent"}
    
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
							<div class="col-md-6 col-xs-6 price">
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
   </div> {If $is_logged_in == '1'} 
									
								 	<a class=" btn-primary btn-xs" href="{$serendipityBaseURL}serendipity_admin.php?serendipity[adminModule]=templates&serendipity[adminAction]=editConfiguration" role="button">Theme-Config</a>	 							
									
									 {else}  <br/>{/if}	 <hr>	

	</div>
</div> 
{serendipity_hookPlugin hook="entries_footer"}
 
