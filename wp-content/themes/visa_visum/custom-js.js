var numeberOfTraverler = 0;
jQuery( document ).ready(function($) {
	/*jQuery('select[name ="destination"]').on('change', function(){
		var matlas = $(this).closest('.need_a_visa');
		jQuery("#purpose").html('');
		jQuery('#purpose').prepend(jQuery('<option></option>').html('Loading...'));
		var destination_id = jQuery(this).find(":selected").val();
		if(destination_id > 0){
			jQuery.ajax({
				type: "GET",
				url: myAjax.ajax_url,
				dataType : "json",
				data : {
					action : 'my_get_purpose',
					destination_id : jQuery(this).find(":selected").val()
				},
				success: function(result){
					if(result.success && result.data !== ''){
						matlas.find("select[name ='purpose']").html('');
						matlas.find("select[name ='purpose']").append(jQuery("<option/>").val('').text('Select Purpose'));
						jQuery.each(result.data, function (){
							matlas.find("select[name ='purpose']").append(jQuery("<option/>").val(this.id).text(this.purpose));
						});
					}
					else {
						matlas.find("select[name ='purpose']").html('');
						matlas.find("select[name ='purpose']").append(jQuery("<option/>").val('').text('Select Purpose'));
					}
				},
				failure: function () {
					//alert("Failed!");
				}
			});
		}
		else {
			matlas.find("select[name ='purpose']").html('');
			matlas.find("select[name ='purpose']").append(jQuery("<option/>").val('').text('Select Purpose'));
		}
	});*/
	/*--- Matlas ---*/
	/*$('.row').each(function(){
        var highestBox = 0;
        $(this).find('.mequalheight').each(function(){
            if($(this).height() > highestBox){
                highestBox = $(this).height();
            }
        })
        $(this).find('.mequalheight').height(highestBox);
    });*/
    //$('.matlassidebar').stickyMojo({footerID: '#footer', contentID: '#content'});
	/*--- Matlas ---*/
	jQuery('input[name ="search"]').on('click', function(e){
		e.preventDefault();
		var matlas = $(this).closest('.need_a_visa');
		var destination_id = matlas.find('select[name ="destination"]').find(":selected").val();
		var destination = matlas.find('select[name ="destination"] option:selected').text();
		//var purpose_id = matlas.find('select[name ="purpose"]').find(":selected").val();
		if(destination_id > 0){
			jQuery.ajax({
				type: "GET",
				url: myAjax.ajax_url,
				dataType : "json",
				data : {
					action : 'get_destination_post',
					destination_id : destination_id,
				},
				success: function(result){
					if(result.success && result.url !== ''){
						window.location.href = result.url;
					}
					else {
						/* jQuery("#purpose").html('');
						jQuery("#purpose").append(jQuery("<option/>").val('').text('Select Purpose')); */
					}
				},
				failure: function () {
					//alert("Failed!");
				}
			});
		}
		else {
			Swal.fire("Please select proper options!");
		}
	});

	const addTraveler = document.getElementById("add_traverl_info_button");
	if( addTraveler ){
		addTraveler.addEventListener("click", addMoreTraverler);
	}

	const addIntended = document.getElementById("add_intended_info_button");
	if( addIntended ){
		addIntended.addEventListener("click", addMoreIntended);
	}

	const addPlace = document.getElementById("add_place_info_button");
	if( addPlace ){
		addPlace.addEventListener("click", addMorePlace);
	}

	if($(window).width() >= 991){
		/* sticky sidebar */
		jQuery('.matlassidebar').stickySidebar({
		    topSpacing: 100,
			bottomSpacing: 100,
			containerSelector: '.row',
		    innerWrapperSelector: '.wrapper'
		});
	}
});

