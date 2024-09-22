{{ content() }}

   <br>
<div class="row">
<div class="col-xs-12 col-sm-3 col-md-4" >
</div>
    <div class="col-xs-12 col-sm-5 col-md-3">
        <div class="page-header">
            <h2>Iniciar Sesión</h2>
        </div>
        {{ form('session/start', 'role': 'form') }}
            <fieldset>
                <div class="form-group">
                    <div class="controls">
                        {{ text_field('email', 'class': "form-control","placeholder":"Correo electrónico") }}
                    </div>
                </div>
                <div class="form-group">
                    <div class="controls">
                        {{ password_field('password', 'class': "form-control","placeholder":"Contraseña") }}
                    </div>
                </div>
                <div class="form-group">
                    {{ submit_button('Ingresar', 'class': 'btn btn-primary btn-large') }}
                </div>
            </fieldset>
        </form>
    </div>

    <div class="col-xs-12 col-sm-3 col-md-4" >
</div>

    </div>

</div>
