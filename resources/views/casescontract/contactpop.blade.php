<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-address-book"></i> รายชื่อผู้ติดต่อที่พบ</h3>
                <div class="card-tools">
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <table id="Listview"
                            class="table table-sm table-head-fixed text-nowrap table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th width="5%"><input type="checkbox" id="check-all" class="flat">
                                    </th>
                                    <th>วันที่บันทึก</th>
                                    <th>HN</th>
                                    <th>ชื่อผู้ติดต่อ</th>
                                    <th>เบอร์โทรศัพท์บ้าน</th>
                                    <th>เบอร์โทรศัพท์มือถือ</th>
                                    <th width="120px"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contactd as $contact)
                                    <tr>
                                        <td><input type="checkbox" class="flat" disabled></td>
                                        <td>{{ $contact->created_at }}</td>
                                        <td>{{ $contact->hn }}</td>
                                        <td>{{ $contact->fname }} {{ $contact->lname }}</td>
                                        <td>{{ $contact->telhome }}</td>
                                        <td>{{ $contact->workno }}</td>

                                        <td width="150px">
                                            <button type="button" data-id="{{ $contact->id }}"
                                                data-tabid="{{ $cardid }}" data-telephoneno="{{ $telephone }}"
                                                class="btn ิะืขหท btn-success selectcontactp-button">บันทึกข้อมูล
                                            </button>
                                        </td>
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
