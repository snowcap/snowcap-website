<?php
namespace Snowcap\SiteBundle\Twig\Extension;

class RelativeTime extends \Twig_Extension {

	public function getFilters() {
		return array('relativeTime' => new \Twig_Filter_Method($this, 'relativeTime'), );
	}

	public function relativeTime($datetime) {

		$difference = time() - $datetime->getTimestamp();
		$periods = array("sec", "min", "hour", "day", "week", "month", "years", "decade");
		$lengths = array("60", "60", "24", "7", "4.35", "12", "10");

		if($difference > 0) { // this was in the past
			$ending = "ago";
		} else { // this was in the future
			$difference = -$difference;
			$ending = "to go";
		}
		for($j = 0; $difference >= $lengths[$j]; $j++)
			$difference /= $lengths[$j];
		$difference = round($difference);
		if($difference != 1)
			$periods[$j] .= "s";
		$text = "$difference $periods[$j] $ending";
		return $text;

	}

	public function getName() {
		return 'relativeTime';
	}
}
