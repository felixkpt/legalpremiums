@include('/admin/templates/header')
<div class="flex flex-col px-3">

<div class="flex w-full">
    <div class="flex w-full justify-between">
        <div class="flex w-1/2">
            <h2 class="text-2xl">Users Management</h2>
        </div>
        <div class="flex justify-end w-1/2">
            <a class="bg-purple-500 hover:bg-purple-700 text-white p-2 my-2 rounded-lg font-medium" href="{{ route('admin.users.create') }}"> Create New User</a>
        </div>
    </div>
</div>

<div class="flex flex-col justify-center items-center">
  <table class="table-fixed w-full lg:w-10/12 bg-white rounded shadow-sm divide-y divide-gray-200 table-auto">
    <thead class="bg-gray-50">
        <tr>
            <th scope="col" class="px-2 py-2 lg:px-6 lg:py-4 text-left tex-xs font-medium text-gray-500 upercase tracking-wider">Name</th>
            <th scope="col" class="px-2 py-2 lg:px-6 lg:py-4 text-left tex-xs font-medium text-gray-500 upercase tracking-wider">Status</th>
            <th scope="col" class="px-2 py-2 lg:px-6 lg:py-4 text-left tex-xs font-medium text-gray-500 upercase tracking-wider">Role</th>
        </tr>
    </thead>
    @foreach ($users as $key => $user)
    <tr>
      <td class="px-2 py-2 lg:px-6 lg:py-4 truncate">
          <div class="flex flex-col">
              <div class="text-sm font-medium text-gray-600" title="Name">
                  <a class="text-indigo-600 hover:text-indigo-900" href="{{ route('admin.users.show',$user->id) }}">{{ $user->name }}</a>
              </div>
              <div class="flex-shrink-0 h-10 w-10">
              <a class="block w-full" href="{{ route('admin.users.show',$user->id) }}">
                <img class="h-10 w-10 rounded-full" src="{{ asset($user->avatar ?? 'uploads/images/users/default.jpg') }}" alt="">
              </a>
              </div>
              <div class="text-sm text-gray-600" title="Email">{{ $user->email }}</div>
          </div>
      </td>
      <td class="px-2 py-2 lg:px-6 lg:py-4 truncate">
          <span class="px-2 inline-flex text-xs loading-5 font-semi-bold rounded-full bg-green-100 text-green-800 py-1">Active</span>
      </td>
      <td class="px-2 py-2 lg:px-6 lg:py-4 truncate text-xs font-medium text-gray-500">
          <div class="flex flex-col md:flex-row md:justify-between w-full">
              <div class="flex p-1">
              @if(count($user->getRoleNames()))
                @foreach($items = $user->getRoleNames() as $item) 
                <span class="text-gray-500">{{ $item }}</span>@if(isset($items[$loop->index+1])), @endif
                @endforeach
              @else
                Subscriber
              @endif
              </div>
              <div class="flex p-1">
                  <a class="p-1 text-indigo-600 hover:text-indigo-900" href="{{ route('admin.users.edit',$user->id) }}">
                    Edit
                  </a>
                  {!! Form::open(['method' => 'DELETE','route' => ['admin.users.destroy', $user->id],'style'=>'display:inline']) !!}
                      {!! Form::submit('Delete', ['class' => 'p-1 text-red-500 hover:text-red-700 cursor-pointer']) !!}
                  {!! Form::close() !!}
              </div>
          </div>
      </td>
    </tr>
  @endforeach
  @if(count($users) < 1)
                <tr>
                    <td colspan="3">
                        <div class="p-4 bg-gray-100 text-xl sm:text-3xl flex flex-col md:flex-row items-baseline">
                        <span class="flex p-1">No users yet!</span>
                        </div>
                    </td>
                </tr>
                @endif
  </table>
  <?php $items = $users; ?>
  @include('/admin/components/pagination')
</div>

</div>
@include('/admin/templates/footer')