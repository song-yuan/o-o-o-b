<?php
/**
 * Return sizes readable by humans
 */
function human_filesize($bytes, $decimals = 2)
{
  $size = ['B', 'kB', 'MB', 'GB', 'TB', 'PB'];
  $factor = floor((strlen($bytes) - 1) / 3);

  return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) .@$size[$factor];
}

function hashPwd($password) {
    return md5(md5($password).config('common.salt'));
}

/**
 * Is the mime type an image
 */
function is_image($mimeType)
{
    return starts_with($mimeType, 'image/');
}

function getImageDir($relativeDir) {
    $path = rtrim(config('imagedir.baseDir'), '/') . '/' .ltrim($path, '/');
    return url($path);
}