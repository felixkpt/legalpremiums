@include('/templates/header')
<div class="col">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 m-4 px-6 py-4 bg-white shadow-md rounded-lg">
            @include('/components/notification')
            <div id="account-chooser" class="mx-auto">
                <div><h2 class="text-2xl text-left pb-3">Account login</h2></div>
                <div id="email-auth">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <!-- Email Address -->
                        <div>
                            <label class="block font-medium text-sm text-gray-700" for="email">
                                Email
                            </label>
                            <input class="form-control" id="email" type="email" name="email" value="{{ old('email') }}" required="required" autofocus="autofocus">
                        </div>
                        <!-- Password -->
                        <div class="mt-4">
                            <label class="block font-medium text-sm text-gray-700" for="password">
                                Password
                            </label>
                            <input class="form-control" id="password" type="password" name="password" required="required" autocomplete="current-password">
                        </div>
                        <!-- Remember Me -->
                        <div class="d-flex justify-content-between mt-4">
                            <div class="">
                                <label for="remember_me" class="inline-flex items-center">
                                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                </label>
                            </div>
                            <div class="">
                                <button type="submit" class="btn px-2 secondary-btn">
                                    Login with Email
                                </button>
                            </div>
                            
                        </div>
                        <div class="d-flex items-center justify-center mt-4">
                            @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif                        
                        </div>
                    </form>
                </div>
                <hr class="py-2 mt-4">
                <div class="w-100">
                    <a href="{{ route('google.login') }}" type="button" class="btn px-2 btn-danger text-white w-100">
                        <svg style="width:auto;height:20px" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="google" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488 512"><path fill="currentColor" d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z"></path></svg>
                        Login with Google
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@include('/templates/footer')