function addMoreTraverler() {
	// jQuery("#traveler_info").clone().appendTo("#visa_travel_details-information");
	let existingTraverler = this.dataset.total;

	if (this.dataset.total == 0) { existingTraverler = 1; }
	const original = document.getElementById('traveler_info_' + (existingTraverler - 1));
	const clickSection = document.getElementById('add_travelers-section');
	const clone = original.cloneNode(true);
	clone.id = "traveler_info_" + existingTraverler;
	const queryAttr = ['nationality', 'first_name', 'surname', 'date_birth'];
	clone.querySelector('#traveler_id_'+ (existingTraverler - 1)).setAttribute('id', 'traveler_id_' + existingTraverler );
	clone.querySelector('#traveler_id_' + existingTraverler).innerHTML = "Traveler " + (parseInt(existingTraverler, 10) + 1) + "<span onclick='removeTraverler("+ parseInt(existingTraverler, 10) +")' > Remove Traveler " + (parseInt(existingTraverler, 10) + 1) + "</span>";
	queryAttr.map(attrset => {
		//clone.querySelector('label[for="traverler_'+ attrset + '_' + (existingTraverler - 1) + '"]').setAttribute('for', 'traverler_'+ attrset + '_' + existingTraverler );
		clone.querySelector('#traverler_'+ attrset + '_0').setAttribute('name', 'traverler[' + existingTraverler + ']['+ attrset + ']' );
		clone.querySelector('#traverler_'+ attrset + '_' + (existingTraverler - 1)).setAttribute('id', 'traverler_'+ attrset + '_' + existingTraverler);
	});
	existingTraverler++
	this.dataset.total = existingTraverler;

	// clone.onclick = addMoreTraverler;
	original.parentNode.insertBefore(clone, clickSection);
}



function removeTraverler(id) {
	const removeElement = document.getElementById('traveler_info_' + id);
	removeElement.remove();
	const buttonDataValue = document.getElementById("add_traverl_info_button").dataset.total;

	const queryAttr = ['nationality', 'first_name', 'surname', 'date_birth'];
	for (let index = id; index <= buttonDataValue; index++) {
		const queryElement = document.getElementById('traveler_info_' + (index + 1));
		if(queryElement) {
			queryElement.setAttribute('id', 'traveler_info_' + index );
			queryElement.querySelector('#traveler_id_' + (index + 1)).setAttribute('id', 'traveler_id_' + index );
			queryElement.querySelector('#traveler_id_' + index).innerHTML = "Traveler " + (index + 1) + "<span onclick='removeTraverler("+ index +")' > Remove Traveler " + (index + 1) + "</span>";

			queryAttr.map(attrset => {
				queryElement.querySelector('label[for="traverler_'+ attrset + '_' + (index + 1) + '"]').setAttribute('for', 'traverler_'+ attrset + '_' + index );
				queryElement.querySelector('#traverler_'+ attrset + '_' + (index + 1) ).setAttribute('id', 'traverler_'+ attrset + '_' + index);
				// queryElement.querySelector('#traverler_'+ attrset + '_' + index).setAttribute('name', 'traverler[' + index + ']['+ attrset + ']' );
			});
		}
		// console.log(queryElement);
	}
	document.getElementById("add_traverl_info_button").dataset.total = parseInt(buttonDataValue, 10) - 1;

}

function addMoreIntended() {
	// jQuery("#traveler_info").clone().appendTo("#visa_travel_details-information");
	let existingIntended = this.dataset.total;

	if (this.dataset.total == 0) {
		existingIntended = 1;
	}
	const original = document.getElementById('intended_info_' + (existingIntended - 1));
	const clickSection = document.getElementById('add_intended-section');
	const clone = original.cloneNode(true);
	clone.id = "intended_info_" + existingIntended;

	const queryAttr = ['type_of_accomodation','name','address','number'];
	clone.querySelector('#intended_id_'+ (existingIntended - 1)).setAttribute('id', 'intended_id_' + existingIntended );
	clone.querySelector('#intended_id_' + existingIntended).innerHTML = "Intended " + (parseInt(existingIntended, 10) + 1) + "<span onclick='removeIntended("+ parseInt(existingIntended, 10) +")' > Remove Intended " + (parseInt(existingIntended, 10) + 1) + "</span>";
	queryAttr.map(attrset => {
		console.log('label[for="intended_1_to_8_'+ attrset + '_' + (existingIntended - 1) + '"]');
		clone.querySelector('label[for="intended_1_to_8_'+ attrset + '_' + (existingIntended - 1) + '"]').setAttribute('for', 'intended_1_to_8_'+ attrset + '_' + existingIntended );
		// clone.querySelector('#traverler_'+ attrset + '_0').setAttribute('name', 'traverler[' + existingIntended + ']['+ attrset + ']' );
		clone.querySelector('#intended_'+ attrset + '_' + (existingIntended - 1)).setAttribute('id', 'intended_'+ attrset + '_' + existingIntended);
	});
	existingIntended++
	this.dataset.total = existingIntended;

	// clone.onclick = addMoreIntended;
	original.parentNode.insertBefore(clone, clickSection);
}

