<?php
class SpecialPatchNotes extends SpecialPage {
	function __construct() {
		parent::__construct( 'MyExtension' );
	}
	
	function parse ( $notes ) {
		$array = array();
		
		$handle = fopen($notes, 'r');
		if ($handle) {
			while ($line = fgets($handle)) {
				if (explode(' ', trim($line)) = 'Update') {
					array_push($array, '== ' + $line + ' ==');
				}
				else {
					array_push($array, '* ' +$line);
				}
			}
		}
		fclose($handle);
	}
	
	function execute( $par ) {
		$request = $this->getRequest();
		$output = $this->getOutput();
		$this->setHeaders();
 
		$param = $request->getText( 'param' );
		
		$wikitext = parse($wgPatchNotesURL);
		$output->addWikiText( $wikitext );
	}
}