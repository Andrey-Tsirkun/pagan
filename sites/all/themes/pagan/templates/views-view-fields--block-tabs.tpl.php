<?php

/**
 * @file
 * Default simple view template to all the fields as a row.
 *
 * - $view: The view in use.
 * - $fields: an array of $field objects. Each one contains:
 *   - $field->content: The output of the field.
 *   - $field->raw: The raw data for the field, if it exists. This is NOT output safe.
 *   - $field->class: The safe class id to use.
 *   - $field->handler: The Views field handler object controlling this field. Do not use
 *     var_export to dump this object, as it can't handle the recursion.
 *   - $field->inline: Whether or not the field should be inline.
 *   - $field->inline_html: either div or span based on the above flag.
 *   - $field->wrapper_prefix: A complete wrapper containing the inline_html to use.
 *   - $field->wrapper_suffix: The closing tag for the wrapper.
 *   - $field->separator: an optional separator that may appear before a field.
 *   - $field->label: The wrap label text to use.
 *   - $field->label_html: The full HTML of the label to use including
 *     configured element type.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 */
?>
<?php
     if ($fields['nid']) { $nid = $fields['nid']->content; }
     global $base_url;
     $node_url = $base_url . "/node/" . $nid;
?>

<a href="<?php print $node_url; ?>">
    <?php if (isset($fields['filepath'])) {print '<div class="views-teaserimage">' . $fields['filepath'] -> content . '</div>'; } ?>
    <?php if (isset($fields['title'])) {print '<div class="views-title">' . $fields['title'] -> content . '</div>'; } ?>
    <?php if (isset($fields['comment_count'])) {print '<div class="views-commentcount">' . $fields['comment_count'] -> content . '</div>'; } ?>
    <?php if (isset($fields['totalcount'])) {print '<div class="views-viewcount">' . $fields['totalcount'] -> content . '</div>'; } ?>
</a>
