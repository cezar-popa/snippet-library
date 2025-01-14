<?php
/**
 * Gravity Perks // Limit Dates // Only Enable the First Day of Each Month
 * https://gravitywiz.com/documentation/gravity-forms-limit-dates/
 */
// Update "123" to your form ID and "4" to your field ID.
add_filter( 'gpld_limit_dates_options_123_4', function( $options, $form, $field ) {

	$range_start = new DateTime();
	if ( (int) $range_start->format( 'j' ) > 1 ) {
		$range_start->modify( 'first day of next month' );
	}

	$range_end = ( clone $range_start )->add( new DateInterval( 'P1Y' ) );

	$period = new DatePeriod( $range_start, new DateInterval( 'P1M' ), $range_end );
	foreach ( $period as $date ) {
		$options['exceptions'][] = $date->format( 'm/01/Y' );
	}

	$options['disableAll']    = true;
	$options['exceptionMode'] = 'enable';
	$options['minDate']       = $range_start->format( 'm/d/Y' );
	$options['maxDate']       = $range_end->format( 'm/d/Y' );

	return $options;
}, 10, 3 );
