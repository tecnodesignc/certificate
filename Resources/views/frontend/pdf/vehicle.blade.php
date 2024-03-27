<!DOCTYPE html>
<html>
<head lang="es">
    <meta charset="UTF-8">
    <meta name="description" content="@setting('core::site-description')"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> --}}
    {{-- <meta http-equiv="X-UA-Compatible" content="ie=edge"> --}}
    <title>Certificado de Vehiculo - Eje Satelital</title>
    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
          crossorigin="anonymous">
   <style>
       @page {
           margin: 2cm 2cm 1px 3cm;
       }

    body{
            font-family: 'Time Roman';
            font-size: 16px;
            text-align: justify;
        }

        p {
            margin-bottom: 1rem;
        }
</style>
</head>
<body>
<div class="content">

    <div class="row">
        <div class="col-6">
            {{-- <img  src="{{Theme::url('images/logo-cer.jpg')}}" alt="Eje Satelital" style="heigth:120px; width: 370px"> --}}
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <p style="margin-top: 40px">
                Pereira, {{$document->created_at->isoFormat('D [de] MMMM [de] YYYY')}}
            </p>
            <p style="margin-top: 40px">
                A QUIEN PUEDA INTERESAR
            </p>
            <p style="margin-top: 40px; text-align: center; font-weight: bold; font-size: 16px">SERVICIO A PLATAFORMA DE RASTREO SATELITAL</p>
            <p style="margin-top: 30px">
                Mediante la presente, hacemos constancia de tener un acuerdo de concesión entre EJE SATELITAL S.A.S., identificada con NIT. 901188980-9,
                y <span class="text-uppercase">{{$document->config->account->name}}</span>, identificado con C.C./NIT <strong>{{$document->config->account->nit}}</strong>
            </p>
            <p>
                Dicho acuerdo incluye la prestación del servicio de ubicación satelital de flota a través de nuestro Aplicativo Web,
                así como el uso de un terminal propio del cliente.

                @if($document->config->type)
                    <table class="table table-sm text-center">
                        <tbody>
                            @foreach ($document->config->vehicle as $vehicle)
                                <tr>
                                    <td>{{$vehicle->name}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    la  placa: </p><p style="text-align: center"> <strong>{{$document->config->vehicle->name}}</strong>
                @endif
            </p>
            <p>
                Ademas damos constancia que el suscrito se encuentra activo en el momento de la expedición de este documento.
            </p>
            <p>
                Este certficado es valido a partir de la fecha; la vigencia y autenticidad de este
                documento puede verificarse mediante el correo electronico info@ejesatelital.com o en la
                linea 311 390 9197
            </p>

            <p>
                Cordialmente,
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-6" style="padding-top: 40px">
            {{-- <img class="align-bottom" src="{{Theme::url('images/firma-jf.jpg')}}" style="width: 200px" alt="Firma"> --}}
        </div>
        <div class="col-sm-6 text-center" style="float: right">
            {{-- <img class="img-responsive" src="{{Theme::url('images/sello.jpg')}}" style="width: 140px; padding-top: 40px; display: inline; margin-bottom: -80px" alt="sello"> --}}
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <p style="margin: 0">Jhon Fredy Ospina Montoya</p>
            <p style="margin: 0">Director de Operaciones - Eje Satelital</p>
            <p style="margin: 0">Telefono: 311 390 9197</p>
            <p style="margin: 0"><a href="https://www.ejesatelital.com">www.ejesatelital.com</a></p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 text-center" style="font-size: 12px">
            <p style="margin:40px 0 0; font-weight: bold; color: #a4a4a4">Eje Satelital S.A.S. Av. 30 de Av. Las Americas No 81-02 Corales NIT: 901188980-9</p>
            <p style="margin: 0; font-weight: bold; color: #a4a4a4">Pereira - Risaralda</p>
        </div>
    </div>
</div>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
</body>
</html>
