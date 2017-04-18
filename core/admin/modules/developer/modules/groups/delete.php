<?php
	namespace BigTree;
	
	/**
	 * @global array $bigtree
	 */
	
	CSRF::verify();
	
	$group = new ModuleGroup($_GET["id"]);
	$group->delete();
	
	Utils::growl("Developer","Deleted Module Group");
	Router::redirect(DEVELOPER_ROOT."modules/groups/");
	