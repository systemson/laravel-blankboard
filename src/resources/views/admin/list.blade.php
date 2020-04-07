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
                  <a class="btn btn-success" href="{{ $table->getCreateUrl() }}">New</a>
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
                    <th class="text-center" scope="col">{{ $th }}</th>
                  @endforeach
                   @if ($table->getOption('without_actions') != true)
                   <th class="text-center" scope="col">Actions</th>
                   @endif
                </tr>
              </thead>
              <tbody>
                @foreach ($table->getRows() as $row)
                  <tr>
                    @foreach ($table->getTableColumns() as $attr)
                      <td>{!! $row->{$attr} !!}</td>
                    @endforeach

                    <td>
                      @if ($table->getOption('without_actions') != true)
                        @if ($table->isShowable())
                          <a href="{{ $table->getShowUrl() }}" class="btn btn-xs btn-info"> <i class="far fa-eye"></i></a>
                        @endif
                        @if ($table->isEditable())
                          <a href="{{ $table->getEditUrl($row) }}" class="btn btn-xs btn-primary"> <i class="far fa-edit"></i></a>
                        @endif
                        @if ($table->isDeletable())
                          <a class="btn btn-xs btn-danger"  href="#" onclick="event.preventDefault();document.getElementById('delete-form-{{ $row->getKey() }}').submit();">
                            <i class="fas fa-trash"></i>
                            {{ Form::open(['url' => $table->getDeleteUrl($row), 'method' => 'DELETE', 'id' => 'delete-form-' . $row->getKey()]) }}
                            {{ Form::close() }}
                          </a>
                        @endif
                      @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>

          @if ($table->getRows()->isNotEmpty())
          <div class="card-footer">
            {{ $table->getRows()->links() }}
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