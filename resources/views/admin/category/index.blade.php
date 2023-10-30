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

                {{ Breadcrumbs::render("category".$page_title) }}
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
                        <div class="row">
                            <div class="form-group col-md-4">
								<div class="select-box">
                              <select class="form-control" name="parent_category" id="parent_category">
                                <option value="">Select Parent Category</option>
                                    @foreach ($parent_category as $id => $value)
                                        <option value="{{ $id }}">{{ $value }}</option>
                                    @endforeach
                                </select>
								</div>
                            </div>
                            <div class="form-group col-md-8">
                                <button type="button" id="btn-reset" class="btn btn-info bg-gradient-info">Reset</button>
								<small class="float-sm-right"><a class="btn btn-info bg-gradient-info" href="{{ route("admin.category.create") }}">
									Add {{$module}}
								</a></small>
                            </div>
                        </div>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
                        <table id="tbl_datatable" class="table table-responsive table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Is Parent</th>
                                    <th>Status</th>
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
            responsive: true,
            ajax: {
                "url": "{!! route('admin.category.index') !!}",
                "data": function ( data )
                {
                    data.search_parent_category  = $("#parent_category").val();
                }
            },
			deferRender: true,
			lengthMenu: [
                [25, 50, 100, 150, 200, 500],
                [25, 50, 100, 150, 200, 500]
			],
			order: [
			    ["0", "DESC"]
			],
			columns: [
                { data: 'id', name: 'id', orderable: true, searchable: false },
                { data: 'image', name: 'image', orderable: false, searchable: false },
                { data: 'name', name: 'name', orderable: true, searchable: true },
                { data: 'is_parent', name: 'parent.is_parent', orderable: false, searchable: false },
                { data: 'status', name: 'status', orderable: false, searchable: false },
                { data: 'action', orderable: false, searchable: false }
			],
			"fnDrawCallback": function() {
				jQuery('.toggle-demo').bootstrapToggle();
			}
		});
        $('#parent_category').on('change', function() {
            myTable.ajax.reload();
        });
        $( "#btn-reset" ).on( "click", function() {
          $('#parent_category').val('');
          $('#tbl_datatable').dataTable().fnDraw();
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
							/* swal({
								title: "Deleted",
								text: response.message,
								type: "success",
							}); */
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
        function statusChange(id) {
            $.ajax({
                url: '{!! route("admin.category.statusupdate") !!}',
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                success: function(result) {

                    if(result.msg != ""){

                         msg_HTML = `<div class="col-xs-12 flashmessages">
                                        <div class="alert alert-success" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                <strong>${result.msg}</strong>
                                            </div>
                                        </div>`;
                            $('#alert_msg').html(msg_HTML);
                        }
                },
            });
        }
        function reloadDatatable(){
            myTable.ajax.reload();
            return true;
        }

</script>
@endpush
