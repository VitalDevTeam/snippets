<?php
/**
 * Retrieves YouTube video meta
 *
 * Function takes a regular YouTube URL and returns an associative array
 * containing the video's ID, duration, and thumbnail image URLs
 *
 * @param  string $url Video URL
 * @return array       Video meta
 */
function get_youtube_video($url) {

    // Valid Google API key (OAuth is not required)
    $google_api_key = 'XXXXXX_XXXXX_XXXXXX-XXXXXX';

    // Extract ID from URL
    $url_pattern =
        '%^             # Match any youtube URL
        (?:https?://)?  # Optional scheme. Either http or https
        (?:www\.)?      # Optional www subdomain
        (?:             # Group host alternatives
          youtu\.be/    # Either youtu.be,
        | youtube\.com  # or youtube.com
          (?:           # Group path alternatives
            /embed/     # Either /embed/
          | /v/         # or /v/
          | /watch\?v=  # or /watch\?v=
          )             # End path alternatives.
        )               # End host alternatives.
        ([\w-]{10,12})  # Allow 10-12 for 11 char youtube id.
        $%x';

    $url_match_result = preg_match($url_pattern, $url, $matches);

    if (false === $url_match_result) {
        $errors['url_match'] = "Valid YouTube video ID not found in given URL.";
    } else {
        $id = $matches[1];
    }

    // Get API data
    $api_base = 'https://www.googleapis.com/youtube/v3/videos';
    $thumbnail_base = 'https://img.youtube.com/vi/';

    $api_params = array(
        'id'   => $id,
        'part' => 'contentDetails',
        'key'  => $google_api_key,
    );

    $api_url = $api_base . '?' . http_build_query($api_params);
    $response = wp_remote_get($api_url);

    if (is_wp_error($response)) {

        $error = "YouTube API did not respond.";

    } elseif (200 !== $response['response']['code']) {

        $data = json_decode($response['body'], true);
        $api_error_msg = $data['error']['message'];
        $api_error_code = $data['error']['code'];

        $error = "YouTube API Error $api_error_code - $api_error_msg";

    } else {

        $data = json_decode($response['body'], true);
        $contentDetails = $data['items'][0]['contentDetails'];

        // Video ID
        $video_info['id'] = $id;

        // Convert YouTube's duration value to seconds
        $interval = new DateInterval($contentDetails['duration']);
        $video_info['duration'] = $interval->h * 3600 + $interval->i * 60 + $interval->s;

        // Video thumbnail image URLs
        $video_info['thumbnail']['default'] = $thumbnail_base . $id . '/default.jpg';
        $video_info['thumbnail']['mqDefault'] = $thumbnail_base . $id . '/mqdefault.jpg';
        $video_info['thumbnail']['hqDefault'] = $thumbnail_base . $id . '/hqdefault.jpg';

        $video_info['thumbnail']['sdDefault'] = $thumbnail_base . $id . '/sddefault.jpg';
        $video_info['thumbnail']['maxresDefault'] = $thumbnail_base . $id . '/maxresdefault.jpg';

    }

    if (!empty($error)) {

        return $error;

    } else {

        return $video_info;

    }

}

?>

<!-- Example -->

<?php $video = get_youtube_video('https://www.youtube.com/watch?v=uppO4op2sNU'); ?>
<p>ID: <?php echo $video['id']; ?></p>
<p>Duration: <?php echo $video['duration']; ?> seconds</p>
<p><img src="<?php echo $video['thumbnail']['default']; ?>" alt=""></p>
<p><img src="<?php echo $video['thumbnail']['mqDefault']; ?>" alt=""></p>
<p><img src="<?php echo $video['thumbnail']['hqDefault']; ?>" alt=""></p>
<p><img src="<?php echo $video['thumbnail']['sdDefault']; ?>" alt=""></p>
<p><img src="<?php echo $video['thumbnail']['maxresDefault']; ?>" alt=""></p>