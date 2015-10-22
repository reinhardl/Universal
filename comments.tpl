<ul class="timeline">
{foreach from=$comments item=comment name="comments"}
    <li class="{cycle name="li_cycle_1" values=" ,timeline-inverted"}">
		<div class="timeline-badge">
        
          <a><i class=" {cycle name="named_cycle_2" values="fa fa-circle,fa fa-circle invert"}" id=""></i></a>
        </div> 
        <div class="timeline-panel">
            <div class="timeline-heading">
                 <h4>{if $comment.url}<a href="{$comment.url}">{/if}{$comment.author|default:$CONST.ANONYMOUS}{if $comment.url}</a>{/if} {$CONST.ON} :</h4>
            </div>
            <div class="timeline-body">
                {if $comment.body == 'COMMENT_DELETED'}
            <p class="serendipity_msg_important">{$CONST.COMMENT_IS_DELETED}</p>
        {else}
            {$comment.body}
        {/if}
            </div>
            <div class="timeline-footer">
                <p class="text-right"> <time datetime="{$comment.timestamp|serendipity_html5time}">{$comment.timestamp|formatTime:$template_option.date_format}</time></p>
            </div>
        </div>
    </li>

{foreachelse}
    <p class="serendipity_msg_notice">{$CONST.NO_COMMENTS}</p>	
{/foreach}	 
    <li class="clearfix no-float"></li>
</ul>