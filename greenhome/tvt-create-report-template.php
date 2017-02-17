<?php    
		/*
		Template Name: Create Audit Submission
		*/
		$userInfo = wp_get_current_user();

		$newPostParams = array(
			'post_author' => $userInfo -> ID,
			'post_type' => 'audit_form',
			'post_title' => 'SomeTitleHere',
			'post_status' => 'publish'
			);
		$formId = wp_insert_post($newPostParams);
		
		header('Location: ../audit-form?form_id=' . $formId);    
?>
