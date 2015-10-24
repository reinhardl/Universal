 
{if $entry.trackbacks !="0" } 


<ul class="timeline">
{foreach from=$trackbacks item=trackback}
   
      <li class="{cycle name="li_cycle_1" values=" ,timeline-inverted"}">
		<div class="timeline-badge">
        
          <a><i class=" {cycle name="named_cycle_2" values="fa fa-circle,fa fa-circle invert"}" id=""></i></a>
        </div>
        <div class="timeline-panel">
	
            <div class="timeline-heading">
                <h4> <a href="{$trackback.url|strip_tags}">{$trackback.title}</a></h4>
            </div>
            <div class="timeline-body">
				{if $trackback.body == ''}
					<p>{$CONST.NO_ENTRIES_TO_PRINT}</p>
				{else}
					<details>
						 
						<div class="content">{$trackback.body|strip_tags|escape:'htmlall'}</div>
					</details>
				{/if}

			</div>
            <div class="timeline-footer">
               <p class="text-right"> <cite>{$trackback.author|default:$CONST.ANONYMOUS}</cite></p>
		   </div>
        </div>
    </li>
 
{/foreach}
    <li class="clearfix no-float"></li>
</ul>	
{else}
<div class="alert alert-info" role="alert">
 <p class="serendipity_msg_notice">{$CONST.NO_TRACKBACKS}</p>	
 </div>
{/if}