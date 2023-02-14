<?php

//get artist photo
function getArtistPhoto($artist, $size)
{
	$artist = urlencode($artist);
	$xml    = "https://ws.audioscrobbler.com/2.0/?method=artist.getinfo&artist={$artist}&api_key=50de305c4b68b677c3dc6976ecdf1c30";
	$xml    = @file_get_contents($xml);

	if (!$xml) {
		return;  // Artist lookup failed.
	}

	$xml = new SimpleXMLElement($xml);
	$xml = $xml->artist;
	$xml = $xml->image[$size];

	$return = convert($xml);

	return $return;
}

//get artist albums
function getArtistAlbums($artist, $size)
{
	$artist = urlencode($artist);
	$xml    = "http://ws.audioscrobbler.com/2.0/?method=artist.gettopalbums&artist={$artist}&api_key=50de305c4b68b677c3dc6976ecdf1c30";
	$xml    = @file_get_contents($xml);

	if (!$xml) {
		return;  // Artist lookup failed.
	}

	$xml = new SimpleXMLElement($xml);
	$xml = $xml->topalbums;
	foreach ($xml->album as $album) {
		$album_img =  $album->image[$size];
		$album_image = convert($album_img);
		$album_name =  $album->name;

		//echo instead of returning
		echo $album_name . "<br>" . $album_image . "<br><br>";
	}
}

//get album photo
function getAlbum($artist, $album, $size)
{
	$artist = urlencode($artist);
	$album = urlencode($album);
	$xml    = "http://ws.audioscrobbler.com/2.0/?method=album.getinfo&artist={$artist}&album={$album}&api_key=50de305c4b68b677c3dc6976ecdf1c30";
	$xml    = @file_get_contents($xml);

	// Artist lookup failed, return default image
	if (!$xml) {
		return '<img src="http://www.last.fm/static/images/album/default_medium.png" />';
	}

	$xml = new SimpleXMLElement($xml);
	$xml = $xml->album;
	$xml = $xml->image[$size];

	$return = convert($xml);

	return $return;
}

//convert png to jpg
function convert($file)
{
	$parts = pathinfo($file);
	//dont convert if its a jpg
	if ($parts['extension'] == "jpg") {
		return '<img src="' . $file . '" />';
	} else {

		$image = imagecreatefrompng($file);
		$bg = imagecreatetruecolor(imagesx($image), imagesy($image));
		imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
		imagealphablending($bg, TRUE);
		imagecopy($bg, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));

		ob_start();
		imagejpeg($bg, NULL, 80);
		$image_data = ob_get_contents();
		ob_end_clean();
		$imageData = base64_encode($image_data);

		imagedestroy($image);
		ImageDestroy($bg);

		return '<img src="data:image/jpg;base64,' . $imageData . '" />';
	}
}
