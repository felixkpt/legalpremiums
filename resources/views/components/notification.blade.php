@if(!isset($hide_notification) && $errors->any())
@foreach ($errors->all() as $error)
    <div class="alert alert-danger" role="alert">
        <strong class="font-bold">Alert!</strong>
        <span class="block sm:inline">{{ $error }}</span>
    </div>
@endforeach
@endif
@if (session()->has('info'))
<div class="alert alert-info" role="alert">
<strong class="font-bold">Status:</strong>
<span class="block sm:inline">{{ session('info') }}</span>
</div>
@endif
@if (session()->has('success'))
<div id="toast-success" class="alert alert-success" role="alert">
<strong class="font-bold">Success:</strong>
<span class="block sm:inline">{{ session('success') }}</span>
</div>
@elseif (session()->has('warning'))
<div id="toast-warning" class="alert alert-warning" role="alert">
<strong class="font-bold">Warning:</strong>
<span class="block sm:inline">{{ session('warning') }}</span>
</div>
@elseif (session()->has('danger'))
<div id="toast-danger" class="alert alert-danger" role="alert">
<strong class="font-bold">Error:</strong>
<span class="block sm:inline">{{ session('danger') }}</span>
</div>
@endif
