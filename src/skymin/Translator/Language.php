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

use skymin\data\Data;

final class Language{

	private Data $data;

	public function __construct(private string $local, string $filepath){
		$this->data = new Data($filepath, Data::INI);
	}

	public function getLocal() : string{
		return $this->local;
	}

	public function getAll() : array{
		return $this->data->__get();
	}

	public function getText(string $id) : string{
		if($this->data->__isset($id)){
			return $this->data->__get($id);
		}
		throw new TranslatorException("Could not find {$id} in {$this->local} language file.");
	}

}
