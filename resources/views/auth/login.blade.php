@include('/templates/header')
<div class="w-full">
    <div class="flex flex-wrap justify-center">
        <div class="w-full md:w-6/12 m-4 px-6 py-4 bg-white shadow-md rounded-lg">
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
                            <input class="w-full" id="email" type="email" name="email" value="{{ old('email') }}" required="required" autofocus="autofocus">
                        </div>
                        <!-- Password -->
                        <div class="mt-4">
                            <label class="block font-medium text-sm text-gray-700" for="password">
                                Password
                            </label>
                            <input class="w-full" id="password" type="password" name="password" required="required" autocomplete="current-password">
                        </div>
                        <!-- Remember Me -->
                        <div class="block mt-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                                <span class="ml-2 text-sm text-gray-600">Remember me</span>
                            </label>
                        </div>
                        <div class="flex items-center justify-center w-full mt-4">
                            <button type="submit" class="w-full text-white bg-[#2c323dc2] hover:bg-[#6b7280fc]/90 focus:ring-4 focus:outline-none focus:ring-[#696969]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#6b7280d1]/55 mr-2 mb-2">
                                Login with Email
                            </button>
                        </div>
                        <div class="flex items-center justify-center mt-4">
                            @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif                        
                        </div>
                    </form>
                </div>
                <hr class="py-2 mt-4">
                <div class="w-full">
                    <a href="{{ url('google.login') }}" type="button" class="w-full text-white bg-[#4285F4] hover:bg-[#4285F4]/90 focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#4285F4]/55 mr-2 mb-2">
                        <svg class="w-4 h-4 mr-2 -ml-1" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="google" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488 512"><path fill="currentColor" d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z"></path></svg>
                        Login with Google
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@include('/templates/footer')
