<?php 

require_once __DIR__.'/../package/vendor/autoload.php';

use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;

$config = new Configuration();
$config->cloud->cloudName = 'dcwwniekx';
$config->cloud->apiKey = '267239237871398';
$config->cloud->apiSecret = 'esWm3fkZcYxclKovkZGDs5xz-aY';
$config->url->secure = true;

$cloudinary = new Cloudinary($config);