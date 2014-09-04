<?php
class SpecialPatchNotes extends SpecialPage {
	function __construct() {
		parent::__construct( 'MyExtension' );
	}
	
	function execute( $par ) {
		$request = $this->getRequest();
		$output = $this->getOutput();
		$this->setHeaders();
 
		$param = $request->getText( 'param' );
 
		$array = array();
		
		$handle = fopen($wgPatchNotesURL, 'r');
		if ($handle) {
			while ($line = fgets($handle)) {
				if (explode(' ', trim($line)) = 'Update') {
					array_push($array, '== ' + $line + ' ==');
				} else {
					array_push($array, '* ' +$line);
				}
			}
		} else {
			$output->addWikiText( "Something's wrong!" );
		}
		fclose($handle);
		
		foreach ($array as $value) {
			$output->addWikiText( $value );
		}
	}
}