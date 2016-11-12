<?php

/**
 * Presshub PHP SDK (Client) library.
 * MIT License.
 * (c) Presshub Software, Inc 2016
 */

namespace Presshub;

/**
 * Presshub Client main class.
 */
class Client {

  protected $version = '1.2';
  protected $api_endpoint_url;
  protected $template;
  protected $services;
  protected $curl;
  protected $request = [];

  /**
   * Initialize Presshub Client.
   */
  public function __construct( $api_key, $timeout = 400, $connecttimeout = 0, $api_endpoint_url = '' ) {
    $this->api_endpoint_url = !empty($api_endpoint_url) ? $api_endpoint_url : 'https://api.presshub.io/v1';
    $this->curl = new \Curl\Curl();
    $this->curl->setOpt(CURLOPT_CONNECTTIMEOUT, $connecttimeout);
    $this->curl->setOpt(CURLOPT_TIMEOUT, $timeout);
    $this->curl->setOpt(CURLOPT_RETURNTRANSFER, TRUE);
    $this->curl->setOpt(CURLOPT_USERAGENT, "Presshub-PHP-SDK-" . $this->version);
    $this->curl->setHeader('Content-Type', 'application/json');
    $this->curl->setHeader('Authorization', 'Bearer ' . $api_key);
  }

  /**
   * Generated template to post.
   */
  public function setTemplate( \Presshub\Template $template ) {
    $this->template = $template;
    return $this;
  }

  /**
   * Destination service names. (array/string)
   */
  public function setServices( $services ) {
    $this->services = $services;
    return $this;
  }

  /**
   * Get templates.
   */
  public function getTemplates() {
    $this->request = [
      'method' => 'get',
      'path'   => '/templates',
    ];
    return $this;
  }

  /**
   * Get template info.
   */
  public function getTemplate( $template_id ) {
    $this->request = [
      'method' => 'get',
      'path'   => '/template/' . $template_id,
    ];
    return $this;
  }

  /**
   * Get services.
   */
  public function getServices() {
    $this->request = [
      'method' => 'get',
      'path'   => '/services',
    ];
    return $this;
  }

  /**
   * Get service info.
   */
  public function getService( $name ) {
    $this->request = [
      'method' => 'get',
      'path'   => '/service/' . $name,
    ];
    return $this;
  }

  /**
   * Get Apple News sections.
   */
  public function getAppleNewsSections() {
    $this->request = [
      'method' => 'get',
      'path'   => '/applenews/sections',
    ];
    return $this;
  }

  /**
   * Get articles.
   */
  public function getArticles() {
    $this->request = [
      'method' => 'get',
      'path'   => '/articles',
    ];
    return $this;
  }

  /**
   * Get article info.
   */
  public function getArticle( $post_id ) {
    $this->request = [
      'method' => 'get',
      'path'   => '/article/' . $post_id,
    ];
    return $this;
  }

  /**
   * Publish article.
   */
  public function publish() {
    $this->request = [
      'method' => 'post',
      'path'   => '/publish',
      'params' => $this->buildRequestBody(),
    ];
    return $this;
  }

  /**
   * Preview article.
   */
  public function preview() {
    $this->request = [
      'method' => 'post',
      'path'   => '/preview',
      'params' => $this->buildRequestBody(),
    ];
    return $this;
  }

  /**
   * Update article.
   */
  public function update( $post_id ) {
    $this->request = [
      'method' => 'put',
      'path'   => '/article/' . $post_id,
      'params' => $this->buildRequestBody()
    ];
    return $this;
  }

  /**
   * Delete article.
   */
  public function delete( $post_id ) {
    $this->request = [
      'method' => 'delete',
      'path'   => '/article/' . $post_id,
      'params' => $this->buildRequestBody(TRUE),
    ];
    return $this;
  }

  /**
   * Make request.
   */
  public function execute() {
    $request = $this->request;
    $params = !empty($request['params']) ? $request['params'] : '';
    if ($request['method'] == 'delete') {
      $this->curl->{$request['method']}($this->api_endpoint_url . $request['path'], [], $params);
    }
    else {
      $this->curl->{$request['method']}($this->api_endpoint_url . $request['path'], $params);
    }
    return $this->curl->response;
  }

  /**
   * Build request body to submit `template` and `services` parameters.
   */
  protected function buildRequestBody($delete = FALSE) {
    $body = [];
    // Delete request doesn't require `template` array.
    if (!$delete) {
      $body['template'] = $this->template;
    }
    if (!empty($this->services)) {
      $body['services'] = is_array($this->services) ? $this->services : [$this->services];
    }
    return $body;
  }

}
