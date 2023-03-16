@extends('layouts.app')

@section('content')

<style type="text/css">
    
    .btn-red{
        background: yellow;
    }
</style>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#showmodal">
    Sản phẩm show trang chủ
    </button>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- Search form -->
                    
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right"
                       href="{{ route('products.create') }}">
                        Add New
                    </a>
                </div>

                <div class="btn btn-red"><a href="{{ route('deal') }}">deal sản phẩm</a></div>

                <div class="bthongbao"></div>
            </div>
        </div>

        

    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-0">
                @include('products.table')

                <div class="card-footer clearfix">
                    <div class="float-right">
                        @include('adminlte-templates::common.paginate', ['records' => $products])
                    </div>
                </div>
            </div>

        </div>
    </div>


   
    <!-- Modal -->
    <div class="modal fade" id="showmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <div><a href="{{ route('host-list') }}?page=1">Sản phẩm show trang chủ nhóm Tivi</a></div>
                        <div><a href="{{ route('host-list') }}?page=2">Sản phẩm show trang chủ nhóm Máy giặt</a></div>
                        <div><a href="{{ route('host-list') }}?page=3">Sản phẩm show trang chủ nhóm Tủ lạnh</a></div>
                        <div><a href="{{ route('host-list') }}?page=4">Sản phẩm show trang chủ nhóm Điều hòa</a></div>
                        <div><a href="{{ route('host-list') }}?page=8">Sản phẩm show trang chủ nhóm Gia dụng</a></div>
                        <div><a href="{{ route('host-list') }}?page=9">Sản phẩm show trang chủ nhóm Máy lọc nước</a></div>
                        <div><a href="{{ route('host-list') }}?page=71">Sản phẩm show trang chủ nhóm Máy sấy quần áo</a></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                   
                </div>
            </div>
        </div>
    </div>

@endsection

