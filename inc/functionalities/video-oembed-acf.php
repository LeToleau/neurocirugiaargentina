<?php
function videoSupport($args)
{
    $args += ['field' => 'video', 'post_id' => null, 'placeholder_url' => null, 'button_content' => 'Play >'];
    if (get_field($args['field'], $args['post_id'])) {
        $videoUrl = get_field($args['field'], $args['post_id'], false, false);
    } else {
        $videoUrl = get_sub_field($args['field'], $args['post_id'], false, false);
    }

    $attr = videoAttributes($videoUrl);
    $thumbnail = $args['placeholder_url'] ? $args['placeholder_url'] : videoThumbnailUrl($attr['type'], $attr['id']);

    echo videoHtmlGenerator($attr['type'], $attr['id'], $thumbnail, $args['button_content']);
}

function videoAttributes($url)
{

    // Parse the url 
    $parse = parse_url($url);

    // Set blank variables
    $video_type = '';
    $video_id = '';

    // Url is http://youtu.be/xxxx
    if ($parse['host'] == 'youtu.be') {

        $video_type = 'youtube';

        $video_id = ltrim($parse['path'], '/');
    }

    // Url is http://www.youtube.com/watch?v=xxxx 
    // or http://www.youtube.com/watch?feature=player_embedded&v=xxx
    // or http://www.youtube.com/embed/xxxx
    if (($parse['host'] == 'youtube.com') || ($parse['host'] == 'www.youtube.com')) {

        $video_type = 'youtube';

        parse_str($parse['query'], $output);

        extract($output);

        $video_id = $v;

        if (!empty($feature))
            $video_id = end(explode('v=', $parse['query']));

        if (strpos($parse['path'], 'embed') == 1)
            $video_id = end(explode('/', $parse['path']));
    }

    // Url is http://www.vimeo.com
    if (($parse['host'] == 'vimeo.com') || ($parse['host'] == 'www.vimeo.com')) {

        $video_type = 'vimeo';

        $video_id = ltrim($parse['path'], '/');
    }
    $host_names = explode(".", $parse['host']);
    $rebuild = (!empty($host_names[1]) ? $host_names[1] : '') . '.' . (!empty($host_names[2]) ? $host_names[2] : '');
    // Url is an oembed url wistia.com
    if (($rebuild == 'wistia.com') || ($rebuild == 'wi.st.com')) {

        $video_type = 'wistia';

        if (strpos($parse['path'], 'medias') == 1)
            $video_id = end(explode('/', $parse['path']));
    }

    // If recognised type return video array
    if (!empty($video_type)) {

        $video_array = array(
            'type' => $video_type,
            'id' => $video_id
        );

        return $video_array;
    } else {

        return false;
    }
}

function videoThumbnailUrl($service, $id)
{
    switch ($service) {
        case 'youtube':
            if (file_get_contents("https://img.youtube.com/vi/{$id}/maxresdefault.jpg")) {
                $path = "https://img.youtube.com/vi/{$id}/maxresdefault.jpg";
            } else {
                $path = "https://img.youtube.com/vi/{$id}/0.jpg";
            }
            $thumbnail = $path;
            break;
        case 'vimeo':
            $data = json_decode(wp_remote_retrieve_body(wp_remote_get("https://vimeo.com/api/v2/video/{$id}.json")));
            $thumbnail = $data[0]->thumbnail_large;
            break;
    }

    return $thumbnail;
}

function videoHtmlGenerator($service, $id, $thumbnail, $btnContent)
{
    $idDom = $service != 'youtube' ? 'id="' . generateRandomString() . '"' : '';

    //Youtube case
    if($service == 'youtube'){
        $youtubeDomId = generateRandomString();
        $youtubeIdAttr = "youtube-dom='{$youtubeDomId}'";
        $youtubeIframe = "<div id='{$youtubeDomId}'></div>";
    }

    $template = "<div class='support-video js-support-video' service='{$service}' video-id='{$id}' {$idDom} {$youtubeIdAttr}>
        <img class='support-video__placeholder' src='{$thumbnail}' alt='Video Placeholder'>
        <button class='support-video__play js-support-video-play'>{$btnContent}</button>
        {$youtubeIframe}
    </div>";

    return $template;
}

function generateRandomString($length = 10)
{
    return substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
}
