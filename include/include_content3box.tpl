{* 3 boxes in one row on startpage*}
{foreach from=$startpagerows item="startpagerow" name=categoryboxes key="categoryboxes" }
<div class="section">
		{if  $startpagerow.show_title =='true'} 
			{if  $startpagerow.the_title !=""}
				<div class="container">
					<div class="row">
						<div class="col-md-12"> 
							<h2>{$startpagerow.the_title}=der Titel</h2> 
							 <h3>{$startpagerow.catdescription}</h3> 
						</div>      
					</div>
				</div>  	
			{/if}
		{/if}
 
{assign var=textlaenge value=$startpagerow.truncated_qty scope="root"}  
 
{if $startpagerow.thedesign =='design1'}  
 
   
   
  	{serendipity_fetchPrintEntries limit="0,3" entryprops="entry_specific_header_image != ''" category=$startpagerow.kategorie noCache=false fetchDrafts=false full=true use_footer=false noSticky=true  template="entries_3boxes.tpl"} 
{/if}
{if $startpagerow.thedesign =='design2'}
  	{serendipity_fetchPrintEntries limit="0,3" entryprops="entry_specific_header_image != ''" category=$startpagerow.kategorie noCache=false fetchDrafts=false full=true use_footer=false noSticky=true  template="entries_3boxes2.tpl"} 
  

{/if} </div>
{/foreach}
