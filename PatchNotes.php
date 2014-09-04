<?php

/**
 * Patch Notes - Proprietary MediaWiki Extension for CenterEdge Software
 *
 * For more information see wiki.centeredgesoftware.com/view/Extension:Patch_Notes
 *
 * @file
 *
 * @ingroup Extensions
 *
 * @author Marshall Oliver
 *
 * @version 1.0
 *
 * @license GNU General Public License 2.0 or later
 */
 
 /**
  * The following block uses the Mediawiki global variable $wgExtensionCredits to
  * populate information into the Special:Version page of the wiki on which it is
  * installed.
  */
 
$wgExtensionCredits['other'][] = array(
	'path' => __FILE__,
	
	// Name of the Extension
	'name' => 'PatchNotes',
	
	'author' => array('Marshall Oliver', 'Sam Reedy'),
	'version' => '1.0',
	
	// The extension homepage.  Should probably consider housing the extension
	// on Mediawiki.org.  For now, the extension will be stored on the CenterEdge
	// wiki instead.
	
	'url' => 'http://wiki.centeredgesoftware.com/view/Extension:Patch_Notes',
	
	// Key name of the message containing the description.
	// 'descriptionmsg' => 'extension-desc',
);

/* Setup */

// Initialize an easy to use shortcut:
$dir = dirname( __FILE__ );
$dirbasename = basename( $dir );

// Register files
// Mediawiki needs to know which PHP files contain the class.  It has a
// registering mechanism to append to the internal autoloader.  We use
// $wgAutoLoadClasses to do this as follows:

$wgAutoloadClasses[ 'SpecialPatchNotes' ] = __DIR__ . '/specials/SpecialPatchNotes.php';
$wgMessagesDirs[ 'PatchNotes' ] = __DIR__ . "/i18n";
$wgExtensionMessagesFiles[ 'PatchNotesAlias' ] = __DIR__ . '/PatchNotes.alias.php';

// Register special page

$wgSpecialPages[ 'PatchNotes' ] = 'SpecialPatchNotes';
$wgSpecialPageGroups[ 'PatchNotes' ] = 'other';

/* Configuration */

/** 
 * Below are the extension's configuration settings.  Since these are
 * global, always use a "wg" prefix + the extension name + the setting
 * key.  The entire variable should use "lowerCamelCase".
 */

// There likely will not be many configuration variables for this extension.
// The only one I call for at the moment is the page to the patch notes.
// It is possible that this could be used to parse pages other than patch
// notes, however it would take a sizeable amount of work to do so.

$wgPatchNotesURL = 'https://upgrades.pfestore.com/advantage/14.2.8.67/Patch/Patch%20Notes.txt';