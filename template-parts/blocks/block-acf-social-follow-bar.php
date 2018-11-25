<?php
  // ACF Setup
  $fb = get_field('facebook_settings');
  $insta = get_field('instagram_settings');
  $tw = get_field('twitter_settings');

  /**
   *  Facebook API Settings
   **/
  $fb_response = wp_remote_get(
    add_query_arg( array(
      'access_token' => $fb['fb_access_token'],
      'limit'        => 1
    ), 'https://graph.facebook.com/v3.2/'. $fb['fb_id'] .'/feed' )
  );

  /**
   *  Twitter API Settings
   *  @link https://rudrastyh.com/wordpress/get-tweets.html
   **/

  $args = array(
  	'headers' => array(
  		'Authorization' => 'Bearer ' . $tw['tw_bearer_token']
  	 )
  );

  $response = wp_remote_get( add_query_arg( array(
  	'count' => 1, // how much to display
  	'screen_name' => $tw['tw_account_name'], // the user screen name
  	'include_entities' => false
  ), 'https://api.twitter.com/1.1/statuses/user_timeline.json' ), $args );
  // more params in Twitter docs https://developer.twitter.com/en/docs/tweets/timelines/api-reference/get-statuses-user_timeline

  // response body contains the json-encoded array of tweet objects
  $tweets = json_decode( $response['body'] );
  $tw_recent_media = '';

  foreach( $tweets as $tweet ) :

  	$tw_recent_media .= '<article id="tweet-' . $tweet->id . '" class="tweet">
  		<div class="tweet_body">' . $tweet->text . '</div>
  	</article>';

  endforeach;
  echo $tw_recent_media;

  /**
   *  Instagram API Settings
   *  @link https://rudrastyh.com/instagram/wp_remote_get-examples.html
   **/

  $ig_token = $ig['insta_access_token'];

  // I recommend to use "self" if your application is not approved
  $ig_user_id = $ig['insta_name'];

  $remote_wp = wp_remote_get( "https://api.instagram.com/v1/users/" . $ig_user_id . "/media/recent/?access_token=" . $ig_token );

  $instagram_response = json_decode( $remote_wp['body'] );

  if( $remote_wp['response']['code'] == 200 ) {

  	foreach( $instagram_response->data as $m ) {

  		$ig_recent_media = '<a href="' . $m->link . '" id="media-' . $m->id . '" class="type-' . $m->type . '">
  			<img src="' . $m->images->standard_resolution->url . '" title="' . $m->caption->text . '" width="' . $m->images->standard_resolution->width . '" height="' . $m->images->standard_resolution->height . '" />
  		      </a>';
  		// more parameters here https://www.instagram.com/developer/endpoints/users/#get_users_media_recent

  	}

  } elseif ( $remote_wp['response']['code'] == 400 ) {
  	$ig_recent_media = '<b>' . $remote_wp['response']['message'] . ': </b>' . $instagram_response->meta->error_message;
  }
?>

<section class="nus-block-social-follow-bar">
  <header>
    <h2><?php the_field('section_title'); ?></h2>
  </header>
  <div class="wp-block--inner">
    <article class="nus-block-social-follow-bar--profile nus-block-social-follow-bar--facebook">
      <a href="https://facebook.com/<?php echo $fb['fb_id']; ?>" class="social-icon" target="_blank">
        <?php echo nus_get_icon_svg( 'facebook', 50 ); ?>
        <span class="social-name"><?php echo $fb['fb_display']; ?></span>
      </a>
      <div class="social-post">
        <?php echo $fb_recent_media; ?>
      </div>
    </article>

    <article class="nus-block-social-follow-bar--profile nus-block-social-follow-bar--twitter">
      <a href="https://twitter.com/<?php echo $tw['tw_account_name']; ?>" class="social-icon" target="_blank">
        <?php echo nus_get_icon_svg( 'instagram', 50 ); ?>
        <span class="social-name">@<?php $tw['tw_account_name']; ?></span>
      </a>
      <div class="social-post">
        <?php echo $tw_recent_media; ?>
      </div>
    </article>

    <article class="nus-block-social-follow-bar--profile nus-block-social-follow-bar--instagram">
      <a href="https://instagram.com/<?php echo $ig['insta_name']; ?>" class="social-icon" target="_blank">
        <?php echo nus_get_icon_svg( 'instagram', 50 ); ?>
        <span class="social-name"><?php $ig['insta_name']; ?></span>
      </a>
      <div class="social-post">
        <?php echo $ig_recent_media; ?>
      </div>
    </article>
  </div>
</section>
