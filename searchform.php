<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
    
    	<label class="screen-reader-text" for="s">Search for:</label>
    	
    	<div class="search-wrap">
        	<input type="text" value="" placeholder="Search" name="s" id="search-input" />
        </div>
        
        <button type="submit" id="searchsubmit">
        	<i class="icon-search"></i>
        </button>
</form>