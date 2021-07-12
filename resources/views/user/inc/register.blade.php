<div class="modal fade  " id="ModalRegister" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h3 class="modal-title " id="exampleModalLabel1">Create your account</h3>
                <button type="button" class="btn " data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('register') }}" aria-label="{{ __('Register') }}" method="post" id="register_form">
                <div class="modal-body">
                    @csrf
                    <div class="row px-2">
                        <div class="msg"></div>
                    </div>
                    <div class="row py-2">
                        <div class="col-lg-6 col-sm-12 ">
                            <label for="name" class="text-muted">Enter your name :</label>
                            <input id="fname" type="text" name="name" placeholder="ex : Jhon" class="form-control form-control-lg">
                            <div class="msg_fname"></div>
                        </div>
                    
                        <div class="col-lg-6 col-sm-12 ">
                            <label for="username" class="text-muted">Enter your username</label>
                            <input id="username" type="text" name="username" placeholder="ex : Doe" class="form-control form-control-lg">
                            <div class="msg_username"></div>
                        </div>
                    </div>
                    <div class="row py-2">
                        <div class="col ">
                            <label for="email" class="text-muted">Enter your e-mail</label>
                            <input id="email" type="email" name="email" placeholder="ex : jhondoe@exemple.com." class="form-control form-control-lg">
                            <div class="msg_email"></div>
                        </div>
                    </div>
                    <div class="row py-2">
                        <div class="col-lg-6 col-sm-12">
                            <label for="psw" class="text-muted">Enter a password</label>
                            <input id="psw" type="password" name="password" placeholder="****" class="form-control form-control-lg">
                            <div class="msg_psw"></div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <label for="psw" class="text-muted">Retape your passeword</label>
                            <input id="psw1" type="password" name="password_confirmation" placeholder="****" class="form-control form-control-lg">
                            <div class="msg_psw1"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col py-2 ">
                            <input type="checkbox" name="remember_me">
                            Remember Me
                        </div>

                    </div>
                    
        </div>
        <div class="modal-footer ">
            <div class="row  justify-content-around">
                <div class="col-lg-2 col-sm-6">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                <div class="col-lg-2 col-sm-6 me-4">
                    <button type="submit" class="btn btn-primary" value="submit">Submit</button>
                </div>
            </div>
        </div>
    </form>
    </div>
</div>
</div>