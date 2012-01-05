<?php
namespace Ez\ToolsBundle\Extension;

class TwigTools extends \Twig_Extension {

	public function getFilters() {
		return array(
			'dump' => new \Twig_Filter_Method($this, 'dump'),
			'join' => new \Twig_Filter_Method($this, 'join'),
			'nl2br' => new \Twig_Filter_Method($this, 'nl2br'),
		);
	}

	public function getTags() {
		return array(
			'page_title' => new \Twig_Filter_Method($this, 'page_title'),
		);
	}

	public function page_title() {
		return 'oele';
	}

	public function join( $objects, $glue = ', ', $lastGlue = null ) {
		null === $lastGlue && $lastGlue = $glue;

		$last = '';
		if ( 2 < count($objects) ) {
			$last = $lastGlue . array_pop($objects);
		}

		return implode($glue, $objects) . $last;
	}

	public function dump($var) {
		var_dump($var);
		return '';
	}
	
	public function nl2br($text) {
		return nl2br($text);
	}

	public function getName()
	{
		return 'TwigTools';
	}

}