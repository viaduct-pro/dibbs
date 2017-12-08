<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ Gravatar::get($user->email) }}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a>
                </div>
            </div>
        @endif

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="{{ trans('adminlte_lang::message.search') }}..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ trans('adminlte_lang::message.header') }}</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="{{(Request::is('admin') ? 'active' : '')}}"><a href="{{ url('admin') }}"><i class='fa fa-link'></i> <span>Dashboard</span></a></li>
            <li class="{{(Request::is('*users*') || Request::is('*user*') ? 'active' : '')}}"><a href="{{route('users')}}"><i class='fa fa-link'></i> <span>Users</span></a></li>

            <li class="treeview {{(Request::is('*item*') || Request::is('*comment*')) ? 'active' : ''}}">
                <a href="#"><i class='fa fa-map-marker'></i> <span>Content</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="{{(Request::is('*items*') || Request::is('*item*') ? 'active' : '')}}"><a href="{{route('items')}}"><i class='fa fa-files-o'></i> <span>ICO-items</span></a></li>
                    <li class="{{(Request::is('*comments*') || Request::is('*comment*') ? 'active' : '')}}"><a href="{{route('comments')}}"><i class='fa fa-files-o'></i> <span>Comments</span></a></li>

                </ul>
            </li>
            <li class="treeview {{(Request::is('*coins*') || Request::is('*real-coins*')) ? 'active' : ''}}">
                <a href="#"><i class='fa fa-map-marker'></i> <span>Coins</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="{{(Request::is('*real-coins*') ? 'active' : '')}}"><a href="{{route('real-coins')}}"><i class='fa fa-files-o'></i> <span>Realtime-Coins Data</span></a></li>
                    <li class="{{(Request::is('*coins*') && !Request::is('*real-coins*') ? 'active' : '')}}"><a href="{{route('coins')}}"><i class='fa fa-files-o'></i> <span>Coins DB</span></a></li>

                </ul>
            </li>


            {{--<li class="{{(Request::is('*real-coins*') || Request::is('*real-coins*') ? 'active' : '')}}"><a href="{{route('real-coins')}}"><i class='fa fa-table'></i> <span>Coins</span></a></li>--}}
            <li class="{{(Request::is('*configs*') || Request::is('*config*') ? 'active' : '')}}"><a href="{{route('configs')}}"><i class='fa fa-laptop'></i> <span>Configs</span></a></li>

        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
