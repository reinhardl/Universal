{serendipity_template_getdir element=$entry.properties.entry_photo_gallery_path}	
 <div class="clearfix"> </div>							 
 {foreach $filelist as $file}	        	 
 
	<div class="col-md-4 col-sm-6">
		<div class="team-member">
			<div class="team-member-image">
				<a  rel="lightbox" href="{$serendipityBaseURL}{$entry.properties.entry_photo_gallery_path}/{$file|replace:".serendipityThumb.":"."}"><img class="img-thumbnail" src="{$serendipityBaseURL}{$entry.properties.entry_photo_gallery_path}/{$file}" alt="{$file}"></a>
			</div>
			<div class="team-member-info">
			</div>
		</div>	
	</div>		
 {/foreach}	
 <div class="clearfix"></div><br/>
 