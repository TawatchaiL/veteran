@extends('layouts.app')

@section('style')
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-list-ol"></i> ประเภทการติดต่อ</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                {{-- <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                    <i class="fas fa-times"></i>
                                </button> --}}
                                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
                                    <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                
                                    <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true"></span>
                                    </button>
                                </div>
                                <div class="row">
                                    <div class="col-xs-5 col-sm-5 col-md-5" id="targetselect">
                                        <div class="row mb-3 case1">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <select style="width: 100%;"
                                                    class="select2 form-control casetypechang" id="casetype1" data-lev="1" data-parent="0" name="casetype1">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3 case2">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <select style="width: 100%;"
                                                    class="select2 form-control casetypechang" id="casetype2" data-lev="2" name="casetype2">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3 case3">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <select style="width: 100%;"
                                                    class="select2 form-control casetypechang" id="casetype3" data-lev="3" name="casetype3">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3 case4">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <select style="width: 100%;"
                                                    class="select2 form-control casetypechang" id="casetype4" data-lev="4" name="casetype4">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3 case5">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <select style="width: 100%;"
                                                    class="select2 form-control casetypechang" id="casetype5" data-lev="5" name="casetype5">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3 case6">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <select style="width: 100%;"
                                                    class="select2 form-control casetypechang" id="casetype6" data-lev="6" name="casetype6">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-7 col-sm-7 col-md-7" id="targettext">
                                        <div class="row mb-3"><div class="col-xs-12 col-sm-12 col-md-12"><div class="input-group"><input type="text" id="newcasetype" name="newcasetype[]" class="form-control has-feedback-left" value="" required="required">&nbsp;<button type="button" class="btn btn-success" id="SubmitNewCasetype"><i class="fa-solid fa-plus"></i>เพิ่ม</button></div></div></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('casetype.create')

    @include('casetype.edit')
@endsection

@section('script')
    @include('casetype.script')
@endsection
