        @inject('comp_model', 'App\Models\ComponentsData')
        <?php 
            $pageTitle = "XSCOUTS";
        ?>
        @extends($layout)
        @section('title', $pageTitle)
        @section('content')
        <div>
            <div  class="mb-3">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col col-sm-6 col-md-4 comp-grid">
                            <div  class="h3 h4 text-primary my-5 p-3 h4 text-primary my-5 p-3 h4 text-primary my-5 p-3 page-content">
                                <div>
                                    <h4><i class="material-icons">lock_open</i> User Login</h4>
                                    <hr />
                                    @if($errors->any())
                                    <div class="alert alert-danger animated bounce">{{ $errors->first() }}</div>
                                    @endif
                                    <form name="loginForm" action="{{ route('auth.login') }}" class="needs-validation form page-form" method="post">
                                        @csrf
                                        <div class="input-group form-group">
                                            <input placeholder="Email" name="username"  required="required" class="form-control" type="text"  />
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="form-control-feedback material-icons">account_circle</i></span>
                                            </div>
                                        </div>
                                        <div class="input-group form-group">
                                            <input  placeholder="Password" required="required" v-model="user.password" name="password" class="form-control " type="password" />
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="form-control-feedback material-icons">lock</i></span>
                                            </div>
                                        </div>
                                        <div class="row clearfix mt-3 mb-3">
                                            <div class="col-6">
                                                <label class="">
                                                <input value="true" type="checkbox" name="rememberme" />
                                                Remember Me
                                                </label>
                                            </div>
                                            <div class="col-6">
                                                <a href="{{ route('password.forgotpassword') }}" class="text-danger"> Reset Password?</a>
                                            </div>
                                        </div>
                                        <div class="form-group text-center">
                                            <button class="btn btn-primary btn-block btn-md" type="submit"> 
                                            <i class="load-indicator">
                                            <clip-loader :loading="loading" color="#fff" size="20px"></clip-loader> 
                                            </i>
                                            Login <i class="material-icons">lock_open</i>
                                            </button>
                                        </div>
                                        <hr />
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection
        @section('pagecss')
        <style scoped></style>
        @endsection
        @section('pagejs')
        <script>
            $(document).ready(function(){
            });
        </script>
        @endsection
        