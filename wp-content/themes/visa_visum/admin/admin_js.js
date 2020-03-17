jQuery('.destination-column-title').on("click", ".edit", function (e) {
  // e.preventDefault();
  const post_id = jQuery(this).find('.editPoll').attr("data-id");
  const nonce = jQuery(this).find('.editPoll').attr("data-nonce");
    jQuery.ajax({
        type : "post",
        dataType : "json",
        url : ajaxurl,
        data : {action: "destination_table_edit", post_id : post_id, nonce: nonce},
        success: function(response) {
          if(response.length > 0) {
            jQuery('#titleWraper input').val(response[0].title);
            jQuery('#nationalitywraper select').val(response[0].nationality_id);
            jQuery('#purposeWraper select').val(response[0].purpose_id);
            jQuery('#destinationwraper select').val(response[0].destination_id);
            jQuery('#hidden-id').val(response[0].id);
          }
          else {
              alert("Error In edit.")
          }
        }
    })
});


/**
 * Delete Destination
 */

jQuery('.destination-column-title').on("click", ".trash", function (e) {
  // e.preventDefault();
  const post_id = jQuery(this).find('.submitdelete').attr("data-id");
  const nonce = jQuery(this).find('.submitdelete').attr("data-nonce");
    jQuery.ajax({
        type : "post",
        dataType : "json",
        url : ajaxurl,
        data : {action: "destination_table_delete", post_id : post_id, nonce: nonce},
        success: function(response) {

          if(response) {
            window.location.reload();
          }
          else {
              alert("Error In delete.")
          }
        }
    })
});

// Travel Purpose Edit 
jQuery('.travel-purpose-column').on("click", ".edit", function (e) {
  // e.preventDefault();  
  const post_id = jQuery(this).find('.editPoll').attr("data-id");
  const nonce = jQuery(this).find('.editPoll').attr("data-nonce");
    jQuery.ajax({
        type : "post",
        dataType : "json",
        url : ajaxurl,
        data : {action: "travel_purpose_table_edit", post_id : post_id, nonce: nonce},
        success: function(response) {
          if(response.length > 0) {
            jQuery('#titleWraper input').val(response[0].purpose);
            jQuery('#hidden-id').val(response[0].id);
          }
          else {
              alert("Error In edit.")
          }
        }
    })
});

// Travel Purpose Delete 
jQuery('.travel-purpose-column').on("click", ".trash", function (e) {
  // e.preventDefault();
  const post_id = jQuery(this).find('.submitdelete').attr("data-id");
  const nonce = jQuery(this).find('.submitdelete').attr("data-nonce");
    jQuery.ajax({
        type : "post",
        dataType : "json",
        url : ajaxurl,
        data : {action: "travel_purpose_table_delete", post_id : post_id, nonce: nonce},
        success: function(response) {

          if(response) {
            window.location.reload();
          }
          else {
              alert("Error In delete.")
          }
        }
    })
});

// Nationality Edit 
jQuery('.nationality-column').on("click", ".edit", function (e) {
  // e.preventDefault();  
  const post_id = jQuery(this).find('.editPoll').attr("data-id");
  const nonce = jQuery(this).find('.editPoll').attr("data-nonce");
    jQuery.ajax({
        type : "post",
        dataType : "json",
        url : ajaxurl,
        data : {action: "user_nationality_table_edit", post_id : post_id, nonce: nonce},
        success: function(response) {
          if(response.length > 0) {
            jQuery('#titlewrap input').val(response[0].country);
			jQuery('#abbrwrap input').val(response[0].country_abbr);
            jQuery('#hidden-id').val(response[0].id);
          }
          else {
              alert("Error In edit.")
          }
        }
    })
});

// Nationality Delete 
jQuery('.nationality-column').on("click", ".trash", function (e) {
  // e.preventDefault();
  const post_id = jQuery(this).find('.submitdelete').attr("data-id");
  const nonce = jQuery(this).find('.submitdelete').attr("data-nonce");
    jQuery.ajax({
        type : "post",
        dataType : "json",
        url : ajaxurl,
        data : {action: "user_nationality_table_delete", post_id : post_id, nonce: nonce},
        success: function(response) {

          if(response) {
            window.location.reload();
          }
          else {
              alert("Error In delete.")
          }
        }
    })
});
