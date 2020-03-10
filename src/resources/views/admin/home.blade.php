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
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vestibulum odio diam, ac gravida magna semper ut. Vestibulum at imperdiet enim, sit amet ornare metus. In faucibus, nunc vel blandit volutpat, felis libero vulputate arcu, eget gravida nulla sem nec dolor. Integer dictum auctor nibh, in fringilla nibh. Integer venenatis elementum felis ut malesuada. Duis mollis mauris sed eros tincidunt, in fermentum lorem iaculis. Pellentesque elementum mauris sapien, a venenatis lacus cursus eget. Pellentesque et massa quis nulla egestas tincidunt. Duis ullamcorper tellus eros, a fringilla odio commodo sit amet. Nam venenatis purus nunc. Suspendisse potenti. Donec consectetur urna a egestas molestie.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
          </div>
          <div class="card-footer">
            Footer
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