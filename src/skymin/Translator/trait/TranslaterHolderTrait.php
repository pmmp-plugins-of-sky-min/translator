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

namespace skymin\Translator\trait;

use skymin\Translator\{Translator, Language, TranslatorException};

trait TranslaterHolderTrait{

	private ?Translator $translator = null;

	private function setDefaultLang(Language $lang) : void{
		if($this->translator === null){
			$this->translator = new Translator($lang);
		}else{
			throw new TranslatorException('Can only be specified once.');
		}
	}

	public function getTranslater() : Translator{
		if($this->translator === null){
			throw new TranslatorException('Need to set the default language.');
		}else{
			return $this->translator;
		}
	}

	public function getResourceFolder() : string{
		return $this->getFile() . 'resources/';
	}

}