function removeIntended(id) {
	const removeElement = document.getElementById('intended_info_' + id);
	removeElement.remove();
	const buttonDataValue = document.getElementById("add_intended_info_button").dataset.total;

	const queryAttr = ['type_of_accomodation','name','address','number'];
	for (let index = id; index <= buttonDataValue; index++) {
		const queryElement = document.getElementById('intended_info_' + (index + 1));
		if(queryElement) {
			queryElement.setAttribute('id', 'intended_info_' + index );
			queryElement.querySelector('#intended_id_' + (index + 1)).setAttribute('id', 'intended_id_' + index );
			queryElement.querySelector('#intended_id_' + index).innerHTML = "Intended " + (index + 1) + "<span onclick='removeIntended("+ index +")' > Remove Intended " + (index + 1) + "</span>";

			queryAttr.map(attrset => {
				queryElement.querySelector('label[for="intended_'+ attrset + '_' + (index + 1) + '"]').setAttribute('for', 'intended_'+ attrset + '_' + index );
				queryElement.querySelector('#intended_'+ attrset + '_' + (index + 1) ).setAttribute('id', 'intended_'+ attrset + '_' + index);
				// queryElement.querySelector('#traverler_'+ attrset + '_' + index).setAttribute('name', 'traverler[' + index + ']['+ attrset + ']' );
			});
		}
		// console.log(queryElement);
	}
	document.getElementById("add_intended_info_button").dataset.total = parseInt(buttonDataValue, 10) - 1;

}

function addMorePlace() {
	// jQuery("#traveler_info").clone().appendTo("#visa_travel_details-information");
	let existingPlace = this.dataset.total;

	if (this.dataset.total == 0) {
		existingPlace = 1;
	}
	const original = document.getElementById('place_visit_' + (existingPlace - 1));
	const clickSection = document.getElementById('add_place-section');
	const clone = original.cloneNode(true);
	clone.id = "place_visit_" + existingPlace;

	const queryAttr = ['name'];
	clone.querySelector('#place_id_'+ (existingPlace - 1)).setAttribute('id', 'place_id_' + existingPlace );
	clone.querySelector('#place_id_' + existingPlace).innerHTML = "Place " + (parseInt(existingPlace, 10) + 1) + "<span onclick='removePlace("+ parseInt(existingPlace, 10) +")' > Remove Place " + (parseInt(existingPlace, 10) + 1) + "</span>";
	console.log(clone);
	queryAttr.map(attrset => {
		console.log('label[for="place_'+ attrset + '_' + (existingPlace - 1) + '"]');
		clone.querySelector('label[for="place_'+ attrset + '_' + (existingPlace - 1) + '"]').setAttribute('for', 'place_'+ attrset + '_' + existingPlace );
		// clone.querySelector('#traverler_'+ attrset + '_0').setAttribute('name', 'traverler[' + existingIntended + ']['+ attrset + ']' );
		clone.querySelector('#place_'+ attrset + '_' + (existingPlace - 1)).setAttribute('id', 'place_'+ attrset + '_' + existingPlace);
	});
	existingPlace++
	this.dataset.total = existingPlace;

	// clone.onclick = addMoreIntended;
	original.parentNode.insertBefore(clone, clickSection);
}

function removePlace(id) {
	const removeElement = document.getElementById('place_visit_' + id);
	removeElement.remove();
	const buttonDataValue = document.getElementById("add_place_info_button").dataset.total;

	const queryAttr = ['name'];
	for (let index = id; index <= buttonDataValue; index++) {
		const queryElement = document.getElementById('place_visit_' + (index + 1));
		if(queryElement) {
			queryElement.setAttribute('id', 'place_visit_' + index );
			queryElement.querySelector('#place_id_' + (index + 1)).setAttribute('id', 'place_id_' + index );
			queryElement.querySelector('#place_id_' + index).innerHTML = "Place " + (index + 1) + "<span onclick='removePlace("+ index +")' > Remove Place " + (index + 1) + "</span>";

			queryAttr.map(attrset => {
				queryElement.querySelector('label[for="place_'+ attrset + '_' + (index + 1) + '"]').setAttribute('for', 'place_'+ attrset + '_' + index );
				queryElement.querySelector('#place_'+ attrset + '_' + (index + 1) ).setAttribute('id', 'place_'+ attrset + '_' + index);
				// queryElement.querySelector('#traverler_'+ attrset + '_' + index).setAttribute('name', 'traverler[' + index + ']['+ attrset + ']' );
			});
		}
		// console.log(queryElement);
	}
	document.getElementById("add_place_info_button").dataset.total = parseInt(buttonDataValue, 10) - 1;

}


jQuery(document).ready(function(){
jQuery(".legalisatie-button").click(function(){
  jQuery(".legalisatie-form-section").toggle();
});
});