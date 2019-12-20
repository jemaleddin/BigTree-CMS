<?php
	namespace BigTree;
	
	/**
	 * @global array $bigtree
	 */

	if (end(Router::$Path) != "password" && Router::$Path[2] != "profile") {
		Auth::user()->requireLevel(1);
	}

	$policy = array_filter((array) Admin::$SecurityPolicy["password"]);
	$policy_text = "";
	
	if (!empty($policy["length"]) || !empty($policy["mixedcase"]) || !empty($policy["numbers"]) || !empty($policy["nonalphanumeric"]))  {
		$policy_text = "<p>".Text::translate("Requirements")."</p><ul>";
		
		if ($policy["length"]) {
			$policy_text .= "<li>".Text::translate("Minimum length &mdash; :length: characters", false, [":length:" => $policy["length"]])."</li>";
		}
		
		if ($policy["mixedcase"]) {
			$policy_text .= "<li>".Text::translate("Both upper and lowercase letters")."</li>";
		}
		
		if ($policy["numbers"]) {
			$policy_text .= "<li>".Text::translate("At least one number")."</li>";
		}
		
		if ($policy["nonalphanumeric"]) {
			$policy_text .= "<li>".Text::translate("At least one special character (i.e. $%*)")."</li>";
		}
		
		$policy_text .= "</ul>";
	}
	