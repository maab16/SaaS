<!--
|--------------------------------------------------------------------------
| Prohect Name: SaaS App for mulitiple company
| Author Name: Created By Md Abu Ahsan Basir
| Zend Certified PHP Engineer
| Authour link: http://www.zend.com/en/yellow-pages/ZEND030936
|--------------------------------------------------------------------------
|
|
-->
<!DOCTYPE html>
<html>
<head>
	<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery-ui.css') }}">
	<title>Drag and drop your file</title>
	<style>
		.drag_area {
			width: 600px;
			height: 600px;
			border: 2px dashed #ccc;
			color: #ccc;
			line-height: 600px;
			font-size: 32px;
			text-align: center;
			margin: 50px auto;
		}
		.drag_area:hover {
			cursor: pointer;
		}
		.drag_over {
			color: #000;
			border-color: #000;
		}
		.uploaded_file {
			margin: 0px auto;
		}

		/**/
		.droppable-container {
			border: 1px solid #eee;
		}
		.label {
			align-self: center;
			font-size: 18px;
			font-weight: 700;
		}
		.droppable {
			border-left: 1px solid #eee;
			width: 100%;
			min-height: 50px;
			padding: 0px;
		}
		.droppable_hover,
		.ui-droppable-hover {
			background-color: yellow;
		}
		.draggable {
			cursor: move;
			border: 1px solid #eee;
			color: #222;
			background-color: #eee;
			padding: 10px 15px;
			margin-top: 5px;
			margin-bottom: 5px;
		}

		.ui-draggable-dragging {
			z-index: 99999;
			background-color: yellowgreen;
		}

		.data_fields .draggable {
			margin-top: 15px;
			margin-bottom: 15px;
		}
	</style>
