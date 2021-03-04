<?php 

    function print_html_principal ($data, $isAllRecords) {
        $htmlGeneral = "<div class=\"principal-animal\">";
        $htmlGeneral .= "   <div>";
        $htmlGeneral .= "       <div>";
        $htmlGeneral .= "            <input type=\"radio\" id=\"showAllProducts\" name=\"showProducts\" value=\"showAllProducts\" data-isActive=\"1\" checked><label for=\"showAllProducts\">Mostrar todos los productos</label>";
        $htmlGeneral .= "            <input type=\"radio\" id=\"showProductsPriority\" name=\"showProducts\" value=\"showProductsPriority\" data-isActive=\"0\"><label for=\"showProductsPriority\">Mostrar los productos por prioridad</label>";
        $htmlGeneral .= "       <div>";
        $htmlGeneral .= print_html_content($data, $isAllRecords);
        $htmlGeneral .= "   </div>";
        $htmlGeneral .= "</div>";
        return $htmlGeneral;
    }

    function print_html_content ($data, $isAllRecords) {
        $htmlGeneralContent = "";
        if (is_array($data)){
            $products = management_information($data, $isAllRecords);
            $htmlGeneralContent .= '<div class="content-products">';
            if (is_array($products)) {
                for($i = 0 ; $i < sizeof($products); $i++) {
                    $tag = "";
                    for ($z = 0; $z < sizeof($products[$i]->tagTem); $z++) {
                        $tag .= "<span>".$products[$i]->tagTem[$z]."</span> ";
                    } 
                    for ($y = 0; $y < sizeof($products[$i]->categoryTemp); $y++) {
                        for ($v = 0; $v < sizeof($products[$i]->animalTemp); $v++) {
                            $htmlGeneralContent .=  "<div class=\"product\"><h4>Animal - ".$products[$i]->animalTemp[$v]."</h4> <h5>Producto</h5> <span>".$products[$i]->categoryTemp[$y]."</span> <h5>Etiquetas</h5> " . $tag . "</div>";
                        }
                    }
                }
            }
            $htmlGeneralContent .= "</div>";
        } 
        return $htmlGeneralContent;
    }

    function management_information($data, $isAllRecords)
    {
        $arrayTempGeneral = [];
        if (is_array($data)) {
            $idTempGenearl = "0";
            $objectTempGeneral = new stdClass();
            $categoryTemp = [];
            $tagTem = [];
            $animalTemp = [];
            for ($i = 0; $i < sizeof($data); $i++) {
                switch (isset($data[$i]->ID)) {
                    case true:

                        $idTempGenearl = $i === 0 ? $data[$i]->ID : $idTempGenearl;

                        if ($data[$i]->ID !== $idTempGenearl) {
                            //$arrayTemp
                            $objectTempGeneral->categoryTemp = $categoryTemp;
                            $objectTempGeneral->tagTem = $tagTem;
                            $objectTempGeneral->animalTemp = $animalTemp;
                            array_push($arrayTempGeneral, $objectTempGeneral);
                            $objectTempGeneral = new stdClass();
                            $categoryTemp = [];
                            $tagTem = [];
                            $animalTemp = [];
                            $idTempGenearl  =  $data[$i]->ID;
                        }

                        if ($data[$i]->ID === $idTempGenearl) {
                            if (isset($data[$i]->name) && isset($data[$i]->taxonomy) && isset($data[$i]->isAnimal)) {
                                switch ($data[$i]->taxonomy) {
                                    case "category":
                                        if ($data[$i]->isAnimal === '0') {
                                            /*products*/
                                            array_push($categoryTemp, $data[$i]->name);
                                        } else {
                                            /*animals*/
                                            switch ($isAllRecords) {
                                                case true:
                                                    array_push($animalTemp, $data[$i]->name);
                                                    break;
                                                case false:
                                                    if (isset($data[$i]->isAnimalRequired) && $data[$i]->isAnimalRequired === '1'){
                                                        array_push($animalTemp, $data[$i]->name);
                                                    }
                                                    break;
                                            }
                                        }
                                        break;
                                    case "post_tag":
                                        array_push($tagTem, $data[$i]->name);
                                        break;
                                }
                            }
                        }

                        if (($i + 1) === sizeof($data)) {
                            $objectTempGeneral->categoryTemp = $categoryTemp;
                            $objectTempGeneral->tagTem = $tagTem;
                            $objectTempGeneral->animalTemp = $animalTemp;
                            array_push($arrayTempGeneral, $objectTempGeneral);
                        }
                        break;
                    case false:
                        break;
                }
            }
        }
        echo print_r($arrayTempGeneral);
        return $arrayTempGeneral;
    }

?>
