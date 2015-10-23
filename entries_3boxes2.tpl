 
 





<div class="container">
  <div class="row hover-row">
	{foreach from=$entries item="dategroup"}
		{foreach from=$dategroup.entries item="entry"}
		  {assign var="entry" value=$entry scope="parent"}
		  
			<div class="col-xs-4">
				{if $entry.properties.entry_specific_header_image !=''}
					<a  href="{$entry.link}" rel="bookmark" title="Permanent link: {$entry.title}"><img  src="{$entry.properties.entry_specific_header_image}" alt="{$entry.properties.entry_specific_header_image}" /></a>
				{/if}
				<div class="text-center"><h4><a class="title" href="{$entry.link}" rel="bookmark">{$entry.title|@default:$entry.id}&raquo;</a></h4>  
					<p><small>{$entry.body|strip_tags|truncate:$textlaenge:" ..."} 	</small></p>
				</div>	  
			</div>
     
		{/foreach}
	{/foreach}		
	 <div class="hover"></div>
	 </div>
</div>	 