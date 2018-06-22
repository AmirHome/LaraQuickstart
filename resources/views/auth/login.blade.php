@include('admin.partials.header')
<div style="margin-top: 10%;"></div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ __('Login') }}</div>
                <div class="panel-body">

                    <div class="col-md-offset-3">
                        <img style="vertical-align:middle" alt="City Map Logo" height="180px" src="{{url('resources/assets')}}/images/logologin.gif" >
                        <strong>{{ config('app.name', 'AmirHome') }}</strong>
                    </div>
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            {{ trans('auth.some_problems_with_input') }}
                            <br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="form-horizontal"
                          role="form"
                          method="POST"
                          action="{{ url('login') }}">
                        <input type="hidden"
                               name="_token"
                               value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input type="email"
                                       class="form-control"
                                       name="email"
                                       value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input type="password"
                                       class="form-control"
                                       name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <label>
                                    <input type="checkbox"
                                           name="remember">&nbsp;&nbsp;{{ __('Remember Me') }}
                                </label>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="forget" href="password/reset" >{{ __('Forgot Your Password?') }}</a>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-8">
                                <button type="submit"
                                        class="btn btn-success"
                                        style="margin-right: 15px;">
                                    {{ __('Login') }}
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="panel-footer">
                <div><div class=row><div class="col-md-6 col-md-offset-3 text-centerx"><small>Copyright © 2018 <a target=_blank href=http://smartme.com.tr>Smartme</a> All rights reserved. </small></div><div class="col-md-3 version"> <span class=inner><small> Version : {{ session('version') }}</small> </span></div></div></div></div>
            </div>

        </div>
    </div>
</div>

@include('admin.partials.footer')
