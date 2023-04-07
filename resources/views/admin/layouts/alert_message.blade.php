@if (\Session::has('error') || \Session::has('success') || $errors)
    <div class="row" id="alert-hide">
        <div class="col-md-12">
            {{--  @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="list-unstyled">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif  --}}
            @if (\Session::has('error'))
                <div class="alert alert-danger">
                    <ul class="list-unstyled">
                        <li>{!! \Session::get('error') !!}</li>
                    </ul>
                </div>
            @endif
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <ul class="list-unstyled">
                        <li>{!! \Session::get('success') !!}</li>
                    </ul>
                </div>
            @endif
        </div>
    </div>
@endif
