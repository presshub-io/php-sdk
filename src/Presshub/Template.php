<?php

/**
 * @file
 * Presshub PHP SDK (Template) library.
 */

namespace Presshub;

use Presshub\Template\Base;
use Presshub\Template\Component\Header;
use Presshub\Template\Component\Footer;

/**
 * Presshub Template main class.
 */
class Template extends Base {

  /**
   * @var Presshub.io library version.
   */
  public $version = '1.2';

  /**
   * @var Article title.
   */
  protected $title;

  /**
   * @var Article subtitle.
   */
  protected $subtitle;

  /**
   * @var Article URL.
   */
  protected $canonicalURL;

  /**
   * @var Article keywords.
   */
  protected $keywords = array();

  /**
   * @var Indicates the viewing audience for the content. The types of audiences or ratings are KIDS, MATURE, and GENERAL. 
   */
  protected $maturityRating = NULL;

  /**
   * @var Article language.
   */
  protected $language = 'en';

  /**
   * @var Article thumbnail URL (image).
   */
  protected $thumbnail;

  /**
   * @var Template to use.
   */
  protected $template = 'basic';

  /**
   * @var Document components.
   */
  protected $components = array();

  /**
   * Factory method
   * @return PresshubIO object.
   */
  public static function create() {
    return new self();
  }

  /**
   * Template name to use. Defaults to `simple`.
   */
  public function setTemplate( $template_id = 'basic' ) {
    $this->template = $template_id;
    return $this;
  }

  /**
   * Article URL.
   */
  public function setCanonicalURL( $url ) {
    $this->canonicalURL = $url;
    return $this;
  }

  /**
   * Article language.
   */
  public function setLanguage( $lang = 'en' ) {
    $this->language = $lang;
    return $this;
  }

  /**
   * Article title.
   */
  public function setTitle( $value ) {
    $this->title = $value;
    return $this;
  }

  /**
   * Article subtitle.
   */
  public function setSubTitle( $value ) {
    $this->subtitle = $value;
    return $this;
  }

  /**
   * Article thumbnail.
   */
  public function setThumbnail( $url ) {
    $this->thumbnail = $url;
    return $this;
  }

  /**
   * Article keywords (Apple News only).
   */
  public function setKeywords( $keywords = array() ) {
    $this->keywords = $keywords;
    return $this;
  }

  /**
   * For now supported by Apple News only.
   */
  public function maturityRating( $val = NULL ) {
    $this->maturityRating = ( !empty( $val ) && in_array( $val, 'KIDS', 'MATURE', 'GENERAL' ) ) ? $val : NULL;
    return $this;
  }

}
