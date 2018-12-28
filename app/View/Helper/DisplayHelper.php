<?php 
/**
 * 
 */
class DisplayHelper extends AppHelper{
	public $helpers = array('Html');
	public function menu($categories, $text = null){
		$text .= '<ul>';
		foreach ($categories as $category) {
			$text .= '<li>'.$this->Html->link($category['Category']['name'], '/danh-muc/'.$category['Category']['slug']).'</li>';
			if (!empty($category['children'])) {
				$text = $this->menu($category['children'], $text);
			}
		}
		$text .= '</ul>';
		return $text;
	}
}