<?php

function textarea($val,$campo,$label,$necesario=0,$manejaLang=0,$esAjax=0,$disabled=false,$clase="") {

if($disabled) $disabled = ' disabled="disabled" ';

$html = '<div class="form-group">';
$val = explode("[lang]",$val);
$claz = explode('__','contenedor_'.$campo);
$claz2 = explode('__',$campo);
// LABEL
$html.= '<label for="' . $campo . '">'.ucfirst($label).'</label>';
// TEXTAREA
$html.= '<textarea '.$disabled.' name="'.$campo.'" id="'.$campo.'"  class="form-control ' . $clase . '">'.htmlspecialchars_decode($val[0]).'</textarea>';
$html.='</div>';
return($html);
}

?>
