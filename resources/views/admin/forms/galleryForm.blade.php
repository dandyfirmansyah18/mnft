@extends('admin.index')

@section('content')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gallery</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Gallery</h3>
                        </div>
                        <div class="card-body">
                            <form method="{{ $method }}" action="{{ $url }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" class="form-control" id="image" name="image"  placeholder="Enter name">
                                    <p><em style="font-size:13px;">*recomended image dimension 100px : 100px</em></p>
                                    @if(isset($gallery->image) && $gallery->image)
                                        <p style="font-size: 11px;font-style: italic;">leave blank if you do not wish to change the logo</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="desc">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ $gallery->title ?? '' }}" placeholder="Enter Description">
                                </div>
                                <div class="form-group">
                                    <span class='d-block'>Status</span>
                                    <input type="radio" id="active" name="status" value="1" {{ (isset($gallery->status) && $gallery->status == 1) ? 'checked' : ''  }}>
                                    <label for="active">Active</label><br>
                                    <input type="radio" id="inactive" name="status" value="0" {{ (isset($gallery->status) && $gallery->status == 0) ? 'checked' : ''  }}>
                                    <label for="inactive">Inactive</label><br>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info">Save</button>
                                    <a href={{ url('/galleries') }} class="btn btn-warning">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection