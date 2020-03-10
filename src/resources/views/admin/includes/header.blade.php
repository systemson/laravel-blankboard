<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">{{ $title }}</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          @forelse ($breadcrumbs as $word)
          <li class="breadcrumb-item"><a href="#">{{ $word }}</a></li>
          @empty
          <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
          @endforelse
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
    <!-- /.content-header -->