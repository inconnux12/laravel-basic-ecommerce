<!-- Modal -->
<div class="modal fade " id="ModalLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <form method="POST" action="{{route('login')}}">
                @csrf
                <div class="modal-header">
                    <h3 class="modal-title " id="exampleModalLabel">Login to your account</h3>
                    <button type="button" class="btn " data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="row">
                        <div class="col py-3">
                            <label for="username" class="text-muted py-3">Enter your Username</label>
                            <input type="text" name="username" placeholder="ex : usename" class="form-control form-control-lg @error('username') is-invalid @enderror">
                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col py-3">
                            <label for="psw" class="text-muted py-3">Enter your password</label>
                            <input type="password" name="password" placeholder="******" class="form-control form-control-lg {{ $errors->has('password') ? ' is-invalid' : '' }}">
                            @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 ">
                            <input type="checkbox" name="remember_me">
                            Remember Me
                        </div>
                        <div class="col-6">
                            <a href="">Forgot your password?</a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>

            </form>
        </div>
    </div>
</div>