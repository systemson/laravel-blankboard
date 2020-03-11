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
            <h5 class="card-title">Title</h5>
            <div class="card-tools">
              <ul class="nav nav-pills ml-auto">
                <li class="nav-item">
                  {!! $resources->create !!}
                </li>
              </ul>
            </div>
          </div>
          <div class="card-body">
            <table class="table table-bordered table-striped table-hover table-sm">
              <thead class="bg-primary">
                <tr>
                  @foreach ($resources->headers as $th)
                    <th class="text-center" scope="col">{{ __('table.' . $th) }}</th>
                  @endforeach
                </tr>
              </thead>
              <tbody>
                @foreach ($resources as $resource)
                <tr>
                  @foreach ($resources->headers as $th)
                    <td>{!! $resource->{$th} !!}</td>
                  @endforeach
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          @if ($resources->isNotEmpty ())
          <div class="card-footer">
            {{ $resources->links() }}
          </div>
          @endif
        </div>
      </div>
      <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection