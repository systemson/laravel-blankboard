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
            @if ($table->isCreateble())
            <div class="card-tools">
              <ul class="nav nav-pills ml-auto">
                <li class="nav-item">
                  {!! $table->getCreateButton() !!}
                </li>
              </ul>
            </div>
            @endif
          </div>
          <div class="card-body">
            <table class="table table-bordered table-striped table-hover table-sm">
              <thead class="bg-primary">
                <tr>
                  @foreach ($table->getTableHeaders() as $th)
                    <th class="text-center" scope="col">{{ __('table.' . $th) }}</th>
                  @endforeach
                </tr>
              </thead>
              <tbody>
                @foreach ($table as $row)
                <tr>
                  @foreach ($table->getTableHeaders() as $th)
                    <td>{!! $row->{$th} !!}</td>
                  @endforeach
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          @if ($table->isNotEmpty ())
          <div class="card-footer">
            {{ $table->links() }}
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