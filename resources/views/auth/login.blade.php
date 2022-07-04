@include('/templates/header')
<div class="flex flex-col w-full my-2">
    <div class="flex justify-center p-3">
        <div class="w-10/12 sm:w-8/12 md:w-7/12 lg:w-5/12 bg-white shadow-md rounded m-4 p-2">
            @include('/components/notification')
            <div class="flex w-full">
                <div id="account-chooser" class="w-full md:w-8/12 mx-auto">
                    <div>
                        <h2 class="text-center pb-3">Account login</h2>
                    </div>
                    <div id="email-auth">
                        <form method="POST" action="{{ url('login/email') }}">
                            @csrf
                            <!-- Email Address -->
                            <div class="mb-4">
                                <input class="w-full" id="email" type="email" name="email" value="{{ old('email') }}" required="required" autofocus="autofocus" placeholder="Username or Email">
                            </div>
                            <div class="mb-5">
                                <button type="submit" class="btn btn-success">
                                    Login with Email
                                </button>
                            </div>
                        </form>
                        <div class="mb-5">
                            <div class="h-divider">
                                <div class="h-inner">
                                    <span class="h-content">or</span>
                                </div>
                            </div>
                        </div>
                        <div class="mb-5">
                            <div class="w-full">
                                <a href="{{ route('google.login') }}" type="button" class="w-full text-white bg-[#4285F4] hover:bg-[#4285F4]/90 focus:ring-2 ring-offset-2 focus:outline-none focus:ring-[#4285F4]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#4285F4]/55 mr-2 mb-2">
                                    <svg class="w-4 h-4 mr-2 -ml-1" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="google" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488 512">
                                        <path fill="currentColor" d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z"></path>
                                    </svg>
                                    Login with Google
                                </a>
                            </div>
                        </div>
                        <div class="mb-5">
                            <div class="h-divider">
                                <div class="h-inner">
                                    <span class="h-content">Don't have an account?</span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <a href="{{ route('register') }}" class="btn btn-outline-success block">Sign up</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('/templates/footer')