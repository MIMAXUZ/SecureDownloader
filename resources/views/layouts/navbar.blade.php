<div class="container">
    <!-- Header start -->
    <header class="header">
        <nav class="navbar navbar-expand-lg dark">
            <a class="navbar-brand" href="{{ URL::to('/') }}">SecureDownloader</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav7"
                aria-controls="navbarNav7" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                    <i></i>
                    <i></i>
                    <i></i>
                </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav7">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ URL::to('list/uploads') }}"><i
                                class="icon-av_timer"></i>Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-autorenew"></i>Analytics</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="icon-restore"></i>Sales</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Navigation end -->