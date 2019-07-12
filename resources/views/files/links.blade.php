<div class="card primary">
    <div class="card-header">
        <ul class="nav nav-tabs primary" id="myTab7" role="tablist">
            <li class="nav-item">
                <a class="nav-link {{ $key == 'all' ? "active" : "" }}" id="get_types"
                    href="{{ URL::to('list/uploads') }}" role="tab" aria-controls="home7" aria-selected="false"><i
                        class="icon-home2 block"></i>All Files</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $key == 'images' ? "active" : "" }}" id="get_types"
                    href="{{ URL::to('sort_by_types/images') }}" role="tab" aria-controls="home7"
                    aria-selected="false"><i class="icon-image block"></i>Images</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $key == 'videos' ? "active" : "" }}" id="get_types"
                    href="{{ URL::to('sort_by_types/vides') }}" role="tab" aria-controls="contact7"
                    aria-selected="false"><i class="icon-folder-video block"></i>Videos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $key == 'audios' ? "active" : "" }}" id="get_types"
                    href="{{ URL::to('sort_by_types/audios') }}" role="tab" aria-controls="contact7"
                    aria-selected="false"><i class="icon-music block"></i>Audios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $key == 'archives' ? "active" : "" }}" id="get_types"
                    href="{{ URL::to('sort_by_types/archives') }}" role="tab" aria-controls="profile7"
                    aria-selected="false"><i class="icon-archive block"></i>Archives</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $key == 'documents' ? "active" : "" }}" id="get_types"
                    href="{{ URL::to('sort_by_types/documents') }}" role="tab" aria-controls="profile7"
                    aria-selected="false"><i class="icon-documents block"></i>Documents</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $key == 'other' ? "active" : "" }}" id="get_types"
                    href="{{ URL::to('sort_by_types/other') }}" role="tab" aria-controls="profile7"
                    aria-selected="false"><i class="icon-external-link block"></i>Other
                    Files</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="get_types" data-toggle="modal" href="#customModalTwo" role="tab"
                    aria-controls="profile7" aria-selected="false"><i class="icon-file_upload block"></i>Upload A New
                    File</a>
            </li>
        </ul>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="customModalTwo" tabindex="-1" role="dialog" aria-labelledby="customModalTwoLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title label_class~" id="customModalTwoLabel">Modal Title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(array('url' =>
                array('upload/files/to/server'),'class'=>'','name'=>'file_form','id'=>'file_form','role'=>'form','enctype'
                => 'multipart/form-data')) !!}
                <div class="modal-body">
                    <!-- 
                    <input type="hidden" name="id" value="{{ isset($menupost->id) ? $menupost->id : null }}">
                    <input id="menu_name" name="menu_name" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ isset($menupost ->menu_name) ? $menupost->menu_name : null }}">
                    -->
                    <div class="form-group">
                        <label for="file_name" class="label_class col-form-label">File Name *</label>
                        <input type="text" class="form-control" id="file_name" name="file_name"
                            placeholder="Enter Name Of File" required>
                    </div>
                    <div class="form-group">
                        <input type="file" name="file_url_name" id="file_url_name" class="inputfile"
                            data-multiple-caption="{count} files selected" multiple />
                        <label for="file_url_name"><span>Choose a file</span></label>
                    </div>
                </div>
                <div class="modal-footer custom">
                    <div class="left-side">
                        <button type="button" class="btn btn-link danger" data-dismiss="modal">Cancel</button>
                    </div>
                    <div class="divider"></div>
                    <div class="right-side">
                        <button type="submit" class="btn btn-link success">Upload File </button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>