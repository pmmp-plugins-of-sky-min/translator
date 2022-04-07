<?php
declare(strict_types = 1);

namespace skymin\Translator;

use function str_replace;

final class Translator{

	private string $default;

	/**
	 * @var Language[]
	 * @phpstan-var array<string, Language>
	 */
	private array $langs = [];

	public function __construct(Language $default){
		$this->default = $default->getLocal();
		$this->addLanguage($default);
	}

	public function getDefaultLocal() : string{
		return $this->default;
	}

	public function getLocalList() : void{
		return array_keys($this->langs);
	}

	public function addLanguage(Language $lang) : void{
		$local = $lang->getLocal();
		if(isset($this->langs[$local])){
			throw new TranslatorException('This is an already registered local name');
		}
		$this->langs[$local] = $lang;
	}

	public function getLanguage(string $local) : Language{
		if(isset($this->langs[$local])){
			return $this->langs[$local];
		}
		throw new TranslatorException($local . ' is not registered.');
	}

	/** @param string[] $parameters */ 
	public function translate(string $id, array $parameters, ?string $local = null) : string{
		if($local === null){
			$local = $this->default;
		}
		$str = $this->getLanguage($local)->getText($id);
		$count = 1;
		foreach($parameters as $parameter){
			$str = str_replace('{%' . $count . '}',  $parameter, $str);
			$count++;
		}
		return $str;
	}

}
