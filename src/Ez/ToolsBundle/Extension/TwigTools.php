<?php
namespace Ez\ToolsBundle\Extension;

use Twig_Extension;
use Twig_Filter_Method;
use Twig_Function_Method;

class TwigTools extends Twig_Extension {

	/**
	 * Definitions
	 */

	// extension name
	public function getName() {
		return 'TwigTools';
	}

	// filters
	public function getFilters() {
		return array(
			// debug
			'dump' => new Twig_Filter_Method($this, 'dump'),
			'print_r' => new Twig_Filter_Method($this, 'print_r'),

			// markup
			'nl2br' => new Twig_Filter_Method($this, 'nl2br'),
			'join' => new Twig_Filter_Method($this, 'join'),

			// escape
			'html' => new Twig_Filter_Method($this, 'html'),
			'javascript' => new Twig_Filter_Method($this, 'javascript'),
		);
	}

	// functions
	public function getFunctions() {
		return array(
			'link' => new Twig_Function_Method($this, 'link'),
		);
	}


	/**
	 * Callbacks
	 */

	// link
	public function link( $label, $path, $options = array() ) {
		return '<a href="' . $path . '">' . $label . '</a>';
	}

	// link
	public function html( $text ) {
		$flags = ENT_COMPAT;
		defined('ENT_HTML5') && $flags |= ENT_HTML5;

		return htmlspecialchars($text, $flags, 'UTF-8');
	}

	// link
	public function javascript( $text ) {
		return addslashes($text);
	}

	// link
	public function join( $objects, $glue = ', ', $lastGlue = null ) {
		null === $lastGlue && $lastGlue = $glue;

		$last = '';
		if ( 2 < count($objects) ) {
			$last = $lastGlue . array_pop($objects);
		}

		return implode($glue, $objects) . $last;
	}

	// link
	public function dump($var) {
		var_dump($var);
		return '';
	}

	// link
	public function print_r($var) {
		return print_r($var, 1);
	}

	// link
	public function nl2br($text) {
		return nl2br($text);
	}

}