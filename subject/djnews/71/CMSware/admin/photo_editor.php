<?php
require_once 'common.php';

switch($IN[o]) {
	case 'main':
		include_once 'photoEditor/popedit.php';
		break;
	case 'crop':
		include_once 'photoEditor/crop.php';
		break;
	case 'overlay':
		include_once 'photoEditor/overlay.php';
		break;
	case 'luminance':
		include_once 'photoEditor/luminance.php';
		break;
	case 'colorize':
		include_once 'photoEditor/colorize.php';
		break;
	case 'rotate':
		include_once 'photoEditor/rotate.php';
		break;
	case 'scale':
		include_once 'photoEditor/scale.php';
		break;
	case 'do':
		include_once 'photoEditor/appimg.php';
		break;
	default:
		include_once 'photoEditor/appimg.php';
		break;
}


?>