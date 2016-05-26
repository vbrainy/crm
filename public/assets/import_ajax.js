(function($){

	$(document).ready(function(){
		
		$('body').on('submit', '#csv-import', function(event){
			event.stopPropagation();
			event.preventDefault();

			var formEl = $(this).get(0),
				formData = new FormData(formEl),
				fileInputEl = $('#csv_file').get(0),
				allInputs = $(this).find('input, select'),
				submit = $(this).find('[type="submit"]');

			allInputs.prop('disabled', true);

			submit.val('Importing...');

			$.ajax({
				url: '../public/assets/import.php',
				type: 'POST',
				data: formData,
				processData: false,
				contentType: false,
				success: function(response) {
					allInputs.prop('disabled', false);
					submit.val('Import');

					if (response == 'ERR001' || response == 'ERR002') {
						alert('File not uploaded.');
					}

					if (response == 'ERR003') {
						alert('You must set the type.');
					}

					if (response == 'OK') {
						alert('Import successful!');
					}
				}
			});

		});

	});

})(jQuery);