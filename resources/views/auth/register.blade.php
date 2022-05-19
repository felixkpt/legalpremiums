@include('/templates/header')
<div class="col">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 m-4 px-6 py-4 bg-white shadow-md rounded-lg">
            @include('/components/notification')
            <div id="account-chooser" class="w-full md:w-8/12 mx-auto">
                <div><h2 class="text-2xl text-left pb-3">Account register</h2></div>
                <div id="email-auth">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <!-- Name -->
                        <div>
                            <label class="block font-medium text-sm text-gray-700" for="name">
                                Name
                            </label>
                            <input class="form-control" id="name" type="text" name="name" value="{{ old('name') }}" required="required" autofocus="autofocus">
                        </div>
                        <!-- Email Address -->
                        <div class="mt-4">
                            <label class="block font-medium text-sm text-gray-700" for="email">
                                Email
                            </label>
                            <input class="form-control" id="email" type="email" name="email" value="{{ old('email') }}" required="required">
                        </div>
                        <!-- Password -->
                        <div class="mt-4">
                            <label class="block font-medium text-sm text-gray-700" for="password">
                                Password
                            </label>
                            <input class="form-control" id="password" type="password" name="password" required="required" autocomplete="new-password">
                        </div>
                        <!-- Confirm Password -->
                        <div class="mt-4">
                            <label class="block font-medium text-sm text-gray-700" for="password_confirmation">
                                Confirm Password
                            </label>
                            <input class="form-control" id="password_confirmation" type="password" name="password_confirmation" required="required">
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                                Already registered?
                            </a>
                            <button type="submit" class="btn px-2 secondary-btn">
                                Register
                            </button>
                        </div>
                    </form>
                </div>
                <hr class="py-2 mt-4">
                <div class="w-100">
                    <a href="{{ route('google.login') }}" type="button" class="btn px-2 btn-danger text-white w-100">
                        <svg style="width:auto;height:20px" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="google" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488 512"><path fill="currentColor" d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z"></path></svg>
                        Regsiter with Google
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@include('/templates/footer')