@extends('admin.index')

@section('content')
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Data</h1>
          </div>
        </div>
      </div>
    </section>


    <section class="content mt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Add Content</h3>
                        </div>
                        <div class="card-body" id='form-container'>
                            <form method="{{ $method }}" action="{{ $url }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for='menuId'>Select Menu</label>
                                    <select class="form-control" name="menu">
                                        @foreach($menu as $menus)
                                            <option value="{{ $menus->id }}" {{ (isset($menu->parent_id) && $menu->parent_id == $menus->id) ? 'selected' : ''  }} >{{ $menus->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" class="form-control" id="image" name="image" placeholder="Enter Image">
                                    @if(isset($banner->image) && $banner->image)
                                        <p style="font-size: 11px;font-style: italic;">leave blank if you do not wish to change the logo</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea type="text" class="form-control" id="description" name="description" placeholder="Enter Description" cols="50" rows="10"></textarea>
                                </div>
                                <div id='galleryContainer'>
                                    <div class="form-group">
                                        <button class='btn btn-info' type="button" id="btnAddGallery">Add Gallery</button>
                                    </div>
                                </div>  
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<script src="{{ asset('assets/js/index.js') }}"></script>