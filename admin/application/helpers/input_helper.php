<?php

function input($val,$campo,$label,$maxChars=0,$necesario=0,$manejaLang=0,$esAjax=0,$disabled=false) {

$lang = 'es';
$html = '<div class="form-group">';
$val = explode("[lang]",$val);
$claz = explode('__','contenedor_'.$campo);
$claz2 = explode('__',$campo);
// MAX CHARS LABEL
if($maxChars) $label = $label.' (max '.$maxChars.' '.lang('caracteres').')';
// LABEL
if ($label!='') {
if ($necesario==1) {
$html.= '<label for="' . $campo . '">'.ucfirst($label).'</label>';
}else {
$html.= '<label for="' . $campo . '">'.ucfirst($label).'</label>';	
}
}
if ($necesario){
	$necesario = 'required';
}
$val = htmlspecialchars_decode($val[0]);
$type = 'text';
$html.= '<input '.$disabled.' name="'.$campo.'" id="'.$campo.'" class="form-control '.$claz2[0].'" maxlength="'.$maxChars.'" type="'.$type.'" value="'.$val.'" ' . $necesario . ' />';
$html.= '</div>';
return($html);
}

?>
