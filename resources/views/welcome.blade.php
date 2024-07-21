<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Efectivale Landing Page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/v/bs5/dt-2.0.8/datatables.min.css" rel="stylesheet">
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
    <nav class="navbar navbar-expand-lg navbar-light bg-danger">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Efectivale</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

            </div>
        </div>
    </nav>
    <div class="container">
        <section class="col-6 offset-3 pb-4 mt-4">
            <div class="border rounded-5">
                <section class="w-100 p-4 d-flex justify-content-center pb-4">
                    <div class="col-9">
                    <h3 class="mt-4">Solicitar información</h3>
                    <p class="mt-4">
                        Ingrese sus datos y uno de nuestros ejecutivos se pondrá en contacto con usted.
                    </p>
                        <form>
                            <label class="form-label">Nombre</label>
                            <div class="input-group has-validation mb-4">
                                <input type="name" name="name" class="form-control" required>
                                <div id="name-invalid" class="invalid-feedback">

                                </div>
                            </div>

                            <label class="form-label">Email</label>
                            <div class="input-group has-validation mb-4">
                                <input type="email" name="email" class="form-control" required>
                                <div id="email-invalid" class="invalid-feedback">

                                </div>
                            </div>

                            <label class="form-label">Teléfono</label>
                            <div class="input-group has-validation mb-4">
                                <input type="phone" name="phone" class="form-control" required>
                                <div id="phone-invalid" class="invalid-feedback">

                                </div>
                            </div>

                            <label class="form-label">Descripción</label>
                            <div class="input-group has-validation mb-4">
                                <input type="text" name="description" class="form-control" required>
                                <div id="description-invalid" class="invalid-feedback">

                                </div>
                            </div>
                            <button type="button" id="btn-register" class="btn btn-primary btn-block mb-3">Registrarse</button>
                        </form>
                    </div>
                </section>
            </div>
        </section>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>

<script>
    $("#btn-register").on({
        click: function(){
            let form = $(this).parent('form')

            $.ajax({
                url: "http://efectivale-api.local/api/requests",
                method: "POST",
                data: form.serializeArray(),
                dataType: "JSON",
                beforeSend: function(){
                    $('#message').addClass('d-none').html("")
                }
            })
            .done(function(response){
                window.location.href = "/confirm"
            })
            .fail(function(response){
                let data = response.responseJSON,
                    errores = ""

                $(':input',$(form))
                    .removeClass('is-invalid')
                    .addClass('is-valid')
                
                $('#message')
                    .removeClass('d-none')
                    .addClass('d-block')
                    .html(data.message)
                
                if(errores = data.errors){
                    $.each(errores, function(key, item){
                        $(`:input[name=${key}]`, $(form))
                            .removeClass('is-invalid, is-valid')
                            .addClass('is-invalid')
                        
                        $(`#${key}-invalid`, $(form))
                            .html(`${item[0]}`)
                    })
                }
            })
        }
    })
</script>