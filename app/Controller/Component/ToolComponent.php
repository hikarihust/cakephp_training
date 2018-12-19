<?php
/**
 * 
 */
class ToolComponent extends Component{
	
	public function array_sum($cart, $quantity_col='quantity', $price_col='price'){
		$total = 0;
		foreach ($cart as $item) {
			$total += $item[$quantity_col]*$item[$price_col];
		}
		return $total;
	}
}