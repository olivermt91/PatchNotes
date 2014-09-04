<?php
class SpecialPatchNotes extends SpecialPage {
	function __construct() {
		parent::__construct( 'MyExtension' );
	}
 
	function execute( $par ) {
		$request = $this->getRequest();
		$output = $this->getOutput();
		$this->setHeaders();
 
		# Get request data from, e.g.
		$param = $request->getText( 'param' );
 
		# Do stuff
		# ...
		$array = file('https://upgrades.pfestore.com/advantage/14.2.8.67/Patch/Patch%20Notes.txt');
		
		$wikitext = $array;
		$output->addWikiText( $wikitext );
	}
}