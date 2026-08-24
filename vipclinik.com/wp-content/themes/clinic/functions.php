<?php remove_action('wp_head', 'wp_generator');

add_theme_support( 'woocommerce' );

// добавление скриптов
function enqueue_scripts() {
  /** REGISTER jQuery **/
//  wp_register_script( 'jquery-google', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js', array( 'jquery' ), '1.0', false );
  wp_enqueue_script( 'jquery' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_scripts' );


// Длина цитаты
function custom_excerpt_length() {
     $length = 50;
     return $length;
}
 add_filter('excerpt_length', 'custom_excerpt_length');
 

// Добавление превью на страницу категорий
 if ( function_exists( 'add_theme_support' ) )
add_theme_support( 'post-thumbnails' );
 
 // Регистрация меню
 function register_my_menus() 
{ register_nav_menus( array( 'tnav' => 'Меню в Шапке', 'snav' => 'Меню в Сайдбаре', 'buynav' => 'Каталог продукции в Сайдбаре', 
        'plastnav' => 'Пластическая хирургия',
        'vrachnav' => 'ВРАЧЕБНАЯ КОСМЕТОЛОГИЯ', 'estetnav' => 'ЭСТЕТИЧЕСКАЯ КОСМЕТОЛОГИЯ', 'aparatnav' => 'АППАРАТНАЯ КОСМЕТОЛОГИЯ', 
        'korektnav' => 'КОРРЕКЦИЯ ФИГУРЫ', 'omolozhnav' => 'ОБЩЕЕ ОМОЛОЖЕНИЕ', 'podderzhka' => 'ПСИХОЛОГИЧЕСКАЯ ПОДДЕРЖКА' ) );
}add_action( 'init', 'register_my_menus' );
    

// Обрезание картинки
function get_img_theme($url, $width, $height){
    $img_name=explode('/', $url);
    $file_url= '/wp-content/uploads/'.$img_name[count($img_name)-3].'/'.$img_name[count($img_name)-2].'/';
    $file_name=explode('.', $img_name[count($img_name)-1]);
    $file_name=$file_name[0].'-'.$width.'x'.$height.'.'.$file_name[1];
    if(file_exists($file_url.$file_name))
        return $file_url.$file_name;
    else{
        $image = wp_get_image_editor(ABSPATH.$file_url.$img_name[count($img_name)-1]);
        if ( ! is_wp_error($image)){
            $image->resize($width, $height, true );
            $image->save(ABSPATH.$file_url.$file_name);
            $blogurl = get_bloginfo('url');
            return $blogurl.$file_url.$file_name;
        }
    }
}


// колонка "ID" в админке
add_action('admin_init', 'admin_area_ID');
function admin_area_ID() {
  // для таксономий (рубрик, меток и т.д.)
  foreach (get_taxonomies() as $taxonomy) {
    add_action("manage_edit-${taxonomy}_columns", 'tax_add_col');
    add_filter("manage_edit-${taxonomy}_sortable_columns", 'tax_add_col');
    add_filter("manage_${taxonomy}_custom_column", 'tax_show_id', 10, 3);
  }
  add_action('admin_print_styles-edit-tags.php', 'tax_id_style');
  function tax_add_col($columns) {return $columns + array ('tax_id' => 'ID');}
  function tax_show_id($v, $name, $id) {return 'tax_id' === $name ? $id : $v;}
  function tax_id_style() {print '<style>#tax_id{width:4em}</style>';}
  // для постов и страниц
  add_filter('manage_posts_columns', 'posts_add_col', 5);
  add_action('manage_posts_custom_column', 'posts_show_id', 5, 2);
  add_filter('manage_pages_columns', 'posts_add_col', 5);
  add_action('manage_pages_custom_column', 'posts_show_id', 5, 2);
  add_action('admin_print_styles-edit.php', 'posts_id_style');
  function posts_add_col($defaults) {$defaults['wps_post_id'] = __('ID'); return $defaults;}
  function posts_show_id($column_name, $id) {if ($column_name === 'wps_post_id') echo $id;}
  function posts_id_style() {print '<style>#wps_post_id{width:4em}</style>';}
}



/* 
 * Хлебные крошки для WordPress (breadcrumbs)
 *
 * $sep  - разделитель. По умолчанию ' » '
 * $l10n - массив. для локализации. См. переменную $default_l10n.
 * $args - массив. дополнительные аргументы.
 * version 0.6
*/
function kama_breadcrumbs( $sep = 0, $l10n = array(), $args = array() ){
  global $post, $wp_query, $wp_post_types;

  // Локализация
  $default_l10n = array(
    'home'       => 'Главная',
    'paged'      => 'Страница %s',
    '_404'       => 'Ошибка 404',
    'search'     => 'Результаты поиска по запросу - <b>%s</b>',
    'author'     => 'Архив автора: <b>%s</b>',
    'year'       => 'Архив за <b>%s</b> год',
    'month'      => 'Архив за: <b>%s</b>',
    'day'        => '',
    'attachment' => 'Медиа: %s',
    'tag'        => 'Записи по метке: <b>%s</b>',
    'tax_tag'    => '%s из "%s" по тегу: <b>%s</b>',
  );
  
  // Параметры по умолчанию
  $default_args = array(
    'on_front_page'   => true, // выводить крошки на главной странице
    'show_post_title' => true, // показывать ли название записи в конце (последний элемент). Для записей, страниц, вложений
    'sep'             => ' » ', // разделитель
  );
  
  // Фильтрует аргументы по умолчанию.
  $default_args = apply_filters('kama_breadcrumbs_default_args', $default_args );
  
  $loc  = (object) array_merge( $default_l10n, $l10n );
  $args = (object) array_merge( $default_args, $args );

  if( $sep === 0 ) $sep = $args->sep;

  $w1 = '<div class="c_crumbs" prefix="v: http://rdf.data-vocabulary.org/#">';
  $w2 = '</div>';
  $patt1 = '<span typeof="v:Breadcrumb"><a href="%s" rel="v:url" property="v:title">';
  $sep .= '</span>'; // закрываем span после разделителя!
  $linkpatt = $patt1.'%s</a>';
  
  $ptype = & $wp_post_types[ $post->post_type ];
  
  // Вывод
  $pg_end = '';
  if( $paged = $wp_query->query_vars['paged'] ){
    $pg_patt = $patt1;
    $pg_end = '</a>'. $sep . sprintf( $loc->paged, $paged );
  }

  $out = '';
  if( is_front_page() ){
    return $args->on_front_page ? ( print $w1 .( $paged ? sprintf( $pg_patt, get_bloginfo('url') ) : '' ) . $loc->home . $pg_end . $w2 ) : '';
  }
  elseif( is_404() ){
    $out = $loc->_404; 
  }
  elseif( is_search() ){
    $out = sprintf( $loc->search, strip_tags( $GLOBALS['s'] ) );
  }
  elseif( is_author() ){
    $q_obj = &$wp_query->queried_object;
    $out = ( $paged ? sprintf( $pg_patt, get_author_posts_url( $q_obj->ID, $q_obj->user_nicename ) ):'') . sprintf( $loc->author, $q_obj->display_name ) . $pg_end;
  }
  elseif( is_year() || is_month() || is_day() ){
    $y_url  = get_year_link( $year=get_the_time('Y') );
    $m_url  = get_month_link( $year, get_the_time('m') );
    $y_link = sprintf( $linkpatt, $y_url, $year);
    $m_link = sprintf( $linkpatt, $m_url, get_the_time('F'));
    if( is_year() )
      $out = ( $paged?sprintf( $pg_patt, $y_url):'') . sprintf( $loc->year, $year ) . $pg_end;
    elseif( is_month() )
      $out = $y_link . $sep . ( $paged ? sprintf( $pg_patt, $m_url ) : '') . sprintf( $loc->month, get_the_time('F') ) . $pg_end;
    elseif( is_day() )
      $out = $y_link . $sep . $m_link . $sep . get_the_time('l');
  }

  // Древовидные записи
  elseif( is_singular() && $ptype->hierarchical ){
    $parent = $post->post_parent;
    $crumbs = array();
    while( $parent ){
      $page = & get_post( $parent );
      $crumbs[] = sprintf( $linkpatt, get_permalink( $page->ID ), $page->post_title );
      $parent = $page->post_parent;
    }
    $crumbs = array_reverse( $crumbs );
    
    foreach( $crumbs as $crumb ) $out .= $crumb . $sep;
    
    $out = $out . ( $args->show_post_title ? $post->post_title : '');
  }
  // Таксономии, вложения и не древовидные типы записей
  else {
    // Определяем термины
    if( is_singular() ){
      if( ! $taxonomies ){
        $taxonomies = get_taxonomies( array('hierarchical' => true, 'public' => true) );
        if( count( $taxonomies ) == 1 ) $taxonomies = 'category';
      }
      if( $term = get_the_terms( $post->post_parent ? $post->post_parent : $post->ID, $taxonomies ) ){
        $term = array_shift( $term );
      }
    }
    else
      $term = $wp_query->get_queried_object();

    //if( ! $term && ! is_attachment() ) return print "Error: Taxonomy is not defined!"; 
    
    if( $term ){
      $term = apply_filters('kama_breadcrumbs_term', $term );
      
      $pg_term_start = ( $paged && $term->term_id ) ? sprintf( $pg_patt, get_term_link( (int) $term->term_id, $term->taxonomy ) ) : '';
      
      // attachment
      if( is_attachment() ){
        if( ! $post->post_parent )
          $out = sprintf( $loc->attachment, $post->post_title );
        else
          $out = __crumbs_tax( $term->term_id, $term->taxonomy, $sep, $linkpatt ) . sprintf( $linkpatt, get_permalink( $post->post_parent ), get_the_title( $post->post_parent ) ) . $sep . ( $args->show_post_title ? $post->post_title : '');
      }
      // single
      elseif( is_single() ){
        $out = __crumbs_tax( $term->parent, $term->taxonomy, $sep, $linkpatt ) . 
        sprintf( $linkpatt, get_term_link( (int) $term->term_id, $term->taxonomy ), $term->name ). $sep . ( $args->show_post_title ? $post->post_title : '');
      // Метки, архивная страница типа записи, произвольные одноуровневые таксономии
      }
      // taxonomy не древовидная
      elseif( ! is_taxonomy_hierarchical( $term->taxonomy ) ){
        // метка
        if( is_tag() )
          $out = $pg_term_start . sprintf( $loc->tag, $term->name ) . $pg_end;
        // таксономия
        elseif( is_tax() ){
          $post_label = $ptype->labels->name;
          $tax_label = $GLOBALS['wp_taxonomies'][ $term->taxonomy ]->labels->name;
          $out = $pg_term_start . sprintf( $loc->tax_tag, $post_label, $tax_label, $term->name ) .  $pg_end;
        }
      }
      // Рубрики и таксономии
      else{
        //die( $term->taxonomy );
        $out = __crumbs_tax( $term->parent, $term->taxonomy, $sep, $linkpatt ) . $pg_term_start . $term->name . $pg_end;
      }
    }
  }
  
  $home_after = '';
  
  // замена ссылки на архивную страницу для типа записи 
  $home_after = apply_filters('kama_breadcrumbs_home_after', false, $linkpatt, $sep );
  
  // Cсылка на архивную страницу произвольно типа поста. Ссылку можно заменить с помощью хука 'kama_breadcrumbs_home_after'
  if( ! $home_after && $ptype->has_archive && (is_post_type_archive() || is_singular()) && ! in_array( $post->post_type, array('post','page','attachment') ) ){
    $pt_name = $ptype->labels->name;

    if( is_post_type_archive() && ! $paged )
      $home_after = $pt_name;
    else
      $home_after = sprintf( $linkpatt, get_post_type_archive_link( $post->post_type ), $pt_name ) . ($pg_end ? $pg_end : $sep);
  }
  
  $home = sprintf( $linkpatt, home_url(), $loc->home ). $sep . $home_after;
  
  $out = apply_filters('kama_breadcrumbs_pre_out', $out );
  
  $out = $w1. $home . $out .$w2;

  return print apply_filters('kama_breadcrumbs', $out, $sep );
}
function __crumbs_tax( $term_id, $tax, $sep, $linkpatt ){
  $termlink = array();
  while( (int) $term_id ){
    $term2      = get_term( $term_id, $tax );
    $termlink[] = sprintf( $linkpatt, get_term_link( (int) $term2->term_id, $term2->taxonomy ), $term2->name ). $sep;
    $term_id    = (int) $term2->parent;
  }
  
  $termlinks = array_reverse( $termlink );
  
  return implode('', $termlinks );
}


add_filter( 'woocommerce_breadcrumb_defaults', 'jk_woocommerce_breadcrumbs' );
function jk_woocommerce_breadcrumbs() {
return array(
'delimiter' => ' / ',
'wrap_before' => '<nav class="c_crumbs" itemprop="breadcrumb">',
'wrap_after' => '</nav>',
'before' => '',
'after' => '',
'home' => _x( 'Главная', 'breadcrumb', 'woocommerce' ),
);
}



function wds_get_ID_by_page_name($page_name) {
  global $wpdb;
  $page_name = strip_tags($page_name);
  $page_name = addslashes($page_name);
  $page_name_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_title ='".$page_name."'");
  return $page_name_id;
}




