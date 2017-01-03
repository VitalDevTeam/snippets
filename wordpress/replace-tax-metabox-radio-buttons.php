<?php
/**
 * Replace default taxonomy metabox with radio button metabox
 */
class My_Taxonomy_Radio_Metabox {
	static $taxonomy = 'my_taxonomy'; // Taxonomy name
	static $taxonomy_metabox_id = 'my_taxonomydiv'; // ID of default metabox to remove
	static $post_type= 'my_post_type'; // Post type to apply to

	public static function load() {
		add_action('admin_menu', array(__CLASS__, 'remove_meta_box'));
		add_action('add_meta_boxes', array(__CLASS__, 'add_meta_box'));
	}

	public static function remove_meta_box() {
   		remove_meta_box(static::$taxonomy_metabox_id, static::$post_type, 'normal');
	}

	public static function add_meta_box() {
		add_meta_box('cta_style_metabox', 'My Custom Metabox', array(__CLASS__, 'metabox'), static::$post_type , 'side', 'core');
	}

	public static function metabox($post) {
       	$taxonomy = self::$taxonomy;
       	$tax = get_taxonomy($taxonomy);
       	$terms = get_terms($taxonomy, array('hide_empty' => 0));
       	$name = 'tax_input[' . $taxonomy . ']';
       	$postterms = get_the_terms($post->ID, $taxonomy);
       	$current = ($postterms ? array_pop($postterms) : false);
       	$current = ($current ? $current->term_id : 0);

        ?><div id="taxonomy-<?php echo $taxonomy; ?>" class="categorydiv">
			<div id="<?php echo $taxonomy; ?>-all" class="tabs-panel">
				<ul id="<?php echo $taxonomy; ?>checklist" class="list:<?php echo $taxonomy; ?> categorychecklist form-no-clear"><?php
                    foreach($terms as $term) {
       				    $id = $taxonomy . '-' . $term->term_id;
					    $value = (is_taxonomy_hierarchical($taxonomy) ? "value='{$term->term_id}'" : "value='{$term->term_slug}'");
				        echo "<li id='$id'><label class='selectit'>";
				        echo "<input type='radio' id='in-$id' name='{$name}'" . checked($current, $term->term_id, false) . " {$value}>$term->name<br>";
				        echo "</label></li>";
		       	    }
                ?></ul>
			</div>
		</div><?php
    }
}

My_Taxonomy_Radio_Metabox::load();
