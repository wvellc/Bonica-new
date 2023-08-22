<script type="text/javascript">
function uploadPdf(){
	Swal.fire({
	    title: 'Upload File',
	    html: '<span class="error"> upload only xlsx file. </span><input type="file" id="fileInput" class="form-control" name="file"><span id="detailed_sample_file" class="sample_file"><a href="<?= asset(SAMPLE_FILE_PATH) ?>">Click here</a> to download sample file</span>',
	    showCancelButton: true,
	    confirmButtonColor: '#40485b',
		confirmButtonText: 'Import',
		cancelButtonClass: '#dcccbd',
	    preConfirm: () => {
	        const fileInput = document.getElementById('fileInput');
	        const file = fileInput.files[0];
	        if (file) {
	            const formData = new FormData();
		        formData.append('csv_file', file);
				 // Make AJAX request using Axios or jQuery.ajax, etc.
		        axios.post("{{route('admin.import-packet')}}", formData)
		          .then(response => {
		          	myTable.ajax.reload();
		            Swal.fire({
							title: "Updated",
							text: response.data.message,
							type: "success",
						});
		          })
		          .catch(error => {
		            // Handle the error response
		            Swal.fire({
							title: "Error",
							text: 'An error occurred',
							type: "error",
						});
		          });
				
		    }else{
		    	Swal.fire({
					title: "warning",
					text: 'No file selected',
					type: "warning",
				});
		    }
	    }
	});
}
</script>