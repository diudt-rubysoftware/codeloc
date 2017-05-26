<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport"
            content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no" />
        <title>{CODE} LOC by ThuanDH</title>
        <!-- CSS  -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
            rel="stylesheet">
        <link href="{{Asset('materialize/css/materialize.css')}}"
            type="text/css" rel="stylesheet" media="screen,projection" />
        <link href="{{Asset('materialize/css/style.css')}}" type="text/css"
            rel="stylesheet" media="screen,projection" />
    </head>
    <body>
        <nav class="white" role="navigation">
            <div class="nav-wrapper container">
                <a id="logo-container" href="#" class="brand-logo">{CODE} LOC</a>
                <!-- <ul class="right hide-on-med-and-down">
                    <li><a href="#">Navbar Link</a></li>
                    </ul>
                    
                    <ul id="nav-mobile" class="side-nav">
                    <li><a href="#">Navbar Link</a></li>
                    </ul>
                    <a href="#" data-activates="nav-mobile" class="button-collapse"><i
                    class="material-icons">menu</i></a> -->
            </div>
        </nav>
        <div class="container">
            <form class="section" method="get">
                @if (count($errors) > 0)
                <div class="card-panel red lighten-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="row">
                    <div class="input-field col s12">
                        {{Form::text("link", Input::old('link'), array('required',
                        'placeholder'=>'svn://192.168.0.109/svn/prjo_guru/30_implementation/33_source/topwww_seo'))}}
                        <label>Link SVN</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col s6">
                        <div class="row col s12">
                            <div class="input-field col s6">
                                {{Form::number("vs", Input::old('vs'), array('required',
                                'placeholder'=>'1234'))}} <label>Start version</label>
                            </div>
                            <div class="input-field col s6">
                                {{Form::number("ve", Input::old('ve'), array('required',
                                'placeholder'=>'5678'))}} <label for="last_name">End version</label>
                            </div>
                        </div>
                        <div class="row col s12">
                            <div class="input-field col s6">
                                {{Form::text("username", Input::old('username'),
                                array('required', 'placeholder'=>'Type username ...'))}} <label>Username</label>
                            </div>
                            <div class="input-field col s6">
                                {{Form::password("password", '', array('required',
                                'placeholder'=>'Type password ...'))}} <label>Password</label>
                            </div>
                        </div>
                    </div>
                    <div class="col s6">
                        <div class="card-panel green lighten-1">
                            <p>
                            <h1>Result = @if(isset($countLoc)) {{$countLoc}} @else 0 @endif</h1>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <p>
                        {{ Form::radio('check_type', '1', true, array('id' => 'type1') ) }}
                        <label for="type1">Đếm theo từng version</label> {{
                        Form::radio('check_type', '0', '' , array('id' => 'type2')) }} <label
                            for="type2">Đếm qua compare version đầu và cuối</label>
                    </p>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        {{Form::text("account", Input::old('account'), array(
                        'placeholder'=>'duonghongthuan;nguyenvantruong'))}} <label>Lọc theo
                        list account cách nhau bởi đấu ; (để trống thì không lọc)</label>
                    </div>
                </div>
                <div class="row">
                    <button class="btn waves-effect waves-light" type="submit"
                        name="action" value="submit">
                    Submit <i class="material-icons right">send</i>
                    </button>
                </div>
            </form>
        </div>
        <footer class="page-footer teal">
            <div class="container">
                <div class="row">
                    <div class="col l6 s12">
                        <h5 class="white-text">{CODE} LOC</h5>
                        <p class="grey-text text-lighten-4">
                            Hệ thống này là phiên bản dùng thử để xin ý kiến đóng góp của mọi
                            người.<br>Mọi ý kiến đóng góp xin gửi về email 【duonghongthuan@luvina.net】
                        </p>
                    </div>
                </div>
            </div>
            <div class="footer-copyright">
                <div class="container">
                    Made by <a class="brown-text text-lighten-3"
                        href="mailto:duonghongthuan@luvina.net">ThuanDH</a>
                </div>
            </div>
        </footer>
        <!--  Scripts-->
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="{{Asset('materialize/js/materialize.js')}}"></script>
        <script src="{{Asset('materialize/js/init.js')}}"></script>
    </body>
</html>