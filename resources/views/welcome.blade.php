@extends('layouts.master')

@section('title')
    Welcome
@endsection

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="upload-delete" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <main>

        <div id="uploads-user-wrap">
            <div class="titles-block">
                <h2>Your Uploads</h2>
                <button id="uploads-list"><img src="{{asset('img/btn_list.svg')}}" alt="List Layout"></button>
                <button id="uploads-grid"><img src="{{asset('img/btn_grid.svg')}}" alt="List Layout"></button>
            </div>
            <div id="uploads-user" class="{{ $user_settings['default_layout'] }}">

                @if($uploads->isEmpty())
                    <div class="alert alert-warning">
                        No Uploads
                    </div>
                @else

                    @foreach ($uploads as $upload)
                        <div class="upload-user-wrap">
                            <h3 class="upload-user-title">{{$upload->url}}</h3>
                            <div class="upload-user">
                                <form id="form-delete" method="post" action="{{ route('uploads.delete', ['id' => $upload->id]) }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE"/>
                                    <button class="upload-delete" type="submit">X</button>
                                </form>
                                <div class="upload-url">{{ url('storage/uploads') }}/{{$upload->url }}</div>
                                <img class="upload-thumb" src="/uploads/screenshots/{{$upload->img_src }}" alt="media">
                                <div class="upload-size">{{$upload->media_file_size }}</div>
                                <div>
                                    <button class="btn btn-primary-dark">Copy</button>
                                </div>
                            </div>
                        </div>
                    @endforeach

                @endif


            </div>
        </div>

        <div id="upload-form">
            <div class="titles-block">
                <h2>Media Upload</h2>
            </div>
            <form action="{{ route('upload.store') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}

                <label for="file-upload" class="btn btn-action" id="file-selected-label">Click Here</label>
                <span id="file-selected"></span>
                <input id="file-upload" type="file" name="upload"/>

                <input type="submit" value=" Save " class="btn btn-primary-dark" />
            </form>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        'use strict';
        const uploads = document.getElementById("uploads-user");
        const uploads_list = document.getElementById("uploads-list");
        const uploads_grid = document.getElementById("uploads-grid");
        let upload = document.querySelectorAll(".upload-user");
        const alert_msg = document.querySelector(".alert");
        const file_upload = document.getElementById("file-upload");
        const btn_delete = document.querySelector(".upload-delete");
        const alert_delete = document.querySelector(".alert .upload-delete");
        const file_selected = document.getElementById("file-selected");

        if (btn_delete) {

            btn_delete.onclick = function() {
                return confirm("Are You Sure?");
            };
        }

       file_upload.onchange = function() {
           var fileName = this.value;
           fileName = document.createTextNode(fileName);
           file_selected.appendChild(fileName);
           file_selected.classList.add("file-selected");
       };

        if (alert_delete) {
            alert_delete.onclick = function () {
                alert_msg.remove();
            };
        }
        function layout_change(element,layout) {
            if (layout == 'list') {
                element.classList.remove("layout-grid");
                element.classList.add("layout-list");

            } else if (layout == 'grid') {
                element.classList.remove("layout-list");
                 element.classList.add("layout-grid");

            }

        }

        uploads_list.onclick = function() {
            layout_change(uploads,'list');

        };

        uploads_grid.onclick = function() {
            layout_change(uploads,'grid');
        };

        function copyToClipboard(element) {
            const temp = document.createElement("input");
            let url_copy = element.querySelector(".upload-url").innerHTML;

            document.body.appendChild(temp);

            temp.value = url_copy;
            temp.select();
            document.execCommand("copy");
            temp.remove();
        }

        for (let i = 0; i < upload.length; i++) {
            upload[i].onclick = function () {
                copyToClipboard(upload[i]);
            };
        }
    </script>
@stop