<?php

/**
 * @file
 * Base class for Presshub Template classes.
 */

namespace Presshub\Template;

/**
 * Base class for Presshub\Template classes.
 */
abstract class Base implements \JsonSerializable {

  /**
   * Add document component.
   */
  public function addComponent( $component ) {
    if ( !empty( $component ) ) {
      $this->components[] = $component;
    }
    return $this;
  }

  /**
   * Implements JsonSerializable::jsonSerialize().
   */
  public function jsonSerialize() {

    // Protected attributes are not outputted via parent::__toString().
    $out = get_object_vars( $this );

    // Return empty object, not array.
    if ( empty( $out ) ) {
      return new \stdClass();
    }

    return $out;
  }

  /**
   * Implements __toString().
   */
  public function __toString() {
    return json_encode( $this, JSON_UNESCAPED_SLASHES );
  }

  /**
   * Generates JSON representation.
   *
   * @return bool|string
   *   JSON string, or FALSE on error.
   */
  public function json() {
    $out = (string) $this;
    return $out == 'null' ? FALSE : $out;
  }

}
