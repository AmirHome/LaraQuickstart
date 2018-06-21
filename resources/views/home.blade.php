@extends('layouts.app')

@section('javascriptExtra')
<script type="text/javascript">
    console.log(Author);
</script>
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                <p> App::getLocale() is   {{ App::getLocale() }}</p>
                <p> trans('general.title') is   {{ trans('general.title') }}</p>
                <p><strong>Installed</strong>
                    <ul>
                        <li>laravel/framework 5.6</li>
                        <li>laraveldaily/quickadmin 4.0</li>
                        <li>barryvdh/laravel-debugbar 3.1</li>
                        <li>Laracasts utilities JavaScript 3.0</li>
                    </ul>
                <p></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
