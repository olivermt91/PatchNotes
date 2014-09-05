<?php
class SpecialPatchNotes extends IncludableSpecialPage {
	function __construct() {
		parent::__construct('MyExtension');
	}
	
	function getContents($file){
		$handle = fopen($file, 'r');
		$contents = stream_get_contents($handle);
		fclose($handle);
		
		return $contents;
	}
	
	function listPages() {
		$xmlstr = $this->getContents('https://upgrades.pfestore.com/advantage/feed.xml');
		$feed = new SimpleXMLElement($xmlstr);
		$titles = array();
		
		foreach($feed->entry as $entry) {
			array_push($titles, '[[Special:PatchNotes/' . $entry->title . '|Version ' . $entry->title . "]]\n");
		}
		
		return implode("\n", $titles);
	}
	
	function parse ( $notes ) {
		$array = array();
		
		$handle = fopen($notes, 'r');
		if ($handle) {
			while ($line = fgets($handle)) {
				$line = trim( $line );
				if (strpos($line, 'Update ') === 0) {
					array_push($array, '=== ' . $line . ' ===');
				} elseif ( strlen( $line ) === 0 ) {
					array_push($array, '' );
				} else {
					array_push($array, '* ' . $line );
				}
			}
		}
		fclose($handle);
		return implode("\n", $array);
	}
	
	function execute( $par ) {
	
		$request = $this->getRequest();
		$output = $this->getOutput();
		$this->setHeaders();
 
		$param = $request->getText( 'param' );
		
		$pageList = $this->listPages();
		
		if(isset($par)){
			$wikitext = '== Version ' . $par . ' ==' . "\n" . $this->parse('https://upgrades.pfestore.com/advantage/' . $par . '/Patch/Patch%20Notes.txt') . "\n" . '[[Special:PatchNotes|Return to Patch Notes]]';
			
			$output->addWikiText($wikitext);
		}
		else {
			$output->addWikiText($pageList);
		}
	}
}