</head>
<body>
	
	<div class="container">
		<div class="drag_area">
			Drop File here or click here
		</div>
		<form id="upload_form">
			@csrf
			<input type="file" name="files[]" id="upload" style="display:none"/
			multiple>
		</form>
		<div class="message"></div>
		<div class="row assign_data_filed">
			<div class="col-md-6 assign_data_filed_left"></div>
			<div class="col-md-6 assign_data_filed_right"></div>
			<input type="hidden" name="map_value" id="map_value" value="">
		</div>
		<div class="uploaded_file table-responsive"></div>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
	<script>
	    $(document).ready(function(){
	        $.ajaxSetup({
	            headers: {
	                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            }
	        });
	    });
	</script>
	<script>
		$(document).ready(function(){
			$('.drag_area').on("dragover", function(){
				$(this).addClass("drag_over");
				return false;
			}).on("dragleave", function(){
				$(this).removeClass("drag_over");
				return false;
			}).on("drop", function(e){
				e.preventDefault();
				$(this).removeClass("drag_over");
				var formData = new FormData();
				var input_files = e.originalEvent.dataTransfer.files;

				for(var i=0; i < input_files.length; i++ ) {
					formData.append('files[]', input_files[i]);
				}
				
				uploadFile(formData);
				
			}).on("click", function(e){
				$('#upload').trigger('click');
			});

			$('#upload').on("change", function(){
				var formData = new FormData($('#upload_form')[0]);
				uploadFile(formData);
			});

			$(document).on("dragover",".droppable", function(){
				$(this).addClass('.droppable_hover');
			}).on("dragleave",".droppable", function(){
				$(this).removeClass('.droppable_hover');
			});

			$(document).on("change keyup keydown","#map_name", function(){
				var value = $(this).val();
				console.log(value);
				 $('#map_name').attr('value',value);
			});

			$(document).on("click","#save_fileds", function() {
				var fields = {};
				var map_name = $('#map_name').attr('value');
				console.log(map_name);
				fields['map_name'] = (map_name) ? map_name : null;
				// var formData = new FormData();
				// formData.append('columns', columns);
				$('.column').each(function(index, item){
					var parent = $(item).closest('.droppable-container');
					var label = parent.find('.label').data('label');
					var column = $(item).data('column');
					// columns[column] = label;
					fields[column] = (label) ? label : null;
				});

				console.log(fields);
				
				var action = '/saveMap';
			    $.ajax({
			        url: action,
			        type: 'POST',
			        dataType: 'json',              
			        data : {
			        	'fields' : fields
			        },
			        success: function(result)
			        {
			        	console.log(result);
			            // location.reload();

			            if(result.success == true) {
		            		$(".message").append('<p class="alert alert-success">Map Created Successfully</p>');
		            		$('.message').append('<p>Here is map link <a href="/map/'+result.map_name+'">Click here</a></p>');

		            	}else if(result.errors) {
		                	
		                }
			        },
			        error: function(data)
			        {
			            console.log(data);
			        }
			    });
			});
		});

		function uploadFile(formData , action = '/importData') {
			$.ajax({
				url : action,
				method : 'POST',
				dataType : 'json',
				data : formData,
				contentType : false,
				cache : false,
				processData : false,
				success : function( result ) {
					if(result.success == true) {
						console.log( result );
						// Left Side For Data fields
						$.each(result.labels, function(index, label){
							var droppableContainer = $('<div class="row mb-3 droppable-container"></div>');
							$('<div class="col-md-6 label" data-label="'+label+'">'+label+'</div>').appendTo(droppableContainer);
							$('<div class="col-md-6 droppable"></div>').droppable({
					        	accept: ".draggable",
					        	classes: {
					        	  // "ui-droppable-active": "ui-state-highlight"
					        	},
					        	drop: function( event, ui ) {
					        		ui.draggable.appendTo(this);
					        	}
					        }).appendTo(droppableContainer);

					        $('.assign_data_filed_left').append(droppableContainer);
						});

						// Right Side Column Options
						var sortableDataFields = $('<div class="sortable droppable data_fields"></div>').droppable({
					        	accept: ".draggable",
					        	classes: {
					        	  // "ui-droppable-active": "ui-state-highlight"
					        	},
					        	drop: function( event, ui ) {
					        		ui.draggable.appendTo(this);
					        	}
					        });
						$.each(result.columns, function(key, value){
							$('<div id="'+key+'" class="draggable column" data-column="'+key+'">'+key+'</div>').draggable({
						        	cancel: "a.ui-icon", // clicking an icon won't initiate dragging
						        	revert: "invalid", // when not dropped, the item will revert back to its initial position
						        	containment: "document",
						        	helper: "clone",
						        	cursor: "move",
						        	connectToSortable: ".sortable"
						        }).appendTo(sortableDataFields);
						});
							
						$('.assign_data_filed_right').append(sortableDataFields);

						// Input Options
						var inputContainer = $('<div class="col-12 input_container"></div>');
							inputContainer.append('<label for="map_name">Name new map</label>&nbsp;&nbsp;&nbsp;<input type="text" name="map_name" id="map_name" placeholder="Enter Map name" value="">');

						$('.assign_data_filed').append(inputContainer);

						// Action Btn
						var actionBtn = $('<div class="col-12 action_container"></div>');
						var saveBtn = '<button class="btn btn-md btn-success" id="save_fileds">Save</button> ';
						var cancelBtn = '<button class="btn btn-md btn-warning" id="cancel_fileds">Cancel</button>';
						actionBtn.append(saveBtn);
						actionBtn.append(cancelBtn);
						$('.assign_data_filed').append(actionBtn);

						// Display uploaded file
						$('.uploaded_file').html("");
						var table = $('<table class="table table-bordered table-hover table-striped"></table>');
						var thead = $('<tr></tr>');
						var tbody = $("<tbody></tbody>");
						$.each(result.data, function(index, items){
							var rowHead = items.fields[0];
							thead.append('<th>SL</th>');			
							$.each(rowHead, function(row_index, row_item){
								thead.append('<th>'+row_index.replace("_", " ")+'</th>');
							});

							$.each(items.fields, function(i, item){
								var tr = $('<tr></tr>');
									tr.append('<td>'+(i+1)+'</td>');
								$.each(item, function(table_key, table_value){
									tr.append('<td>'+table_value+'</td>');
								});

								tbody.append(tr);		
							});
						});

						table.append(thead);
						table.append(tbody);

						$('.uploaded_file').html(table);
					}else if(result.error) {
						alert(result.error);
					}
				},
				error : function(error) {
					console.log(error);
				}
			});
		}
	</script>
</body>
</html>