<?php
/// Change CLIENT_ID_FROM_TWITCH_DEV_API to your Twitch Developer Client ID in THREE spots

function twitch_get_stream($id,$meta)
{
    $api_stream = curl_init('https://api.twitch.tv/kraken/streams/'. $id);
    curl_setopt($api_stream, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($api_stream, CURLOPT_HTTPHEADER, array('Accept: application/vnd.twitchtv.v5+json',
        'Client-ID: CLIENT_ID_FROM_TWITCH_DEV_API'
    ));
    $r = curl_exec($api_stream);
    curl_close($api_stream);
    //return $r;
    $someJSON = "[" . $r ."]" ;
    // Convert JSON string to Array
    $someArray = json_decode($someJSON, true);
    if($meta == "stream_status")
    {
        return $someArray[0]["stream"]["stream_type"];
    }
     if($meta == "stream_game")
    {
        return $someArray[0]["stream"]["game"];
    }   
     if($meta == "stream_url")
    {
        return $someArray[0]["channel"]["url"];
    }   
}

function twitch_get_user($id,$meta)
{
    $api_user = curl_init('https://api.twitch.tv/kraken/users/'. $id);
    curl_setopt($api_user, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($api_user, CURLOPT_HTTPHEADER, array('Accept: application/vnd.twitchtv.v5+json',
        'Client-ID: CLIENT_ID_FROM_TWITCH_DEV_API'
    ));
    $r = curl_exec($api_user);
    curl_close($api_user);
    //return $r;
    $someJSON = "[" . $r ."]" ;
    // Convert JSON string to Array
    $someArray = json_decode($someJSON, true);
    if($meta == "logo")
    {
        return $someArray[0]["logo"];
    }
        if($meta == "dname")
    {
        return $someArray[0]["display_name"];
    }
        if($meta == "name")
    {
        return $someArray[0]["name"];
    }
}
function twitch_get_followers($id)
{
    $api_followers = curl_init('https://api.twitch.tv/kraken/users/' . $id . '/follows/channels');
    curl_setopt($api_followers, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($api_followers, CURLOPT_HTTPHEADER, array('Accept: application/vnd.twitchtv.v5+json',
        'Client-ID: CLIENT_ID_FROM_TWITCH_DEV_API'
    ));
    $r = curl_exec($api_followers);
    curl_close($api_followers);
    return $r;
}

function twitch_get_video($type,$code,$domain,$muted,$width,$height,$frame,$scroll,$fullscreen)
{
  echo "
  <iframe
    src='https://player.twitch.tv/?$type=$code&parent=$domain&muted=$muted'
    height='$width'
    width='$height'
    frameborder='$frame'
    scrolling='$scroll'
    allowfullscreen='$fullscreen'>
</iframe>
  "; 
}


///USAGE
//twitch_get_stream(TWITCH_ID_FOR_USER,'stream_status');
//function twitch_get_user(TWITCH_ID_FOR_USER,'name');
//function twitch_get_followers(TWITCH_ID_FOR_USER);
//twitch_get_video("channel/video/collection","channelID/VideoID/CollectionID","yourdomain.com OR subdomain.yourdomain.com","true","450","675","0","no","true");
?>