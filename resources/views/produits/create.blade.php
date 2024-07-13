{{-- @extends('layouts.main')

@section('title', "Gestion produits")

@section('cssblock')

@endsection

<!-- page content -->
@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>FORMULAIRE DE PRODUITS</h3>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_content">
                        <form class="" action="{{ route('produits.store') }}" method="POST">
                            @csrf 
                            <span class="section">Donnee Produits</span>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Nom Produit<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" data-validate-length-range="6" data-validate-words="2" name="name_pdt" required=" " />
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Image du Produit<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="file" class="form-control" name="image" required="" />
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Désignation<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" name="designation" required="" />
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Prix<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="number" class="form-control" name="prix" required="" />
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Stock<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="number" class="form-control" name="stock" required="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 offset-md-3">
                                    <button type='submit' class="btn btn-primary">Enregistrer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<!-- /page content -->

@section('jsblock')
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="{{ asset('bo/vendors/validator/multifield.js') }}"></script>
    <script src="{{ asset('bo/vendors/validator/validator.js') }}"></script> --}}
    
    <!-- Javascript functions	-->
	{{-- <script>
		function hideshow(){
			var password = document.getElementById("password1");
			var slash = document.getElementById("slash");
			var eye = document.getElementById("eye");
			
			if(password.type === 'password'){
				password.type = "text";
				slash.style.display = "block";
				eye.style.display = "none";
			}
			else{
				password.type = "password";
				slash.style.display = "none";
				eye.style.display = "block";
			}

		}
	</script>

    <script>
        // initialize a validator instance from the "FormValidator" constructor.
        // A "<form>" element is optionally passed as an argument, but is not a must
        var validator = new FormValidator({
            "events": ['blur', 'input', 'change']
        }, document.forms[0]);
        // on form "submit" event
        document.forms[0].onsubmit = function(e) {
            var submit = true,
                validatorResult = validator.checkAll(this);
            console.log(validatorResult);
            return !!validatorResult.valid;
        };
        // on form "reset" event
        document.forms[0].onreset = function(e) {
            validator.reset();
        };
        // stuff related ONLY for this demo page:
        $('.toggleValidationTooltips').change(function() {
            validator.settings.alerts = !this.checked;
            if (this.checked)
                $('form .alert').remove();
        }).prop('checked', false);

    </script> --}}
@endsection --}}