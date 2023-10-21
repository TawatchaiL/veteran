<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link sidebar-toggle-btn" data-widget="pushmenu" href="#" role="button"><i
                    class="fas fa-bars"></i></a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        @if (!empty($sidebarc))
            <li class="nav-item d-none d-sm-inline-block"><a href="/" class="nav-link"> [ <i
                        class="fa-solid fa-lg fa-home"></i>
                    <b class="text-primary"> หน้าหลัก </b> ]
                </a></li>
            <li class="nav-item d-none d-sm-inline-block">
                <a class="nav-link" data-widget="fullscreen">
                    <i class="fas fa-xl fa-expand-arrows-alt"></i> <b class="text-primary">ขยาย/ย่อ หน้าจอ</b>
                </a>
            </li>
            <li>
                <div class="form-group row">
                    <label for="redirectSelect" class="col-sm-4 col-form-label text-sm-end">Queue:</label>
                    <div class="col-sm-6">
                        <select id="redirectSelect" class="custom-select form-control-border">
                            @foreach ($queue as $queueItem)
                                <option value="{{ $queueItem->extension }}">{{ $queueItem->descr }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </li>
        @endif
    </ul>
</nav>
