<?php

function plugin_woocommerceAnimalPlugin_shortCode()
{
    return manage_print_general(false, 'canario');
}

function manage_print_general ($isAllRecords, $animalFind) {
    switch ($isAllRecords) {
        case true:
            return print_all_record_animal();
            break;
        case false:
            return print_animal_selected($animalFind);
            break;
    }
}

/*all products*/
function print_all_record_animal () {
    return print_html_principal(get_data_categry_tag_typeAnimal(true, ""), true);
}

/*priority products*/
function print_animal_selected ($animalFind) {
    return print_html_principal(get_data_categry_tag_typeAnimal(false, $animalFind), false);
}

add_shortcode('plugin_woocommerceAnimalPlugin_shortCode', 'plugin_woocommerceAnimalPlugin_shortCode');
?>