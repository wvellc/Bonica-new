@php
$checked = "";
if($row->status == 1){
$checked = "checked";
}
@endphp
<input type="checkbox" {{ $checked }} data-toggle="toggle" data-on="Unblock" data-off="Block" onchange="statusChange('{{ $row->id }}')" data-onstyle="success" data-offstyle="danger" class="toggle-demo" id="toggle-demo">
