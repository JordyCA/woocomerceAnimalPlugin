<?php

function plugin_woocommerceAnimalPlugin_shortCode()
{
    return manage_print_general(true, '', false);
}

function manage_print_general ($isAllRecords, $animalFind, $isPrintContent) {
    switch ($isAllRecords) {
        case true:
            if (!$isPrintContent){
                return print_all_record_animal();
            } else {
                return print_content_all_record_animal();
            }
            break;
        case false:
            if (!$isPrintContent) {
                return print_animal_selected($animalFind);
            } else {
                return print_content_animal_selected($animalFind);
            }
            break;
    }
}

/*all products*/
function print_all_record_animal () {
    return print_html_principal(get_data_categry_tag_typeAnimal(true, ""), true);
}
function print_content_all_record_animal() {
    return print_html_content(get_data_categry_tag_typeAnimal(true, ""), true);
}

/*priority products*/
function print_animal_selected ($animalFind) {
    return print_html_principal(get_data_categry_tag_typeAnimal(false, $animalFind), false);
}

function print_content_animal_selected ($animalFind) {
    return print_html_content(get_data_categry_tag_typeAnimal(false, $animalFind), false);
}

add_shortcode('plugin_woocommerceAnimalPlugin_shortCode', 'plugin_woocommerceAnimalPlugin_shortCode');
?>