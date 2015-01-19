<?php
namespace Pragmatic;

class View {
	
	protected static $tplLocation;
	protected static $mainTpl;
	protected $pathSuffix;
	protected $request;
	
	public static function setTplLocation($tplLocation) {
		self::$tplLocation = $tplLocation;
	}
	
	public static function setMainTpl($mainTpl) {
		self::$mainTpl = $mainTpl;
	}
	
	public function __construct(Request $request) {
		$this->request = $request;
	}
	
	public function setSuffix($locationSuffix) {
		$this->pathSuffix = $locationSuffix;
	}
	
	
	public function render($tpl, $data, $skipMainTemplate = false) {
		
		if ( !$skipMainTemplate ) {
			$mainTpl = self::$tplLocation.DIRECTORY_SEPARATOR.self::$mainTpl;
		
			if ( !file_exists($mainTpl) ) {
				return false;
			}
		}
		
		
		$tpl = self::$tplLocation.DIRECTORY_SEPARATOR.$this->pathSuffix.DIRECTORY_SEPARATOR.$tpl;
		
		if ( !file_exists($tpl) ) {
			return false;
		}
		
		$message = FlashMessage::read();
		$request = $this->request;
		
		ob_start();
		if ( $skipMainTemplate ) {
			include $tpl;
		} else {
			include $mainTpl;
		}
		return ob_get_clean();
	}
	
}

