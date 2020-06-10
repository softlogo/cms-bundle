<?php
namespace Softlogo\CMSBundle\Lib;

class Util{

	public function slugify($string)
	{
		$rule = 'NFD; [:Nonspacing Mark:] Remove; NFC';
		$transliterator = \Transliterator::create($rule);
		$string = $transliterator->transliterate($string);

		return preg_replace(
			'/[^a-z0-9]/',
			'-',
			strtolower(trim(strip_tags($string)))
		);
	}

}
