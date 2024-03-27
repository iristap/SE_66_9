
@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-9">
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
      <p>{{ $message }}</p>
    </div>
    @endif
    <div class="card" >
      <div class="card-header text-white" style="background-color: #378CE7; font-size: 20px;">{{ __('Users Management') }}</div>
              <!-- <div class="pull-left ">
                  <h2>Users Management</h2>
              </div> -->
        <div class="card-body">
            <div class="pull-right ">
              <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
            </div>
            <br>
            <table class="table table-bordered">
              <tr>
                <th>ลำดับ</th>
                <th>ชื่อ</th>
                <th>Email</th>
                <th>Roles</th>
                <th width="280px">Action</th>
              </tr>
              @foreach ($data as $key => $user)
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{ $user->name }} {{ $user->surname}}</td>
                  <td>{{ $user->email }}</td>
                  <td>
                    @foreach($user->roles as $role)
                              <span class="badge badge-secondary">{{ $role->name }}</span>
                          @endforeach
                
                  </td>
                  <td>
                    <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
                    <a class="btn btn-danger" href="#" onclick="confirmDelete('{{ $user->name }} {{ $user->surname }}', '{{ $user->id }}')">Delete</a>
                    <form id="delete-user-{{ $user->id }}" method="POST" action="{{ route('users.destroy', $user->id) }}" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                  </td>
                  
                </tr>
              @endforeach
            </table>
        </div>
      </div>
    </div>
    <div class="d-flex justify-content-center">
      {!! $data->render('pagination::bootstrap-4') !!}
    </div>
  </div>
</div>
@endsection

<script>
  function confirmDelete(name, id) {
      Swal.fire({
          title: 'คุณแน่ใจหรือไม่?',
          text: 'คุณต้องการลบผู้ใช้ ' + name + ' ใช่หรือไม่?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'ลบข้อมูล',
          cancelButtonText: 'ยกเลิก'
      }).then((result) => {
          if (result.isConfirmed) {
              document.getElementById('delete-user-' + id).submit();
          }
      });
  }
</script>