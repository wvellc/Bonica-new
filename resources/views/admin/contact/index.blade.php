@extends('admin.layouts.layout')
@push('css')
<!-- DataTables -->
{{ Html::style("admin_theme/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css") }}
{{ Html::style("admin_theme/plugins/datatables-responsive/css/responsive.bootstrap4.min.css") }}
{{ Html::style("admin_theme/plugins/datatables-buttons/css/buttons.bootstrap4.min.css") }}
<!-- SweetAlert2 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
@endpush
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">{{$module}}</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">

                {{ Breadcrumbs::render("contact".$page_title) }}
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content">
	<div class="container-fluid">
		@include('admin.layouts.alert_message')
		<!-- Small boxes (Stat box) -->
        <div id="alert_msg"></div>
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">{{$page_title}}</h3>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
                        <table id="tbl_datatable" class="table table-responsive table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
					</div>
					<!-- /.card-body -->
				</div>
				<!-- /.card -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</div><!-- /.container-fluid -->

    <!-- /.content -->
<div class="modal fade" id="modal-contact-view">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="modal-title">Contact Info</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="content_view">

			<div class="card-body">
				<div class="row">
					<div class="col-12 col-sm-6">
						<div class="form-group">
							<label for="name">Name</label>
							{{ Form::text('name','', ['class' => 'form-control', 'placeholder' => 'Name', 'id' => 'name','readonly' => 'true']) }}
						</div>
					</div>
					<div class="col-12 col-sm-6">
						<div class="form-group">
							<label for="email">Email</label>
							{{ Form::text('email','', ['class' => 'form-control', 'placeholder' => 'Email', 'id' => 'email','readonly' => 'true']) }}
						</div>
					</div>
					<div class="col-12 col-sm-6">
						<div class="form-group">
							<label for="mobile">mobile</label>
							{{ Form::text('mobile','', ['class' => 'form-control', 'placeholder' => 'Email', 'id' => 'mobile','readonly' => 'true']) }}
						</div>
					</div>
					<div class="col-12 col-sm-12">
						<div class="form-group">
							<label for="message">Message</label>
							{{ Form::text('message','', ['class' => 'form-control', 'placeholder' => 'Message', 'id' => 'message','readonly' => 'true']) }}
						</div>
					</div>
					
				</div>
				<!-- /.row -->
			</div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
</section>
@endsection
@push('js')
<!-- DataTables  & Plugins -->
{{ Html::script("admin_theme/plugins/datatables/jquery.dataTables.min.js") }}
{{ Html::script("admin_theme/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js") }}
{{ Html::script("admin_theme/plugins/datatables-responsive/js/dataTables.responsive.min.js") }}
{{ Html::script("admin_theme/plugins/datatables-responsive/js/responsive.bootstrap4.min.js") }}
{{ Html::script("admin_theme/plugins/datatables-buttons/js/dataTables.buttons.min.js") }}
{{ Html::script("admin_theme/plugins/datatables-buttons/js/buttons.bootstrap4.min.js") }}
{{ Html::script("admin_theme/plugins/jszip/jszip.min.js") }}
{{ Html::script("admin_theme/plugins/pdfmake/pdfmake.min.js") }}
{{ Html::script("admin_theme/plugins/pdfmake/vfs_fonts.js") }}
{{ Html::script("admin_theme/plugins/datatables-buttons/js/buttons.html5.min.js") }}
{{ Html::script("admin_theme/plugins/datatables-buttons/js/buttons.print.min.js") }}
{{ Html::script("admin_theme/plugins/datatables-buttons/js/buttons.colVis.min.js") }}

<!-- SweetAlert2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script>

		var myTable =  $('#tbl_datatable').DataTable({
			processing: true,
			serverSide: true,
			searching: true,
			ajax: "{!! route('admin.contact.index') !!}",
			deferRender: true,
			lengthMenu: [
                [25, 50, 100, 150, 200, 500],
                [25, 50, 100, 150, 200, 500]
			],
			order: [
			    ["0", "DESC"]
			],
			columns: [
                { data: 'id', name: 'id', orderable: true, searchable: true },
                { data: 'name', name: 'name', orderable: false, searchable: false },
                { data: 'email', name: 'email', orderable: true, searchable: true },
                { data: 'mobile', name: 'mobile', orderable: false, searchable: true },
                { data: 'action', orderable: false, searchable: false }
			],
			"fnDrawCallback": function() {
				jQuery('.toggle-demo').bootstrapToggle();
			}
		});
        myTable.column(0).visible(false);

		$("body").on("click",".remove-action",function(e){
			e.preventDefault();
			var id  = $(this).data('id');
			var url = $(this).data('url');
			var current_object = $(this);
			swal({
				title: "Are you sure?",
				text: "Once deleted, you will not be able to recover this record!",
				type: "warning",
				showCancelButton: true,
				dangerMode: true,
				cancelButtonClass: '#dcccbd',
				confirmButtonColor: '#40485b',
				confirmButtonText: 'Delete',
			},function () {
				$.ajax({
					type: "DELETE",
					url: url,
					headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					dataType: 'JSON',
					success: function (response) {
						if (response.code == 200) {
							myTable.ajax.reload();
							swal({
								title: "Deleted",
								text: response.message,
								type: "success",
							});
						} else {
							swal({
								title: "Deleted",
								text: response.message,
								type: "error",
							});
						}
					}
				});
			});
		});


        function reloadDatatable(){
            myTable.ajax.reload();
            return true;
        }
        function showContent(id){
            $.ajax({
            type: "GET",
            url: '{!! route("admin.content") !!}',
            data: {
                id:id
            },
            dataType: 'JSON',
            beforeSend: function() {

            },
            success: function (response) {
				
                if(response.data.name != ""){
                    $('#name').val(response.data.name);
					$('#email').val(response.data.email);
					$('#mobile').val(response.data.mobile);
					$('#message').val(response.data.message);
                }
                else{
					
                    //$('#content_view').html('No Message Available');
                }
            }
            });
            $('#modal-contact-view').modal('show');
        }
</script>
@endpush
