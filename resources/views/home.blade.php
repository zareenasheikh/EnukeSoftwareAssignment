@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                
                <div class="card-header">{{ Auth::user()->name.' Image Gallery'}}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif



             <div class="row mx-1">
                    <div class="col-md-3 d-flex">
                    <b>Name</b><b class="mx-2">:</b>
                    <p>{{ Auth::user()->name }}</p>
                </div>
                <div class="col-md-3 d-flex">

                    <b>Email</b><b class="mx-2">:</b>
                    <p>{{ Auth::user()->email }}</p>
                </div>
                
                
            </div>



                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Image</th>
                      </tr>
                  </thead>
                  <tbody>
                   @if(!empty($records))
                   @foreach($records as $index => $data)
                   <tr>
                    <th scope="row">{{ $index+1 }}</th>
                    <td>
                    @if(!empty($data->image))
                    <img src="{{url('public/images/'.$data->image)}}" width="80px" height="50px">
                    @endif
              </td>
              </tr>
              @endforeach
              @endif

          </tbody>
      </table>                </div>
  </div>
</div>
</div>
</div>
@endsection
