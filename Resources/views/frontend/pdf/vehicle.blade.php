<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="@setting('core::site-description')"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Certificado de Vehiculo - Eje Satelital</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <style>
        @page {
                /* margin: 2cm 2cm 1px 3cm; */
                margin-bottom: 1px;
            }
        body{
            font-family: 'Times New Roman', 'Times', 'serif';
            font-size: 15px;
        }
    </style>

</head>
<body>
    <div class="content m-0 pr-5 text-justify">
        <div class="row">
            <div class="col-6">
                <img  src="{{Theme::url('images/logo-cer.jpg')}}" alt="Eje Satelital" style="heigth: 140px; width: 360px">
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <p class="mt-3">
                    Pereira, {{$document->created_at->isoFormat('D [de] MMMM [de] YYYY')}} <br>
                    <strong>Remitente:</strong> {{$document->config->account->nameSender?? ''}} <br>
                    <strong>CC/NIT:</strong> {{$document->config->account->idSender?? ''}} <br>
                </p>
                <p class="mt-3">
                        <strong>
                        DIRIGIDO A: {{$document->config->account->addressee ?? 'A QUIEN PUEDA INTERESAR'}}
                    </strong>
                    </p>
                <h5 class="mt-4 text-center">VINCULACIÓN A PLATAFORMA DE RASTREO SATELITAL</h5>
                <p class="mt-4">
                    EJE SATELITAL S.A.S, identificado con NIT. 901188980-9 bajo registro TIC 96004149, presta el servicio de ubicación satelital de flota a través de nuestro Aplicativo Web,
                    así como el uso de una terminal propia del cliente para el(los) vehículo(s) relacionado(s) a continuación:
                </p>
                <div class="row text-center">
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
                    <strong><p class="m-0">{{trim($document->config->vehicle->name)}}</p></strong>
                    @endif
                </div>
                        <!-- Marcador de posición para el contenido que debe ir al final de la página -->
            @if($document->config->type)
            @if(count($document->config->vehicle)>4)
                <div id="bottom-content" style="page-break-after: always;"></div>
            @endif
        @endif
                <!-- Marcador de posición para el contenido que debe ir al final de la página -->
                <p class="mt-3">
                    La vigencia y autenticidad de este certificado puede verificarse mediante el correo electrónico info@ejesatelital.com o en la línea telefónica (+57) 300 912 2995.
                    Además, damos constancia de que el vehículo se encuentra activo en el momento de la expedición de este documento.
                </p>
                @php
                    use Carbon\Carbon;
                    $fecha = Carbon::parse($document->created_at)->addMonth()->day(5)->isoFormat('D [de] MMMM [de] YYYY');
                @endphp
                <p>
                    <strong>El presente documento tendrá validez hasta el {{$fecha}}.</strong>
                </p>

                <p class="mt-3">
                    Cordialmente,
                </p>
            </div>


            <div  style="position: absolute; bottom: 0;" class="sticky-bottom pr-4 mb-5">

                <div class="col-12 pt-2 d-flex justify-content-between align-items-center mt-2">
                    <img src="{{Theme::url('images/firma-jf.png')}}" alt="Firma" style="width: 200px;" class="img-fluid">

                    <img src="{{Theme::url('images/sello.jpg')}}" alt="Sello" style="width: 100px;" class="img-fluid float-right">

                </div>

                <div class="col-12">
                    <p class="m-0">Cristian Jimenez</p>
                    <p class="m-0">Director de Operaciones - Eje Satelital</p>
                    <p class="m-0">PBX: (+57) 300 912 2995</p>
                    <p class="m-0"><a href="https://www.ejesatelital.com"><u>www.ejesatelital.com</u></a></p>
                </div>
                <div class="col-12 mt-4">
                    <strong>
                        <p class="text-muted"  style="font-size: 11px">*El presente documento ha sido generado de manera automática a través de <u>https://certificados.ejesatelital.com</u>,
                            los datos del remitente y destinatario han sido proporcionados por el usuario en el momento de su creación.</p>
                    </strong>
                </div>
                <div class="col-12 mt-4 text-center" style="font-size: 13px">
                        <p class="text-secondary font-weight-bold m-0">Eje Satelital S.A.S. Av. 30 de Av. Las Americas No 81-02 Corales NIT: 901188980-9</p>
                        <p class="text-secondary font-weight-bold m-0">Pereira - Risaralda</p>
                </div>
            </div>


        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>
</html>

