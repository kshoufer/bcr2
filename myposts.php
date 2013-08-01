<?php 
/*
if ($author = get_post_meta($post->ID, 'author', true)) :
		query_posts(\"author={$author}&post_status=publish&post_type=post&showposts=3\");
		if ( have_posts() ) : ?>
			<ul id=\"authorposts\">
			<?php while ( have_posts() ) : the_post(); ?>
				<li><a href=\"<?php the_permalink(); ?>\" title=\"<?php the_title_attribute(); ?>\"><?php the_title(); ?></a></li>
			<?php endwhile; ?>
			</ul>
		<?php endif; ?>
	<?php else: ?>
		<p>This person doesn't have a blog yet.</p>
	<?php endif; ?>
<?php wp_reset_query(); 
 */ 

require_once( dirname(__FILE__) . '/wp-load.php' );

get_header();

get_currentuserinfo();

$user_id = $current_user->$user_ID;
$category = '6';

$args = array_merge( $wp_query->query_vars, array( 'cat' => $category, 'author' => $user_ID ) );

// The Query
query_posts($args);

?>

<h2>My Posts</h2>
<hr />
<br />
<br />



<?php

// The Loop
while ( have_posts() ) : the_post();
    echo '<h3><li>View Post: >>';
    echo '<a href="';
    echo the_permalink();
    echo '" target="_blank" >';
    echo the_title();
    echo '</a>';
    echo '</li></h3>';
    echo '<br />';
endwhile;

// Reset Query
wp_reset_query();

?>


<?php
get_sidebar();

get_footer(); 

?>