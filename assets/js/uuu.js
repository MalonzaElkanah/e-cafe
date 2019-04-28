$(function(){
	$("#file-upload").change(function(event){
		// Fetch FileList object
	    var files = event.target.files || event.dataTransfer.files;

	    // Cancel event and hover styling
	    //fileDragHover(e);
	    event.stopPropagation();
	    event.preventDefault();

	    $("#file-drag").className = (event.type === 'dragover' ? 'hover' : 'modal-body file-upload');

	    // Process all File objects
	    for (var i = 0, f; f = files[i]; i++) {
			//parseFile(f);
			console.log(f.name);
		    output(
		      '<strong>' + encodeURI(f.name) + '</strong>'
		    );
		    
		    // var fileType = file.type;
		    // console.log(fileType);
		    var imageName = f.name;

		    var isGood = (/\.(?=gif|jpg|png|jpeg)/gi).test(imageName);
		    if (isGood) {
		      $("#start").classList.add("hidden");
		      $("#response").classList.remove("hidden");
		      $("#notimage").classList.add("hidden");
		      // Thumbnail Preview
		      $("#file-image").classList.remove("hidden");
		      $("#file-image").src = URL.createObjectURL(file);
		    }
		    else {
		      $("#file-image").classList.add("hidden");
		      $("#notimage").classList.remove("hidden");
		      $("#start").classList.remove("hidden");
		      $("#response").classList.add("hidden");
		      $("#file-upload-form").reset();
		    }
	      	//uploadFile(f);
	      	var xhr = new XMLHttpRequest(),
		    fileInput = $("#class-roster-file"), pBar = $("#file-progress"), fileSizeLimit = 1024; // In MB
		    if (xhr.upload) {
		    	// Check if file is less than x MB
		      	if (f.size <= fileSizeLimit * 1024 * 1024) {
			        // Progress bar
			        $("#file-progress").style.display = 'inline';
			        xhr.upload.loadstart(function(event){
		
					    if (event.lengthComputable) {
					      $("#file-progress").max = event.total;
					    }
			        });
			        xhr.upload.progress(function(event){
			        	
					    if (event.lengthComputable) {
					      $("#file-progress").value = event.loaded;
					    }
			        });

			        // File received / failed
			        xhr.onreadystatechange = function(event) {
			          	if (xhr.readyState == 4) {
				            // Everything is good!

				            // progress.className = (xhr.status == 200 ? "success" : "failure");
				            // document.location.reload(true);
			          	}
		        	};

			        // Start upload
			        xhr.open('POST', document.getElementById('file-upload-form').action, true);
			        xhr.setRequestHeader('X-File-Name', f.name);
			        xhr.setRequestHeader('X-File-Size', f.size);
			        xhr.setRequestHeader('Content-Type', 'multipart/form-data');
			        xhr.send(f);
			    } else {
		        	output('Please upload a smaller file (< ' + fileSizeLimit + ' MB).');
		      	}
		    }
	    }
	});
	$(function(){
		$("#file-drag").dragover(function(event){
		    event.stopPropagation();
		    event.preventDefault();

		    $("#file-drag").className = (event.type === 'dragover' ? 'hover' : 'modal-body file-upload');
		});
		$("#file-drag").dragleave(function(){
			event.stopPropagation();
		    event.preventDefault();

		    $("#file-drag").className = (event.type === 'dragover' ? 'hover' : 'modal-body file-upload');

		});
		$("#file-drag").drop(function(){
			// Fetch FileList object
		    var files = event.target.files || event.dataTransfer.files;

		    // Cancel event and hover styling
		    //fileDragHover(e);
		    event.stopPropagation();
		    event.preventDefault();

		    $("#file-drag").className = (event.type === 'dragover' ? 'hover' : 'modal-body file-upload');

		    // Process all File objects
		    for (var i = 0, f; f = files[i]; i++) {
				//parseFile(f);
				console.log(f.name);
			    output(
			      '<strong>' + encodeURI(f.name) + '</strong>'
			    );
			    
			    // var fileType = file.type;
			    // console.log(fileType);
			    var imageName = f.name;

			    var isGood = (/\.(?=gif|jpg|png|jpeg)/gi).test(imageName);
			    if (isGood) {
			      $("#start").classList.add("hidden");
			      $("#response").classList.remove("hidden");
			      $("#notimage").classList.add("hidden");
			      // Thumbnail Preview
			      $("#file-image").classList.remove("hidden");
			      $("#file-image").src = URL.createObjectURL(file);
			    }
			    else {
			      $("#file-image").classList.add("hidden");
			      $("#notimage").classList.remove("hidden");
			      $("#start").classList.remove("hidden");
			      $("#response").classList.add("hidden");
			      $("#file-upload-form").reset();
			    }
		      	//uploadFile(f);
		      	var xhr = new XMLHttpRequest(),
			    fileInput = $("#class-roster-file"), pBar = $("#file-progress"), fileSizeLimit = 1024; // In MB
			    if (xhr.upload) {
			    	// Check if file is less than x MB
			      	if (f.size <= fileSizeLimit * 1024 * 1024) {
				        // Progress bar
				        $("#file-progress").style.display = 'inline';
				        xhr.upload.loadstart(function(event){
			
						    if (event.lengthComputable) {
						      $("#file-progress").max = event.total;
						    }
				        });
				        xhr.upload.progress(function(event){
				        	
						    if (event.lengthComputable) {
						      $("#file-progress").value = event.loaded;
						    }
				        });

				        // File received / failed
				        xhr.onreadystatechange = function(event) {
				          	if (xhr.readyState == 4) {
					            // Everything is good!

					            // progress.className = (xhr.status == 200 ? "success" : "failure");
					            // document.location.reload(true);
				          	}
			        	};

				        // Start upload
				        xhr.open('POST', document.getElementById('file-upload-form').action, true);
				        xhr.setRequestHeader('X-File-Name', f.name);
				        xhr.setRequestHeader('X-File-Size', f.size);
				        xhr.setRequestHeader('Content-Type', 'multipart/form-data');
				        xhr.send(f);
				    } else {
			        	output('Please upload a smaller file (< ' + fileSizeLimit + ' MB).');
			      	}
			    }
		    }
		});
	});


	function Init(){
		console.log("Upload Initialised");

		var fileSelect    = $("#file-upload"),
        fileDrag      = $("#file-drag"),
        submitButton  = $("#submit-button");
		
		fileSelect.addEventListener('change', fileSelectHandler, false);

	    // Is XHR2 available?
	    var xhr = new XMLHttpRequest();
	    if (xhr.upload) {
	      // File Drop
	      fileDrag.addEventListener('dragover', fileDragHover, false);
	      fileDrag.addEventListener('dragleave', fileDragHover, false);
	      fileDrag.addEventListener('drop', fileSelectHandler, false);
    	}
	}

	function fileDragHover(e) {
	    var fileDrag = $("file-drag");

	    e.stopPropagation();
	    e.preventDefault();

	    fileDrag.className = (e.type === 'dragover' ? 'hover' : 'modal-body file-upload');
	  }

	  function fileSelectHandler(e) {
	    // Fetch FileList object
	    var files = e.target.files || e.dataTransfer.files;

	    // Cancel event and hover styling
	    fileDragHover(e);

	    // Process all File objects
	    for (var i = 0, f; f = files[i]; i++) {
	      parseFile(f);
	      uploadFile(f);
	    }
	}
	function parseFile(file) {

    console.log(file.name);
    output(
      '<strong>' + encodeURI(file.name) + '</strong>'
    );
    
    // var fileType = file.type;
    // console.log(fileType);
    var imageName = file.name;

    var isGood = (/\.(?=gif|jpg|png|jpeg)/gi).test(imageName);
    if (isGood) {
      document.getElementById('start').classList.add("hidden");
      document.getElementById('response').classList.remove("hidden");
      document.getElementById('notimage').classList.add("hidden");
      // Thumbnail Preview
      document.getElementById('file-image').classList.remove("hidden");
      document.getElementById('file-image').src = URL.createObjectURL(file);
    }
    else {
      document.getElementById('file-image').classList.add("hidden");
      document.getElementById('notimage').classList.remove("hidden");
      document.getElementById('start').classList.remove("hidden");
      document.getElementById('response').classList.add("hidden");
      document.getElementById("file-upload-form").reset();
    }
  }

  function setProgressMaxValue(e) {
    var pBar = document.getElementById('file-progress');

    if (e.lengthComputable) {
      pBar.max = e.total;
    }
  }

  function updateFileProgress(e) {
    var pBar = document.getElementById('file-progress');

    if (e.lengthComputable) {
      pBar.value = e.loaded;
    }
  }

  function uploadFile(file) {

    var xhr = new XMLHttpRequest(),
      fileInput = document.getElementById('class-roster-file'),
      pBar = document.getElementById('file-progress'),
      fileSizeLimit = 1024; // In MB
    if (xhr.upload) {
      // Check if file is less than x MB
      if (file.size <= fileSizeLimit * 1024 * 1024) {
        // Progress bar
        pBar.style.display = 'inline';
        xhr.upload.addEventListener('loadstart', setProgressMaxValue, false);
        xhr.upload.addEventListener('progress', updateFileProgress, false);

        // File received / failed
        xhr.onreadystatechange = function(e) {
          if (xhr.readyState == 4) {
            // Everything is good!

            // progress.className = (xhr.status == 200 ? "success" : "failure");
            // document.location.reload(true);
          }
        };

        // Start upload
        xhr.open('POST', document.getElementById('file-upload-form').action, true);
        xhr.setRequestHeader('X-File-Name', file.name);
        xhr.setRequestHeader('X-File-Size', file.size);
        xhr.setRequestHeader('Content-Type', 'multipart/form-data');
        xhr.send(file);
      } else {
        output('Please upload a smaller file (< ' + fileSizeLimit + ' MB).');
      }
    }
  }

  // Check for the various File API support.
  if (window.File && window.FileList && window.FileReader) {
    Init();
  } else {
    document.getElementById('file-drag').style.display = 'none';
  }

});