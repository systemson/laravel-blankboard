@extends('blankboard::layouts.admin')

@section('content')
@include('blankboard::admin.includes.header', ['title' => 'Homepage', 'breadcrumbs' => []])

<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h5 class="m-0">Title</h5>
          </div>
          <div class="card-body">

          </div>
          <div class="card-footer">
          </div>
        </div>
      </div>
      <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection