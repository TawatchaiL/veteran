{{-- <div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-address-book"></i> ประวัติการการติดต่อ</h3>
        <div class="card-tools">
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body"> --}}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <table id="ListCaseview"
                class="display nowrap table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>ประเภทเคส</th>
                        <th>รายละเอียดเคส</th>
                        <th>สถานะเคส</th>
                        <th>Agent</th>
                        <th>วันที่ทำรายการ</th>
                        <th width="140px"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($caselist as $caselists)
                    <tr>
                        <td>{{ $caselists->casetype1 }}</td>
                        <td>{{ $caselists->casedetail }}</td>
                        <td>{{ $caselists->casestatus }}</td>
                        <td>{{ $caselists->agent }}</td>
                        <td>{{ $caselists->created_at }}</td>
                        <td width="140px">
                            <button type="button" data-cases_id="{{ $caselists->id }}" data-tabid="{{$cardid}}" class="form-control btn btn-success casedetailP-button">รายละเอียด</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>  
{{--     </div>
</div> --}}