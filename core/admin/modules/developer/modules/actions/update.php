<?php
	namespace BigTree;
	
	/**
	 * @global array $bigtree
	 */
	
	CSRF::verify();
	
	$action = new ModuleAction(Router::$Command, ["BigTree\Admin", "catch404"]);
	$action->update($_POST["name"], $_POST["route"], $_POST["in_nav"], $_POST["class"], $_POST["interface"], $_POST["level"], $_POST["position"]);
	
	Admin::growl("Developer", "Updated Action");
	Router::redirect(DEVELOPER_ROOT."modules/edit/".$action->Module."/");
	