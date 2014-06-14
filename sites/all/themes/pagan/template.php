<?php

/**
 * Override or insert variables into the maintenance page template.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 */
function pagan_preprocess_maintenance_page(&$vars) {
  // When a variable is manipulated or added in preprocess_html or
  // preprocess_page, that same work is probably needed for the maintenance page
  // as well, so we can just re-use those functions to do that work here.
  // pagan_preprocess_html($vars);
  // pagan_preprocess_page($vars);

  // This preprocessor will also be used if the db is inactive. To ensure your
  // theme is used, add the following line to your settings.php file:
  // $conf['maintenance_theme'] = 'pagan';
  // Also, check $vars['db_is_active'] before doing any db queries.
}

/**
 * Implements hook_modernizr_load_alter().
 *
 * @return
 *   An array to be output as yepnope testObjects.
 */
/* -- Delete this line if you want to use this function
function pagan_modernizr_load_alter(&$load) {

}

/**
 * Implements hook_preprocess_html()
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 */
/* -- Delete this line if you want to use this function
function pagan_preprocess_html(&$vars) {

}

/**
 * Override or insert variables into the page template.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 */

function pagan_preprocess_page(&$vars) {
  $theme_path = drupal_get_path('theme', 'pagan');
  drupal_add_js($theme_path.'/js/footer-js.js', array('type' => 'file', 'scope' => 'footer'));
}

/**
 * Override or insert variables into the region templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 */
/* -- Delete this line if you want to use this function
function pagan_preprocess_region(&$vars) {

}
// */

/**
 * Override or insert variables into the block templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 */
/* -- Delete this line if you want to use this function
function pagan_preprocess_block(&$vars) {

}
// */

/**
 * Override or insert variables into the entity template.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 */
/* -- Delete this line if you want to use this function
function pagan_preprocess_entity(&$vars) {

}
// */

/**
 * Override or insert variables into the node template.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 */
/* -- Delete this line if you want to use this function
function pagan_preprocess_node(&$vars) {
  $node = $vars['node'];
}
// */

/**
 * Override or insert variables into the field template.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("field" in this case.)
 */
/* -- Delete this line if you want to use this function
function pagan_preprocess_field(&$vars, $hook) {

}
// */

/**
 * Override or insert variables into the comment template.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 */

function pagan_preprocess_comment(&$vars) {
  $comment = $vars['comment'];
  $vars['author'] =  t('Aўтар: ') . $vars['author'];
  $vars['created'] = beldate('j F Y G:i', $vars['elements']['#comment']->created);
  //dsm($vars);
}


/**
 * Override or insert variables into the views template.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 */
/* -- Delete this line if you want to use this function
function pagan_preprocess_views_view(&$vars) {
  $view = $vars['view'];
}
// */


/**
 * Override or insert css on the site.
 *
 * @param $css
 *   An array of all CSS items being requested on the page.
 */
/* -- Delete this line if you want to use this function
function pagan_css_alter(&$css) {

}
// */

/**
 * Override or insert javascript on the site.
 *
 * @param $js
 *   An array of all JavaScript being presented on the page.
 */
/* -- Delete this line if you want to use this function
function pagan_js_alter(&$js) {

}
// */

function beldate($format, $timestamp = 0, $nominative_month = false){
  if(!$timestamp) $timestamp = time();
  elseif(!preg_match("/^[0-9]+$/", $timestamp)) $timestamp = strtotime($timestamp);
  $F = $nominative_month ? array(1=>"Студзень", "Люты", "Сакавік", "Красавік", "Травень", "Чэрвень", "Ліпень", "Жнівень", "Верасень", "Кастрычнік", "Лістапад", "Снежань") : array(1=>"Студня", "Лютага", "Сакавіка", "Красавіка", "Травня", "Чэрвеня", "Ліпеня", "Жніўня", "Верасня", "Кастрычніка", "Лістапада", "Снежня");
  $M = array(1=>"Сту", "Лют", "Сак", "Крас", "Тра", "Чэр", "Лип", "Жні", "Вер", "Кас", "Ліс", "Сне");
  $l = array("Нядзеля", "Панядзелак", "Аўторак", "Серада", "Чацьвер", "Пятніца", "Субота");
  $D = array("Няд", "Пан", "Аўт", "Сер", "Чац", "Пят", "Суб");

  $format = str_replace("F", $F[date("n", $timestamp)], $format);
  $format = str_replace("M", $M[date("n", $timestamp)], $format);
  $format = str_replace("l", $l[date("w", $timestamp)], $format);
  $format = str_replace("D", $D[date("w", $timestamp)], $format);
  return date($format, $timestamp);
}

function bel2translit($string){
    $converter = array(
        'а' => 'a',   'б' => 'b',   'в' => 'v',
        'г' => 'g',   'д' => 'd',   'е' => 'e',
        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
        'и' => 'i',   'й' => 'y',   'к' => 'k',
        'л' => 'l',   'м' => 'm',   'н' => 'n',
        'о' => 'o',   'п' => 'p',   'р' => 'r',
        'с' => 's',   'т' => 't',   'у' => 'u',
        'ў' => 'u',   'ф' => 'f',   'х' => 'h',
        'ц' => 'c',   'ч' => 'ch',  'ш' => 'sh',
        'ь' => "",    'ы' => 'y',   'ъ' => "'",
        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

        'А' => 'A',   'Б' => 'B',   'В' => 'V',
        'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
        'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
        'И' => 'I',   'Й' => 'Y',   'К' => 'K',
        'Л' => 'L',   'М' => 'M',   'Н' => 'N',
        'О' => 'O',   'П' => 'P',   'Р' => 'R',
        'С' => 'S',   'Т' => 'T',   'У' => 'U',
        'У' => 'U',   'Ф' => 'F',   'Х' => 'H',
        'Ц' => 'C',   'Ч' => 'Ch',  'Ш' => 'Sh',
        'Ь' => "'",   'Ы' => 'Y',   'Ъ' => "'",
        'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
    );
    return strtr($string, $converter);
}

function pagan_menu_link($variables) {
  $element = $variables['element'];
  $sub_menu = '';

  if ($element['#below']) {
    $sub_menu = drupal_render($element['#below']);
  }
  static $item_id = 0;
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  $id = $element['#original_link']['mlid'];
  return '<li id="menu-id-' . $id . '"' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

function pagan_preprocess_node(&$vars) {
  $vars['submitted'] = t('Апублікаваў'). ': ' . t($vars['name']) . ' ' . t('@date', array('@date' => beldate('j F Y', $vars['created'])));
  unset($vars['content']['links']['statistics']['#links']['statistics_counter']['title']);

  $node = $vars['node'];

  if ($vars['type'] == 'book') {
    foreach ($node->field_book_file[LANGUAGE_NONE] as $delta) {
      $vars['content']['field_book_file']['#title'] = $vars['content']['field_book_file']['#title'] . "(" . $vars['content']['field_book_file']['filesize'] . ")";
    }

    //$vars['content']['field_book_file']['#title'] = $node->field_book_file[LANGUAGE_NONE][0]['filesize'];
  }
}

function pagan_form_search_block_form_alter(&$form, &$form_state, $form_id) {
	$form['search_block_form']['#attributes']['placeholder'] = t('Пошук');
}

function pagan_form_webform_client_form_10_alter(&$form, &$form_state, $form_id) {
    $form['actions']['submit']['#value'] = 'Адправіць';
}
