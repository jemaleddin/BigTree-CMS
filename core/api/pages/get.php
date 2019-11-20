<?php
	namespace BigTree;
	
	/*
	 	Function: pages/get
			Returns a page from the bigtree_pages table.
		
		Method: GET
	 
		Parameters:
	 		id - The ID for the requested page
	 	
		Returns:
			An array of page data
	*/
	
	API::requireMethod("GET");
	API::requireParameters(["id" => "int"]);
	
	$id = intval($_GET["id"]);
	
	if (!Page::exists($id)) {
		API::triggerError("The requested page was not found.", "page:missing", "missing");
	}
	
	$page = new Page($id);
	
	if (empty($page->UserAccessLevel)) {
		API::triggerError("You are not allowed to access the requested page.", "page:notallowed", "permissions");
	} else {
		API::sendResponse($page->Array);
	}
	