@include('/templates/header')
<div class="col">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 m-4 px-6 py-4 bg-white shadow-md rounded-lg">
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
                    <input class="form-control" id="email" type="email" name="email" value="{{ old('email') }}" required="required" autofocus="autofocus">
                </div>
                <div class="flex items-center justify-end mt-4">
                    <button type="submit" class="btn px-2 btn-danger text-white w-100">
                        Email Password Reset Link
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@include('/templates/footer')
