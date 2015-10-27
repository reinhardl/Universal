{serendipity_hookPlugin hook="entries_header"}
 
 
<h3> {$CONST.RL_INHALT} :&nbsp;{$kategorien[$category_info.categoryid].name} {if $category_info.categoryid < 1} {$CONST.ALL_CATEGORIES} {/if} </h3> 
 
 
<hr>

<div class="row"> 
	<div class="col-md-4">
		<div class="dropdown">
			<button class="btn btn-default dropdown-toggle" type="button" id="Filter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
				Filter:&nbsp;{$kategorien[$category_info.categoryid].name} {if $category_info.categoryid < 1} {$CONST.ALL_CATEGORIES} {/if} 
				<span class="caret"></span>
			</button>
			<ul class="dropdown-menu" aria-labelledby="Filter">
				<li class="schwarz"><a href="{$serendipityBaseURL}{$serendipityRewritePrefix}archive " >-  </a> </li>
				{foreach from=$kategorien item="cat" name="foo"}
					<li class="schwarz"> <a  href="{$serendipityBaseURL}{$serendipityRewritePrefix}archive/C{$cat.categoryid} " >{$cat.name}-Archiv  </a>   </li>
				{/foreach}    
			</ul>
		</div>		
	
	</div>	
	{if $template_option.categories_on_archive =="TRUE"}
		{if $template_option.tags_on_archive =="TRUE"}<div class="col-md-4">{else}<div class="col-md-8">{/if}
	
		<h3> {$CONST.CATEGORIES}   </h3> 
		{foreach from=$kategorien item="cat" name="foo"} 
			<a href="{$cat.link}">  <span class="label label-primary">{$cat.name}</span></a>
		{/foreach}
	</div>
	{/if}
	
	
	{if $template_option.tags_on_archive =="TRUE"}
		{if $template_option.categories_on_archive =="TRUE"} <div class="col-md-4"> {else}<div class="col-md-8"> {/if}
		{serendipity_showPlugin class="serendipity_plugin_freetag"} 
	</div>	
	{/if}
</div>

 
<hr>
 <h3>{$CONST.ARCHIVE_COUNT} &nbsp;"{$kategorien[$category_info.categoryid].name} {if $category_info.categoryid < 1} {$CONST.ALL_CATEGORIES} {/if}"</h3>
<hr> <h5 id="archiv">&nbsp;</h5>
<div class="row">
	{foreach from=$archives item="archive" name="foo"}
		<div class="col-md-4">
			 
				<h3>    {$archive.year}   </h3>  
				
				<table class="table table-striped table table-condensed table-responsive ">
					<thead>
						<tr>                   
							<th>{$CONST.RL_MONAT}</th>
							<th>{$CONST.RL_ARCHIVE}</th>
                  
						</tr>
					</thead>
					<tbody>           


				
				 
					{foreach from=$archive.months item="month"}
						<tr>                
							<td>{if $month.entry_count}<a href="{$month.link}" title="{$CONST.VIEW_FULL}">{/if}{$month.date|@formatTime:"%B"}{if $month.entry_count}</a>{/if}: </td>
							<td> {if $month.entry_count}<a href="{$month.link_summary}" title="{$CONST.VIEW_TOPICS}">{/if}{$month.entry_count} {$CONST.ENTRIES}{if $month.entry_count}</a>{/if} </td>           
 
					{/foreach}
			        </tbody>
				</table>				 
				
				
			 
		</div>
		{if ($smarty.foreach.foo.iteration+1)% 3 ==1}
			 
		{/if}
	{/foreach}
</div>
  {serendipity_hookPlugin hook="entries_footer"}
