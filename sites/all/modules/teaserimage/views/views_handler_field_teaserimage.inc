<?php

/**
 * Teaser Image: handler for Views.
 */
class views_handler_field_teaserimage extends views_handler_field {

  /**
   * Constructor to provide additional fields to add.
   *
   */
  function construct() {
    parent::construct();

    // Node nid for teaserimage rendering.
    $this->additional_fields['teaserimage_node_nid'] = array(
      'table' => 'node',
      'field' => 'nid',
    );
    // Node title for teaserimage rendering.
    $this->additional_fields['teaserimage_node_title'] = array(
      'table' => 'node',
      'field' => 'title',
    );
    // Node type to verify it is an teaserimage node.
    $this->additional_fields['teaserimage_node_type'] = array(
      'table' => 'node',
      'field' => 'type',
    );
  }

  function option_definition() {
    $options = parent::option_definition();
    $options['link_to_node'] = $options['original_picture'] = $options['default_picture'] = array('default' => FALSE);
    $options['preset'] = array('default' => '');
    return $options;
  }

  function options_form(&$form, &$form_state) {
    parent::options_form($form, $form_state);
    $form['link_to_node'] = array(
      '#title' => t('Link the thumbnail to its node'),
      '#type' => 'checkbox',
      '#default_value' => !empty($this->options['link_to_node']),
    );
    $form['original_picture'] = array(
      '#title' => t('Display original'),
      '#type' => 'checkbox',
      '#default_value' => !empty($this->options['original_picture']),
      '#description' => t('If checked, the view will display the original picture used to build the thumbnail without applying the image style preset.'),
    );
    $form['preset'] = array(
      '#type' => 'select',
      '#title' => t('Thumbnail preset'),
      '#default_value' => $this->options['preset'],
      '#description' => t('This preset will override any other teaserimage setting.'),
      '#options' => image_style_options(TRUE),
      '#states' => array(
        'visible' => array(
          ':input[name="options[original_picture]"]' => array('checked' => FALSE),
        ),
      ),
    );
    $form['default_picture'] = array(
      '#title' => t('Use default picture'),
      '#type' => 'checkbox',
      '#default_value' => $this->options['default_picture'],
      '#description' => t('Use default image settings for the type of node.'),
    );
  }

  function render($values) {
    $type = $values->{$this->aliases['teaserimage_node_type']};

    if (variable_get('teaserimage_' . $type, FALSE) == FALSE) {
      return;
    }

    $path = $values->{$this->field_alias};

    if (is_null($path) && $this->options['default_picture'] && $file = file_load(variable_get('teaserimage_default_img_' . $type, 0))) {
      $path = $file->uri;
    }

    if ($thumb = $path) {
      $node = new stdClass();
      $node->teaserimage = $thumb;
      $node->type = $type;
      $node->title = $values->{$this->aliases['teaserimage_node_title']};
      $preset = $this->options['preset'];

      if (empty($this->options['original_picture'])) {
        if (empty($preset)) {
          $thumb = theme('teaserimage_thumbnail', array('node' => $node));
        }
        else {
          $thumb_options = array(
            'style_name' => $preset,
            'path' => $thumb,
            'alt' => $node->title,
            'title' => $node->title,
            'attributes' => array('class' => 'teaserimage'),
          );
          $thumb = theme('image_style', $thumb_options);
        }
      }
      else {
        $thumb = theme('image', array('path' => $thumb));
      }

      if ($this->options['link_to_node']) {
        $thumb = l($thumb, 'node/' . $values->nid, array('html' => TRUE, 'attributes' => array('class' => 'teaserimage-link')));
      }
      return $thumb;
    }
  }
}

