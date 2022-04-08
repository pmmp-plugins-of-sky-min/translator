<?php
/**
 *      _                    _       
 *  ___| | ___   _ _ __ ___ (_)_ __  
 * / __| |/ / | | | '_ ` _ \| | '_ \ 
 * \__ \   <| |_| | | | | | | | | | |
 * |___/_|\_\\__, |_| |_| |_|_|_| |_|
 *           |___/ 
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the MIT License. see <https://opensource.org/licenses/MIT>.
 * 
 * @author skymin
 * @link   https://github.com/sky-min
 * @license https://opensource.org/licenses/MIT MIT License
 * 
 *   /\___/\
 * 　(∩`・ω・)
 * ＿/_ミつ/￣￣￣/
 * 　　＼/＿＿＿/
 *
 */

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

	public function getLocalList() : array{
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
		if($local === null || !isset($this->langs[$local])){
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
