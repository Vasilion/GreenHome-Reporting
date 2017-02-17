<script>
<?php
/*
Template Name: Dashboard Template
*/
$formUrl = "../create-template";
$formUrlActual = "../Audit-Form";
$reportUrl = "../Audit-Report/";


$user_info = get_userdata(get_current_user_id());
$first_name = $user_info->first_name;

$latest_audits;
$args;

/*Administators get all posts, Other users see their own */
if ( current_user_can('administrator') ) {
    $args = array(
	  'numberposts' => 100,
	  'post_type'   => 'audit_form',
	  'post_status' => 'publish'
	);
	$latest_audits = get_posts( $args );
} else {
	$args = array(
	  'numberposts' => 100,
	  'post_type'   => 'audit_form',
	  'author' => $current_user->ID,
	  'post_status' => 'publish'
	);
	$latest_audits = get_posts( $args );
}

?>
</script>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Targets movile devices to set width to screen size -->
  <title>GreenHome Audit Dashboard</title>
  <!-- linking to styles -->
  <link rel="stylesheet" type="text/css" href="../wp-content/themes/greenhome/styles/tvt-naved-bootstrap.min.css">
  <link rel="stylesheet" href="../wp-content/themes/greenhome/styles/jquery-ui.min.css">
  <link rel="stylesheet" href="../wp-content/themes/greenhome/styles/jquery-ui.structure.min.css">
  <link rel="stylesheet" type="text/css" href="../wp-content/themes/greenhome/styles/tvt-styles.css"

  <!--JQuery -->
  <script src="https://code.jquery.com/jquery-3.1.1.min.js"
          integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
  <script src="../wp-content/themes/greenhome/scripts/javascript/jquery-ui.min.js"></script>
  <script type="text/javascript">
		function updatePost(postId){
			if(confirm("Are you sure you want to remove this post?")){
				$.ajax({
					type: "POST",
					url: "../wp-content/themes/greenhome/scripts/php/unpublish_post.php",
					data: "postId="+postId
				}).done(function () {
						location.reload();
				});
			}
		}
  </script>

</head>
<body bgcolor="#CCCCCC">
<?php if(is_user_logged_in()):?>
<div class="tvt">
	<h2 class="tvt-dashboard-title">GreenHome Institute Audits</h2>
	<div class="tvt-dashboard-welcome">Welcome <?php echo $first_name; ?> <span class="tvt-dashboard-role">(<?php $username = $user_info->user_login;
		  $last_name = $user_info->last_name;
		  $userid = $user_info->ID;
		/*echo "$first_name $last_name logs into her WordPress site with the user name of $username.";
		  echo "this is the userid $userid";*/
		  if ( current_user_can('administrator') ) {
			echo "Administator";
		} else {
			echo "Auditor";
		}
	?>)</span></div>
	<a href="<?php echo $formUrl ?>" class="btn btn-success tvt-create-btn">Create New Submission</a>
	<div class="audit_submissions_container">
		<?php 
		if(count($latest_audits) == 0) { ?>
		<label class="tvt-label">No audit submissions found</label>
		<?php } else { ?>
		<!-- echo var_dump($latest_audits); -->
		<table class="table table-striped tvt-table">
			<thead>
			  <tr>
				<th>ID</th> <!-- <span class="glyphicons-edit"></span> -->
				<th>Posted By</th>
				<th>Date</th>
				<th>Homeowner</th>
				<th>Address</th>
				<th>Actions</th>
			  </tr>
			</thead>
			<tbody>
		<?php 
			foreach($latest_audits as $myPost) { 
			$author_obj = get_user_by('id', $myPost->post_author); ?>
			<tr>
				<td class="tvt-table-element"><?php echo $myPost->ID ?></td>
				<td class="tvt-table-element"><?php echo $author_obj->display_name ?></td>
				<td class="tvt-table-element"><?php echo $myPost->post_date ?></td>
				<td class="tvt-table-element"><?php echo get_post_meta($myPost->ID, 'homeownlname', true); ?></td>
				<td class="tvt-table-element"><?php echo get_post_meta($myPost->ID, 'homeaddress', true); ?> </td>
				<td class="tvt-table-element">
					<a href="<?php echo $formUrlActual ?>?form_id=<?php echo $myPost->ID ?>"><span class="glyphicon glyphicon-edit" title="Edit Form" style="padding-right:2px; font-size:16px"></span></a>
					<a href="<?php echo $reportUrl; ?>?form_id=<?php echo $myPost->ID; ?>"><span class="glyphicon glyphicon-list-alt" title="View Report" style="padding-right:2px; font-size:16px"></span></a>
					<a href="#" onclick="updatePost(<?php echo $myPost->ID; ?>)"><span class="glyphicon glyphicon-trash" title="Delete Form" style="font-size:16px;"></span></a>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	  </table>
		<?php } ?>
	</div>
</div>
<?php else:
wp_die('Sorry, you must first <a href="/wp-login.php">log in</a> to view this page. You can <a href="/wp-login.php?action=register">register free here</a>.');
endif; ?>
</body>
</html>