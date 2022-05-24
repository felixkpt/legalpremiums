@include('/templates/header')
<div class="w-full">
    <div class="flex flex-wrap justify-center">
        <div class="w-full md:w-6/12 m-4 px-6 py-4 bg-white shadow-md rounded-lg">
            <div><h2 class="text-2xl text-left pb-3">Forgot Password</h2></div>
            @include('/components/notification')

            <div class="mb-4 text-sm text-gray-600">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <!-- Email Address -->
                <div>
                    <label class="block font-medium text-sm text-gray-700" for="email">
                        Email
                    </label>
                    <input class="w-full" id="email" type="email" name="email" value="{{ old('email') }}" required="required" autofocus="autofocus">
                </div>
                <div class="flex items-center justify-end mt-4">
                    <button type="submit" class="w-full text-white bg-[#2c323dc2] hover:bg-[#6b7280fc]/90 focus:ring-4 focus:outline-none focus:ring-[#696969]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#6b7280d1]/55 mb-2">
                        Email Password Reset Link
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@include('/templates/footer')
