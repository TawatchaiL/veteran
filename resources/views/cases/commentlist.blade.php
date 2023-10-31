
                                        <table id="Listview"
                                            class="display nowrap table table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>การแสดงความคิดเห็น</th>
                                                    <th>Agent</th>
                                                    <th>วันที่ทำรายการ</th>
                                                    <th width="140px"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($casecomment as $casecomments)
                                                <tr>
                                                    <td>{{ $casecomments->comment }}</td>
                                                    <td>{{ $casecomments->agent }}</td>
                                                    <td>{{ $casecomments->created_at }}</td>
                                                    <td width="140px">
                                                        <button type="button" data-comment_id="{{ $casecomments->id }}" class="form-control btn btn-success selectcomment-button">รายละเอียด
                                                        </button></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>