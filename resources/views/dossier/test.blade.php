@extends('layouts.app')
@section('content')
<body>
 
<div class="container mt-4">
 
  <h2 class="text-center">File Upload in Laravel 8 - Tutsmake.com</h2>
 
      <form method="POST" enctype="multipart/form-data" id="upload-file" action="{{ url('test_post') }}" >
          @csrf
          <div class="row">
 
              <div class="col-md-12">
                  <div class="form-group">
                      <input type="file" name="file" placeholder="Choose file" id="file">
                        @error('file')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                  </div>
              </div>
                 
              <div class="col-md-12">
                  <button type="submit" class="btn btn-primary" id="submit">Submit</button>
              </div>
          </div>     
      </form>
</div>
 
</div>  
</body>


 

@endsection