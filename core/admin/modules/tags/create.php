<?php
	namespace BigTree;
	
	$tag_string = trim($_POST["tag"]);

	if (empty($tag_string)) {
		Utils::growl("Tags", "Tag Name Was Empty");
		Router::redirect(ADMIN_ROOT."tags/add/");
	}

	$tag = Tag::create($tag_string);
	$merge_tags = $_POST["merge_tags"];

	if (is_array($merge_tags)) {
		foreach ($merge_tags as $merge_id) {
			$tag->merge($merge_id);
		}
	}

	Utils::growl("Tags", "Created Tag");
	Router::redirect(ADMIN_ROOT."tags/");
	