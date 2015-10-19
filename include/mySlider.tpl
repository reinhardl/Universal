<div class="container">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">  
      <!-- Wrapper for slides -->
      <div class="carousel-inner">
 		{foreach from=$sliders1 item="slider1" name="slider" key=slider}   			
			<div class="item {if $smarty.foreach.slider.first} active{/if}">
				<img src="{$slider1.bg_img}">
					<div class="carousel-caption">
						<h1>{$slider1.text1}</h1>
						<p>  <a href="{$slider1.morem}"   class="label label-danger">{$CONST.READ_MORE}</a></p>
					</div>
			</div><!-- End Item -->		
		{/foreach}	  
      </div><!-- End Carousel Inner -->

		<ul class="nav nav-pills nav-justified">
 	 		{foreach from=$sliders1 item="slider1" name="slider" key=slider}   						 
				<li data-target="#myCarousel" data-slide-to="{$smarty.foreach.slider.index}" class="active"><a href="{$slider1.morem}">{$slider1.text2}<small>{$slider1.text3}</small></a></li> 	
			{/foreach}  
		</ul>
     </div><!-- End Carousel -->
</div>






 