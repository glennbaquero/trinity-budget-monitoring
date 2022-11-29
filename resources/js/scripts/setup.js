export const setup = {
	init() {
		// console.log('setup');
		$('.showPass').on('click', function() {
			var x = $(this).siblings('input');

			if (x.attr("type") == "password") {
				x.attr("type", "text");
				$(this).removeClass('fa-eye-slash');
				$(this).addClass('fa-eye');
			} else {
				x.attr("type", "password");
				$(this).addClass('fa-eye-slash');
				$(this).removeClass('fa-eye');
			}
		});

		function readURL(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();
		        reader.onload = function(e) {
		            $('#imagePreview').attr("src", e.target.result);
		            $('#imagePreview').hide();
		            $('#imagePreview').fadeIn(650);
		        }
		        reader.readAsDataURL(input.files[0]);
		    }
		}
		$("#imageUpload").change(function() {
		    readURL(this);
		});
	},
}