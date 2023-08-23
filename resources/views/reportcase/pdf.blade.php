<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style>
    @font-face {
        font-family: 'THSarabunNew';
        font-style: normal;
        font-weight: normal;
        src: url("{{ public_path('fonts/THSarabunNew.ttf') }}") format('truetype');
    }
    @font-face {
        font-family: 'THSarabunNew';
        font-style: normal;
        font-weight: bold;
        src: url("{{ public_path('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
    }
    @font-face {
        font-family: 'THSarabunNew';
        font-style: italic;
        font-weight: normal;
        src: url("{{ public_path('fonts/THSarabunNew Italic.ttf') }}") format('truetype');
    }
    @font-face {
        font-family: 'THSarabunNew';
        font-style: italic;
        font-weight: bold;
        src: url("{{ public_path('fonts/THSarabunNew BoldItalic.ttf') }}") format('truetype');
    }
    body {
        font-family: "THSarabunNew";
    }
</style>
<section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title" style="font-size:16pt;text-align:center;padding: 4px;"> ผลรวมสายเข้าแยกตาม Agent</h3>
                        </div>
                        <div class="card-body">
                                <table id="Listview" style="border-collapse: collapse;font-size:12pt;margin-top:8px;" width="100%">
                                    <thead>
                                        <tr style="border:1px solid #000;padding:4px;">
                                            <th style="border:1px solid #000;padding:4px;"><div style="font-size:16pt;">agent</div></th>
                                            <th style="border:1px solid #000;padding:4px;" width="280px"><div style="font-size:16pt;">จำนวน</div></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($Cases as $c)
                                    <tr style="border:1px solid #000;padding:4px;">
                                            <td style="border:1px solid #000;padding:4px;">{{$c->agent}}</td>
                                            <td style="border:1px solid #000;padding:4px;text-align:center;">{{$c->sumcases}}</td>
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

