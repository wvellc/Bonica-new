@php
$imagePath  =  'uploads/admin/' . $row->id . '/thumbnail/' . $row->profile_image;
@endphp
<img src="{{ asset($imagePath) }}" alt="Admin Image 1" onerror="this.onerror=null;this.src='{{ asset('favicons/apple-icon-76x76.png') }}'">
