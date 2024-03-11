<!DOCTYPE html>
<html>
<head lang="es">
    <meta charset="UTF-8">
    <meta name="description" content="@setting('core::site-description')"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Certificado de Vehiculo - Eje Satelital</title>
    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
          crossorigin="anonymous">
    <style>
        @page {
            margin-left: 3cm;
            margin-right: 2cm;
            margin-bottom: 1px;

        }

        body {
            font-family: 'Time Roman';
            font-size: 16px;
            text-align: justify;
            line-height: 19px;
        }

        p {
            margin-bottom: 0.5rem;
        }
        .table{
            font-size: 12px;
        }
    </style>
</head>
<body>
<div class="content">
    <div class="row">
        <div class="col-6">
            <img src="{{Theme::url('images/logo-cer.jpg')}}" alt="Eje Satelital" style="width: 370px">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <p style="margin-top: 30px">
                Pereira, {{$document->created_at->isoFormat('D [de] MMMM [de] YYYY')}}
            </p>
            <p style="margin-top: 40px">
                A QUIEN PUEDA INTERESAR
            </p>
            <p style="margin-top: 30px; text-align: center; font-weight: bold; font-size: 14px">VINCULACION A PLATAFORMA DE RASTREO
                SATELITAL</p>
            <p style="margin-top: 30px">
                Con la presente hacemos constancia de la instalación y vinculación a nuestra plataforma
                de Rastreo Satelital Eje Satelital.
            </p>
            <p>
                La anterior ha sido efectuada en la maquina relacionada a continuacion:
            </p>
            <table class="table table-bordered  table-sm">
                <tr>
                    <th>
                        MARCA
                    </th>
                    <td> {{$document->config->vehicle->brand??''}}</td>
                </tr>
                <tr>
                    <th>
                        LINEA
                    </th>
                    <td> {{$document->config->vehicle->model??''}}</td>
                </tr>
                <tr>
                    <th>
                        SERIAL DEL MOTOR
                    </th>
                    <td> {{$document->config->vehicle->s_motor??''}}</td>
                </tr>
                <tr>
                    <th>
                        SERIAL DEL CHASIS
                    </th>
                    <td> {{$document->config->vehicle->s_chassis??''}}</td>
                </tr>
            </table>
            <p>
                Usando como dispositivo de Hardware unidad con modulo chip integrado GPS con número
               <strong>IMEI {{$document->config->vehicle->imei??''}} </strong> y <strong>Serial: {{$document->config->vehicle->gps_serial??''}}</strong> e
                para Transmisión Satelital enviando
                GPRS con cobertura nacional bajo el siguiente usuario para efectos de login en la plataforma:
                información a través de {{$document->config->account->email??'N/A'}}y la contraseña suministrada a dicho
                correo.
            </p>
            <p>
                La presente se realiza para constancia y uso del cliente/empresa:
            </p>
            <p style="font-weight: bold; text-align: center; border-bottom: solid 1px #000">
                {{$document->config->account->name??''}} - NIT/CC  {{$document->config->account->nit??''}}
            </p>
            <p>
                y para cualquier efecto legal o administrativo que de lugar y su vigencia puede ser verificada
                a través de nuestro correo electrónico info@ejesatelital.com o al telefono bajo la presente
                firma.
            </p>

            <p>
                Cordialmente,
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-6" style="padding-top: 40px">
            <img class="align-bottom" src="{{Theme::url('images/firma-jf.jpg')}}" style="width: 200px" alt="Firma">
        </div>
        <div class="col-sm-6 text-center" style="float: right">
            <img class="img-responsive" src="{{Theme::url('images/sello.jpg')}}" style="width: 140px; padding-top: 40px; display: inline; margin-bottom: -80px" alt="sello">
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <p style="margin: 0">Jhon Fredy Ospina Montoya</p>
            <p style="margin: 0">Director de Operaciones - Eje Satelital</p>
            <p style="margin: 0">Teléfono: 311 390 9197</p>
            <p style="margin: 0"><a href="https://www.ejesatelital.com">www.ejesatelital.com</a></p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 text-center">
            <p style="margin:40px 0 0; font-weight: bold; color: #a4a4a4">Soporte Técnico Eje Satelital Av. Las Americas No. 81-02 NIT: 34066000-8</p>
            <p style="margin: 0; font-weight: bold; color: #a4a4a4">Pereira - Risaralda</p>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>
