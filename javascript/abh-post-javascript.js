jQuery(document).ready(function(){
	console.log('docready');
	// Hide the default post input box.
	jQuery("#postdivrich").hide();

	showEmailInfo();
	showPhysicalActInfo();

});


/*
 * This function is called on document ready, and
 * any time the checkbox #abh-kindness-email-toggle
 * is checked or unchecked.
 *
 * This function toggles the visibility of the form
 * that the user fills out to send an email to someone
 * in their social support system.
 */
function showEmailInfo() {
	console.log('showEmailInfo');

	if( jQuery("#abh-kindness-email-toggle").is(':checked') ) {
		jQuery("#abh-write-email-on").show();
		jQuery("#abh-write-email-off").hide();
	} else {
		jQuery("#abh-write-email-on").hide();
		jQuery("#abh-write-email-off").show();
	} // end if
}


/*
 * This function is called on document ready, and
 * any time the checkbox #abh-kindness-email-toggle
 * is checked or unchecked.
 *
 * This function toggles the visibility of the form
 * that the user fills out to reflect on their conscious
 * act of kindness for the day.
 */
function showPhysicalActInfo() {
	console.log('showPhysicalActInfo');

	if( jQuery("#abh-kindness-physical-toggle").is(':checked') ) {
		jQuery("#abh-commit-act-on").show();
		jQuery("#abh-commit-act-off").hide();
	} else {
		jQuery("#abh-commit-act-on").hide();
		jQuery("#abh-commit-act-off").show();
	} // end if
}