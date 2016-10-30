<?php

/**
 * @file
 * Presshub component class.
 */

namespace Presshub\Template;

use Presshub\Template\ComponentBase;

/**
 * Component class.
 */
class Component extends ComponentBase {

  /**
   * @var Component destination value.
   */
  protected $map;

  /**
   * @var Component source value.
   */
  protected $value;

  /**
   * @var Component options.
   */
  protected $options = array();

  /**
   * Create component object.
   */
  public static function create() {
    return new self();
  }

  /**
   * Set template field name.
   */
  public function setMap( $value ) {
    $this->map = $value;
    return $this;
  }

  /**
   * Get template field name.
   */
  public function getMap( $value ) {
    return $this->map;
  }

  /**
   * Set template field value.
   */
  public function setValue( $value ) {
    $this->value = $value;
    return $this;
  }

  /**
   * Get template field value.
   */
  public function getValue() {
    return $this->value;
  }

}
