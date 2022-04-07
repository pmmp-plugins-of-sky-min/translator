<?php
declare(strict_types = 1);

namespace skymin\Translator\trait;

use skymin\Translator\{Translator, Language, TranslatorException};

trait TranslaterHolderTrait{

	private ?Translator $translator = null;

	private function setDefaultLang(Language $lang) : void{
		if($translator === null){
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

}