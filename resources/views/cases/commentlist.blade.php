            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-address-book"></i> รายชื่อผู้ติดต่อ</h3>
                            <div class="card-tools">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                        <table id="Listview"
                                            class="display nowrap table table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th width="5%"><input type="checkbox" id="check-all"
                                                            class="flat">
                                                    </th>
                                                    <th>การแสดงความคิดเห็น</th>
                                                    <th>Agent</th>
                                                    <th>วันที่ทำรายการ</th>
                                                    <th width="120px"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($casecomment as $casecomments)
                                                <tr>
                                                    <td><input type="checkbox" class="flat"></td>
                                                    <td>{{ $casecomments->comment }}</td>
                                                    <td>{{ $casecomments->agent }}</td>
                                                    <td>{{ $casecomments->created_at }}</td>
                                                    <td width="150px"></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                </div>
                            </div>
                        </div>

                    </div>



                </div>

            </div>
