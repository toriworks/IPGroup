<?php

if ( ! function_exists('if_add_class'))
{
	function if_add_class($condition = FALSE, $class = '')
	{
		if ($condition)
		{
			return ' class="'.$class.'"';
		}
		else
		{
			return '';
		}
	}
}

?>