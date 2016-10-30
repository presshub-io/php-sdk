<?php

/**
 * @file
 * Presshub component base class.
 */

namespace Presshub\Template;

/**
 * ComponentBase class.
 */
abstract class ComponentBase extends Base {

  /**
   * Set component options.
   */
  public function setProps( $options = array() ) {
    $this->options = $options;
    return $this;
  }

}
