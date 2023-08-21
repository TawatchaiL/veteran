@extends('layouts.app')

@section('style')
    @include('reportcase.style')
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-address-book"></i> ผลรวมสายเข้าแยกตาม Agent</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                {{-- <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                    <i class="fas fa-times"></i>
                                </button> --}}
                            </div>
                        </div>

                        <div class="card-body">
                                @csrf
                                @method('POST')
                                <table id="Listview" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>agent</th>
                                            <th width="280px">จำนวน</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($Cases as $c)
                                    <tr>
                                            <td>{{$c->casetype1}}</td>
                                            <td>{{$c->telno}}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>   
@endsection

