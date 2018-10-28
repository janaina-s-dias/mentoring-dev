<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mentoring</title>
     <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}"> 
    <link rel="stylesheet" href="{{ asset('fonts/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Footer-Basic.css') }}">    
    <script src="{{ asset('js/jQuery.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/scripts/frontend.js') }}" type="text/javascript"></script>
    <script src="{{ asset('DataTables/datatables.min.js') }}" type="text/javascript"></script>
    <link href="{{ asset('DataTables/datatables.min.css') }}" rel="stylesheet" type="text/css"/>
    <style type="text/css">
        
        #plx {
    /* The image used */
    background-image:url("{{ asset('img/study.jpg') }}");    

    /* Full height */
    height: 280px;
    width: 100%;

    /* Create the parallax scrolling effect */
    background-attachment: fixed;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    }
    </style>
    
</head>
<body>
    
    <div class="container">
        <div class="row">           
             <form class="form-inline" role="form" action="{{ route ('acessar') }}" method="post">     
                  @csrf
                  
                   <div class="form-group{{ $errors->has('user_login') ? ' is-invalid' : '' }}">
                     <input type="text" class="form-control form-rounded" placeholder=" Login" name="user_login" type="text" id="login" value="" autofocus>
                     @if ($errors->has('user_login'))
                        <small class="text-danger" role="alert">
                             <strong>{{ $errors->first('user_login') }}</strong>
                        </small>
                    @endif
                    </div>
                    
                    <div class="form-group{{ $errors->has('user_hash') ? 'is-invalid' : '' }}">
                          <input type="password" class="form-control form-rounded" placeholder=" Senha" name="user_hash" type="password" id="password" style="margin-left:5px;">
                    
                           @if ($errors->has('user_hash'))
                                <small class="text-danger" role="alert">
                                    <strong>{{ $errors->first('user_hash') }}</strong>
                                </small>
                           @endif
                    </div> 
                      
                          <button type="submit" class="btn btn-info mb-2" id="submit">Entrar</button> 
                            <a href="{{url('cadastro')}}" class="btn btn-info mb-2" id="cadastro">Cadastrar</a>

                    <div class="checkbox">
                         <label>
                            <input name="remember" type="checkbox" value="Remember Me" style="margin-left:5px;">Lembre-se    
                        </label>
                        </div>
                    </div>                        
                               
            </form>            
        </div>
    </div>

     
    <div class="container-fluid" id="primeirarow">      
            <div class="row">
               <div class="col-md-4"><img src="{{ asset('img/ment.png') }}" class="img-fluid" style="margin-top:25px;"></img></div>
                <div class="col-md-5 offset-md-3" ><h2 style="margin-top:25%;"></h2></div>                
            </div>
        </div>  


         <div class="container-fluid" id="plx">
            <div class="row h-100">
                     <div class="col-md-4">
                        <h3><strong></strong></h3>
                     </div>
                     <div class="col-md-4">
                       <h3><strong></strong></h3>
                     </div>
                     <div class="col-md-4">
                        <h3><strong></strong></h3>
                     </div>
                
            </div>
        </div>

</div>
   


<div class="footer-basic">
        <footer>
            <div class="social"><a href="#"><i class="icon ion-social-instagram"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#">
                    <i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-facebook"></i></a></div>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Home</a></li>
                <li class="list-inline-item"><a href="#">Services</a></li>
                <li class="list-inline-item"><a href="#">About</a></li>
                <li class="list-inline-item"><a href="#">Terms</a></li>
                <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
            </ul>
            <p class="copyright">AJ2P Corp. <?php echo date('Y'); ?></p>
        </footer>
    </div>
    
    
</body>

</html>