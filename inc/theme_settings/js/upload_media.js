/**
 * Callback function for the 'click' event of the 'Set Footer Image'
 * anchor in its meta box.
 *
 * Displays the media uploader for selecting an image.
 */
function renderMediaUploader($, obj) {
  'use strict';

  var file_frame, image_data, json;

  /**
   * If an instance of file_frame already exists, then we can open it
   * rather than creating a new instance.
   */
  if ( undefined !== file_frame ) {

    file_frame.open();
    return;

  }

  /**
   * If we're this far, then an instance does not exist, so we need to
   * create our own.
   *
   * Here, use the wp.media library to define the settings of the Media
   * Uploader. We're opting to use the 'post' frame which is a template
   * defined in WordPress core and are initializing the file frame
   * with the 'insert' state.
   *
   * We're also not allowing the user to select more than one image.
   */
  file_frame = wp.media.frames.file_frame = wp.media({
    frame:    'post',
    state:    'insert',
    multiple: false
  });

  /**
   * Setup an event handler for what to do when an image has been
   * selected.
   *
   * Since we're using the 'view' state when initializing
   * the file_frame, we need to make sure that the handler is attached
   * to the insert event.
   */
  file_frame.on( 'insert', function() {

    // Read the JSON data returned from the Media Uploader
    json = file_frame.state().get( 'selection' ).first().toJSON();

    // First, make sure that we have the URL of an image to display
    if ( 0 > $.trim( json.url.length ) ) {
      return;
    }

    // After that, set the properties of the image and display it
    $(obj)
      .closest('.ad')
      .find( '.selected-image' )
      .children( 'img' )
      .attr( 'src', json.url )
      .show()
      .parent()
      .removeClass( 'hidden' );

    $(obj)
      .closest('.ad')
      .find('.bannerad_url')
      .val(json.url);

  });

  // And we add the remove button
  $(obj)
    .closest('.ad')
    .find('.remove-selected')
    .removeClass('hidden');

  // Now display the actual file_frame
  file_frame.open();
}


(function( $ ) {
  'use strict';

  $(function() {

    $('.upload_image' ).each(function() {

      $(this).on( 'click', function(evt) {

        // Stop the anchor's default behavior
        evt.preventDefault();

        // Display the media uploader. We need to pas a reference to the referee
        // and jQuery it self.
        renderMediaUploader($, this);

      });
    });


    $('.remove-selected').each(function() {

      $(this).on( 'click', function(evt) {

        // Stop the anchor's default behavior
        evt.preventDefault();

        // Finds and removes the ad img to remove
        $(this)
          .closest('.ad')
          .find('.selected-image')
          .children('img')
          .attr('src', '')
          .hide()
          .parent()
          .addClass('hidden');

        // We hide the remove button, when there is no img.
        $(this).addClass("hidden");

        // And set the value to empty, so it's possible to not have any img selected.
        $(this)
          .closest('.ad')
          .find('.bannerad_url')
          .val('');

      });
    });
  });

})( jQuery );
