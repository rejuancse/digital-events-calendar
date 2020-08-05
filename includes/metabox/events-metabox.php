<p>
	<label for="author_name"><?php echo esc_html__('Event Start Date: ', 'event-calender') ?></label>
	<input id="event_start_date" type="date" name="event_start_date" value="<?php echo $event_start_date; ?>">
	<input id="event_start_time" type="time" name="event_start_time" value="<?php echo $event_start_time; ?>">
</p>

<p>
	<label for="product_name"><?php echo esc_html__('Event End Date: ', 'event-calender') ?></label>
	<input id="event_end_date" type="date" name="event_end_date" value="<?php echo $event_end_date; ?>">
	<input id="event_end_time" type="time" name="event_end_time" value="<?php echo $event_end_time; ?>">
</p>

<p>
	<label for="product_name"><?php echo esc_html__('Event Organizer: ', 'event-calender') ?></label>
	<input id="event_organizer" type="text" name="event_organizer" value="<?php echo $event_organizer; ?>">
</p>

<p>
	<label for="product_name"><?php echo esc_html__('Event Location: ', 'event-calender') ?></label>
	<input id="event_location" type="text" name="event_location" value="<?php echo $event_location; ?>">
</p>

