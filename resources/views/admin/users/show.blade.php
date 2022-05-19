@include('/admin/templates/header')    
<div class="flex flex-col px-3">

<div class="flex w-full">
    <div class="w-full margin-tb">
        <div class="w-full">
            <h2> Show User</h2>
        </div>
        <div class="w-full">
            <a class="btn btn-primary" href="{{ route('admin.users.index') }}"> Back</a>
        </div>
    </div>
</div>


<div class="flex w-full">
    <div class="w-full">
        <div class="form-group">
            <strong>Name:</strong>
            {{ $user->name }}
        </div>
    </div>
    <div class="w-full">
        <div class="form-group">
            <strong>Email:</strong>
            {{ $user->email }}
        </div>
    </div>
    <div class="w-full">
        <div class="form-group">
            <strong>Roles:</strong>
            @if(!empty($user->getRoleNames()))
                @foreach($user->getRoleNames() as $v)
                    <label class="badge badge-success">{{ $v }}</label>
                @endforeach
            @endif
        </div>
    </div>
</div>

</div>
@include('/admin/templates/footer')