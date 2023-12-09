
    <div class="card col-xs-12 col-sm-12 col-md-12">
        <div class="card-header">
            <h3 class="card-title"></h3>
        </div>

        <div class="card-body p-0" style="min-height: 200px; max-height: 400px; overflow: auto;">
            <table id="Listview"
                class="table table-sm table-head-fixed text-nowrap table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>วันที่ทำรายการ</th>
                        <th>ประเภทเคส</th>
                        <th>รายละเอียดเคส</th>
                        <th>สถานะเคส</th>
                        <th>Agent ที่บันทึก</th>
                        <th width="120px"></th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($caselist) > 0)
                        @foreach ($caselist as $caselists)
                            <tr>
                                <td>{{ $caselists->created_at }}</td>
                                <td>{{ $caselists->casetype1 }}</td>
                                <td>{{ $caselists->casedetail }}</td>
                                <td>{{ $caselists->casestatus }}</td>
                                <td>{{ $agent[$caselists->agent]['name'] }}</td>
                                <td width="140px">
                                    <button type="button" data-cases_id="{{ $caselists->id }}"
                                        data-tabid="{{ $cardid }}"
                                        class="form-control btn btn-warning btn-sm casedetailP-button"><i
                                            class="fas fa-search"></i> รายละเอียด</button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" align="center">ยังไม่มีรายการเรื่องที่ติดต่อ</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

