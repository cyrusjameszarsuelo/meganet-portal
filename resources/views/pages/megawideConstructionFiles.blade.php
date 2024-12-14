@extends('main')

@section('content')
    <div class="container mt-3">
        <div class="mt-3">
            <span class="breadcrumbCustom"><a href="/home">HOME </a>
                <i class="fa fa-chevron-right ml-2 mr-2"></i>
                <a href="/pcs">
                    <span>Pcs</span>
                </a>
                <i class="fa fa-chevron-right ml-2 mr-2"></i>
                <span style="color:#ee2f21; text-transform: capitalize;">{{ $file }}</span>
            </span>
        </div>
    </div>

    <section class="container mt-3 mb-3">
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <span style="text-transform: capitalize;">{{ $file }}</span>
                                <span class="float-right"><button class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#exampleModal">Upload File</button></span>
                            </div>
                            <ul class="list-group list-group-flush">
                                @if ($publicFiles != '')
                                    @forelse ($publicFiles as $item)
                                        <a href="#"
                                            class="metricStore"
                                            data-action="Downloaded {{$file}}"
                                            data-url="{{ asset('megawideConstructionFolder/' . $file . '/' . $item->getFilename()) }}"
                                            target="_blank">
                                            <li class="list-group-item">{{ $item->getFilename() }}</li>
                                        </a>

                                    @empty
                                    @endforelse
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6 mt-2">
                        <a class="btn btn-primary text-white btn-block btn-lg " style="font-size: 14px; background-color: #ee2f21"
                            href="/megawide-construction/manuals-policies">
                            <i class="fa fa-book"></i> Manuals/Policies</a>
                    </div>
                    <div class="col-md-6 mt-2">
                        <a class="btn btn-success text-white btn-block btn-lg " style="font-size: 14px; background-color: #7c7c7c"
                            href="/megawide-construction/templates-forms">
                            <i class="fa fa-book"></i> Templates/Forms</a>
                    </div>
                    <div class="col-md-6 mt-2">
                        <a class="btn btn-warning text-white btn-block btn-lg " style="font-size: 14px; background-color: #000"
                            href="/megawide-construction/powerpoint-presentation">
                            <i class="fa fa-book"></i> Powerpoint Presentations</a>
                    </div>
                    <div class="col-md-6 mt-2">
                        <a class="btn btn-info text-white btn-block btn-lg " style="font-size: 14px; background-color: #fff; color: black !important;"
                            href="/megawide-construction/others">
                            <i class="fa fa-book"></i> Others</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <img class="corporateOfficeImage" src=""
                    alt="">
            </div>
        </div>


    </section>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/megawideConstructionUpload/{{ $file }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleFormControlFile1">File to Upload in <span
                                    style="color:#ee2f21; text-transform: capitalize;">{{ $file }}</span>
                                folder</label>
                            <input type="file" class="form-control-file" id="exampleFormControlFile1" name="uploads">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
