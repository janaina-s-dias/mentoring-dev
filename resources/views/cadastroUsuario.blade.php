                <div class="form-group">
                    <input class="form-control{{ $errors->has('user_nome') ? ' is-invalid' : '' }}" name="user_nome" id="nome" type="text" placeholder="Nome">
                @if ($errors->has('user_nome'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('user_nome') }}</strong>
                    </span>
                @endif
                </div>
                <div class="form-group">
                    <input class="form-control{{ $errors->has('user_email') ? ' is-invalid' : '' }}" name="user_email" id="email" type="text" placeholder="E-mail">
                @if ($errors->has('user_email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('user_email') }}</strong>
                    </span>
                @endif
                </div>
                <div class="form-group">
                    <input class="form-control{{ $errors->has('user_login') ? ' is-invalid' : '' }}" name="user_login" id="user" type="text" placeholder="Usuario">
                @if ($errors->has('user_login'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('user_login') }}</strong>
                    </span>
                @endif
                </div>
                <div class="form-group">
                    <input class="form-control{{ $errors->has('user_rg') ? ' is-invalid' : '' }}" name="user_rg" id="rg" type="text" placeholder="RG"  pattern="\d{2}\.\d{3}\.\d{3}-\d{1}" title="No formato (##.###.###-#)">
                @if ($errors->has('user_rg'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('user_rg') }}</strong>
                    </span>
                @endif
                </div>
                <input name="user_role" type="hidden" value="user">
                <div class="form-group">
                    <input class="form-control{{ $errors->has('user_cpf') ? ' is-invalid' : '' }}" name="user_cpf" id="cpf" type="text" placeholder="CPF" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" title="No formato (###.###.###-##)">
                @if ($errors->has('user_cpf'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('user_cpf') }}</strong>
                    </span>
                @endif
                </div>
                <div class="form-group">
                    <input class="form-control{{ $errors->has('user_telefone') ? ' is-invalid' : '' }}" name="user_telefone" id="telefone" type="tel" placeholder="Telefone" 
                           pattern="[0-9]{2} [0-9]{4}-[0-9]{4}" title="No formato ((##) ####-####)">
                @if ($errors->has('user_telefone'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('user_telefone') }}</strong>
                    </span>
                @endif
                </div>
                <div class="form-group">
                    <input class="form-control{{ $errors->has('user_celular') ? ' is-invalid' : '' }}" name="user_celular" id="celular" type="tel" placeholder="Celular"  
                           pattern="[0-9]{2} [0-9]{5}-[0-9]{4}" title="No formato ((##) #####-####)">
                @if ($errors->has('user_celular'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('user_celular') }}</strong>
                    </span>
                @endif
                </div>
                <div class="form-group">
                    <input name="user_knowledge" id="knowledge" type="checkbox">Deseja ser mentor?
                </div>