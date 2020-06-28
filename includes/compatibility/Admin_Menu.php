<?php 

$style = '';

$major_color = get_option('event_major_color');

if( $major_color ){
    $style .= '.calendar .day li, .upcoming-events .head-area .btn:hover {
        background: '.$major_color.';
    }';

    $style .= '.calendar ul li {
	    border-color: '.$major_color.';
	}';

	$style .= '.calendar ul li, .upcoming-events h2.main-head-event, .event-date .event-intro .event-content h2 a, .upcoming-events .head-area .btn {
	    color: '.$major_color.';
	}';

}

$output = '<style type="text/css"> '.$style.' </style>';
echo $output;