<?php

/**
 * @file
 * Presshub AMP Webhook URL example.
 * You have to login to presshub.io and enable GoogleAmp integration.
 */

// Signature. To ensure only your requests are valid and can be accepted by this endpoint.
$signature = "sig_5842289f00001";

// Method. Eg. `publish`, `update` or `delete`.
$method = $_POST['method'];

// Original content ID.
$content_id = $_POST['content_id'];

// AMP Generated HTML
$amp_html = $_POST['amp_html'];

if ($_POST['signature'] == $signature && !empty($content_id)) {
  switch ($method) {
    case 'publish' :
      // Insert to your local database or create a file for AMP version of the article.
      // Use $content_id as a primary key.
      // You would later load AMP vertsion of the article by passing its original ID.
      // $amp_html - AMP formatted HTML.
      break;
    case 'update' :
      // Update local copy of the AMP article.
      break;
    case 'delete' :
      // Delete local copy of the AMP article.
      break;
  }
}

var_dump($_POST);
