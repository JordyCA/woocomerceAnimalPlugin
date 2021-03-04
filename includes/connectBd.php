<?php
require_once(trailingslashit(ABSPATH) . 'wp-load.php');

function get_data_categry_tag_typeAnimal($isAllRecords, $animal)
{
    global $wpdb;
    $queryAnimal = "";
    $titleAnimal = "";
    if (!$isAllRecords) {
        $queryAnimal ="
            LEFT JOIN (
                SELECT 
                    " . $wpdb->prefix . "terms.term_id as id, if (slug = '" . $animal . "' AND taxonomy = 'category', true , false ) AS isAnimalrequired
                    FROM " . $wpdb->prefix . "terms
                        INNER JOIN " . $wpdb->prefix . "term_taxonomy ON wp_term_taxonomy.term_id = " . $wpdb->prefix . "terms.term_id
                WHERE (taxonomy = 'category'
                    AND slug = '" . $animal . "')
            )r2 ON r2.id = " . $wpdb->prefix . "term_taxonomy.term_id 
        ";
        $titleAnimal = " , if (r2.isAnimalRequired IS NULL OR r2.isAnimalRequired = 0, 0, r2.isAnimalRequired) AS isAnimalRequired ";
    }
    $query = "
    SELECT 
    " . $wpdb->prefix . "posts.ID," . $wpdb->prefix . "posts.post_title," . $wpdb->prefix . "terms.name," . $wpdb->prefix . "terms.slug,taxonomy, 
        if (r.isAnimal IS NULL OR r.isAnimal = 0, 0, r.isAnimal) AS isAnimal " . $titleAnimal . "
    FROM " . $wpdb->prefix . "posts
        INNER JOIN " . $wpdb->prefix . "term_relationships ON " . $wpdb->prefix . "posts.ID = " . $wpdb->prefix . "term_relationships.object_id
        INNER JOIN " . $wpdb->prefix . "terms ON " . $wpdb->prefix . "term_relationships.term_taxonomy_id = " . $wpdb->prefix . "terms.term_id
        INNER JOIN " . $wpdb->prefix . "term_taxonomy ON " . $wpdb->prefix . "term_relationships.term_taxonomy_id = " . $wpdb->prefix . "term_taxonomy.term_taxonomy_id
        LEFT JOIN (
            SELECT 
            " . $wpdb->prefix . "terms.term_id as id, if (parent = 0 && slug = 'especieanimal', true , false ) AS isAnimal
            FROM " . $wpdb->prefix . "terms
                INNER JOIN " . $wpdb->prefix . "term_taxonomy ON " . $wpdb->prefix . "term_taxonomy.term_id = " . $wpdb->prefix . "terms.term_id
            WHERE ( parent = 0
                AND taxonomy = 'category'
                AND (slug = 'productos' OR slug='especieanimal')))r ON r.id = " . $wpdb->prefix . "term_taxonomy.parent
        " .  $queryAnimal . "
    WHERE " . $wpdb->prefix . "posts.post_status = 'publish'
    AND (" . $wpdb->prefix . "term_taxonomy.parent != 0 OR " . $wpdb->prefix . "term_taxonomy.taxonomy ='post_tag')
    GROUP by " . $wpdb->prefix . "posts.ID, " . $wpdb->prefix . "term_relationships.term_taxonomy_id, " . $wpdb->prefix . "term_relationships.term_taxonomy_id
    ORDER BY " . $wpdb->prefix . "posts.ID;";
    //echo $query;
    $get = $wpdb->get_results($query);

    echo  print_r($get) ;
    return $get;
}
?>