<form method="get" id="searchform" action="/">
                <fieldset>
                    <label for="s"><input type="text" value="<?php the_search_query(); ?>" name="s" id="s" /></label>
					<input type="submit" name="btbusca" id="searchsubmit" alt="<?php _e("Buscar", "Website"); ?>" value="<?php _e("Buscar", "Website"); ?>" title="<?php _e("Buscar", "Website"); ?>"  /> 
                </fieldset>
            </form>