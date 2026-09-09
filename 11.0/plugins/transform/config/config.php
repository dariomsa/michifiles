<?php
$cropper_default_target_format = 'JPG';
$cropper_allowed_extensions = array('TIF','TIFF','JPG','JPEG','PNG','GIF','BMP','PSD'); // file formats that can be transformed
$cropper_formatarray = array('TIF','JPEG','JPG','PNG'); // output formats allowed for transform operations
$cropper_cropsize='pre';
$cropper_use_filename_as_title=false; // if false then uses existing rrr_transform.ext naming; if true then core file naming configs are honoured
$cropper_allow_scale_up = true; // if false, scaling parameters that would result in enlargement are ignored
$cropper_rotation = true; // if true, enables flipping and rotation of images
$cropper_transform_original = false;
$cropper_use_repage = true; // use repage feature to remove image geometry after transformation. This is necessary for most ImageMagick-based systems to behave correctly.
$cropper_jpeg_rgb = true; // when creating a jpeg, make sure it is RGB
$cropper_enable_batch = false; // enable batch transform of collections
$cropper_enable_alternative_files = true;
$cropper_enable_replace_slideshow = true;
$cropper_restricteduse_groups=array();
$cropper_resolutions=array();
$cropper_quality_select = false;
$cropper_srgb_option = false;
$use_system_icc_profile_config = false;
$cropper_preset_sizes = array(
    "WEB"  => array(
        "Post" => "1200x800",
        ),
    "Facebook"  => array(
        "Foto de perfil"            => "180x180",
        "Foto de portada"           => "851x315",
        "Publicación del feed"      => "1200x630",
        "Historia"                  => "1080x1920",
        "Imagen para recaudación"   => "800x300",
        "Anuncio de Facebook"       => "1080x1080",
        "Carrusel"                  => "1200x1200",
        ), 
    "X"  => array(
        "Foto de perfil" => "400x400",
        "Imagen de encabezado" => "1500x500",
        "Imagen de publicación con enlace compartido" => "1200x628",
        "Publicación con una sola imagen" => "1080x1080",
    ),
    "Instagram"  => array(
        "Foto de perfil" => "320x320",
        "Miniaturas de foto" => "161x161",
        "Tamaño de foto (app de Instagram)" => "1080x1080",
        "Historias de Instagram" => "1080x1920",
        ),
    "Pinterest"  => array(
        "Foto de perfil" => "165x165",
        "Pines (pagina principal)" => "236",
        "Pines (en tablero)" => "236",
        "Pines (ampliados)" => "600x900",
        "Tablero de pines (miniatura grande)" => "222x150",
        "Tablero de pines (miniatura pequena)" => "55x55",

        ),
    "YouTube"  => array(
        "Imagen de perfil del canal" => "800x800",
        "Arte de portada del canal" => "2560x1440",
        "Portada del canal: area segura para logos y texto" => "1235x338",
        "Subidas de video" => "1280x720",
        ),
    );
