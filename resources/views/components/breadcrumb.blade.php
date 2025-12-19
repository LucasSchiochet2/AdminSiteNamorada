            <div class="app-content-header">
                <div class="container-fluid">
                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6">
                            @hasSection('title')
                                <h3 class="mb-0">@yield('title')</h3>
                            @endif
                        </div>
                        @isset($breadcrumbs)
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                @foreach ($breadcrumbs as $breadcrumb)
                                    @if (!$loop->last)
                                        <li class="breadcrumb-item"><a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['name'] }}</a></li>
                                    @else
                                        <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb['name'] }}</li>
                                    @endif
                                @endforeach
                            </ol>
                        </div>
                        @endisset
                        <div class ="col-sm-6 text-end">
                        @yield('page-actions')
                    </div>
                    </div>

                    <!--end::Row-->
                </div>
            </div>
