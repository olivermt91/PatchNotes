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
				if (strpos($line, 'Update') === 0) {
					array_push($array, '== ' . trim( $line ) . ' ==');
				}
				else {
					array_push($array, '* ' . trim( $line ) );
				}
			}
		}
		fclose($handle);
		return implode('<br />', $array);
	}
	
	function execute( $par ) {
		global $wgPatchNotesURL;
	
		$request = $this->getRequest();
		$output = $this->getOutput();
		$this->setHeaders();
 
		$param = $request->getText( 'param' );
		
		$wikitext = $this->parse($wgPatchNotesURL);
		$output->addWikiText( $wikitext );
	}
}