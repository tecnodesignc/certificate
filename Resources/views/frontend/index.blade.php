@extends('layouts.master')

@section('title')Solicitar Certificados | @parent
@stop
@section('content')

    @include('certificate::frontend.partial.header')

    <!-- Start contact -->
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card contact-section-card mb-0">
                        <div class="card-body p-md-5">
                            <div class="text-center title mb-5">
                                <p class="text-muted text-uppercase fw-normal mb-2">Generar Certificados</p>
                                <h3 class="mb-3">Configuracion</h3>
                                <div class="title-icon position-relative">
                                    <div class="position-relative">
                                        <i class="uim uim-arrow-circle-down"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- start form -->
                            @include('partials.notifications')
                            <div class="container d-flex align-items-center">
                                <div class="row g-0 justify-content-center">
                                    <!-- TITLE -->
                                    <div class="col-lg-4 offset-lg-1 mx-0 px-0">
                                        <div id="title-container">
                                            <img class="covid-image" src="{{Theme::url('images/3963397.png')}}" alt="Solicitud de Certificados">
                                            <h2>Datos Basicos</h2>
                                            <h3>Solicitud de Certificados</h3>
                                            <p>Por favor, ingrese los siguientes datos para la generación de certificados:</p>
                                        </div>
                                    </div>
                                    <!-- FORMS -->
                                    <div class="col-lg-7 mx-0 px-0">
                                        <div class="progress">
                                            <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="50"
                                                 class="progress-bar progress-bar-striped progress-bar-animated bg-info"
                                                 role="progressbar" style="width: 0%"></div>
                                        </div>
                                        <div id="qbox-container">
                                            {!! Form::open(['route' => ['certificate.generate.send'], 'method' => 'post', 'files'=>true , 'class'=>'needs-validation ','novalidate', 'id'=>'form-wrapper', 'name'=>"form-wrapper" ]) !!}
                                            <div id="steps-container">
                                                {{-- PASO 1 --}}
                                                <div class="step">
                                                    <div id="divProcessingElement" style="display: none;">
                                                        <div class="text-center">
                                                            <span class="mdi mdi-autorenew mdi-spin md-48 spinner text-info"></span>
                                                            <h5 class="text-primary" id="processingDivLabel" style="display: inline-block;">Sincronizando datos...</h5>
                                                        </div>
                                                    </div>

                                                    <div id="successData" style="display: none;">
                                                        <div class="text-center">
                                                            <span class="mdi mdi-check-circle-outline text-success"></span>
                                                            <h5 class="text-success" id="successDataLabel" style="display: inline-block;">Datos sincronizados con exito!</h5>
                                                        </div>
                                                    </div>
                                                    <div id="div_select_type" style="display: none;">
                                                        <h4>Seleccione el tipo de certificado que desea generar.</h4>
                                                        <div class="mt-1">
                                                            <label class="form-label">Tipo de Certificado:</label>
                                                            <select class="form-select"
                                                                    name="type_certificate" id="type_certificate" onchange="insertParam()" aria-label="Default select type_certificate">
                                                                <option selected>Seleccionar</option>
                                                                <option value="0">Vehículos</option>
                                                                <option value="1">Maquinaria Amarilla</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>
                                                {{-- PASO 2 --}}
                                                <div class="step">
                                                    <input  id="count_vehicle"
                                                           type="hidden" value="" >
                                                    {{-- @if(count($vehicles)) --}}
                                                    <h4>Selecciona los vehículos para los cuales deseas generar el/los certificado(s).</h4>
                                                    <div class="form-check ps-0 q-box row">
                                                    </div>

                                                </div>
                                                {{-- PASO 3 --}}
                                                <div class="step">
                                                    <h4>¿Prefiere un certificado individual para cada vehículo o uno integrado para todos?</h4>
                                                    <div class="form-check ps-0 q-box">
                                                        <div class="q-box__question">
                                                            <input class="form-check-input question__input"
                                                                   id="certificate_group_0"
                                                                   name="certificate_group" type="radio" value="0" checked>
                                                            <label class="form-check-label question__label"
                                                                   for="certificate_group_0">Individual</label>
                                                        </div>
                                                        <div class="q-box__question" id="box-certificate_group_1" style="display: none;">
                                                            <input class="form-check-input question__input"
                                                                   id="certificate_group_1" name="certificate_group"
                                                                   type="radio" value="1">
                                                            <label class="form-check-label question__label"
                                                                   for="certificate_group_1">Integrado</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- PASO 4 --}}
                                                <div class="step">
                                                    <h4>¿Prefiere descargar o enviar el/los certificado(s)?</h4>
                                                   <div class="row">
                                                       <div class="col-6">
                                                           <div class="form-check ps-0 q-box">
                                                               <div class="q-box__question">
                                                                   <input
                                                                       class="form-check-input question__input q-checkbox"
                                                                       id="send_type_download" name="send_type" type="checkbox"
                                                                       value="1" checked>
                                                                   <label class="form-check-label question__label"
                                                                          for="send_type_download">Descargar</label>
                                                               </div>
                                                           </div>
                                                       </div>
                                                       <div class="col-6">
                                                           <div class="form-check ps-0 q-box">
                                                               <div class="q-box__question">
                                                                   <input class="form-check-input question__input"
                                                                          id="send_type_email" name="send_type" type="checkbox"
                                                                          value="2" onclick="send()">
                                                                   <label class="form-check-label question__label"
                                                                          for="send_type_email">Enviar</label>
                                                               </div>
                                                           </div>
                                                       </div>
                                                       <div class="col-12">
                                                           <div class="mt-2" id="email-box" style="display:none">
                                                               <label class="form-label">Email:</label>
                                                               <input class="form-control" id="email" name="email"
                                                                      type="email"  >
                                                           </div>
                                                       </div>
                                                   </div>

                                                </div>
                                                </div>
                                                <div id="q-box__buttons">
                                                    <button id="prev-btn" class="btn btn-info btn-sm navbar-btn" type="button">Anterior</button>
                                                    <button id="next-btn" class="btn btn-info btn-sm navbar-btn" type="button">Siguiente</button>
                                                    <button id="submit-btn" class="btn btn-info btn-sm navbar-btn" type="submit">Enviar</button>
                                                    <a id="ini-btn" class="btn btn-info btn-sm navbar-btn" href="{{url('/')}}">Ir a Inicio</a>

                                                </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="preloader-wrapper">
                                <div id="preloader"></div>
                                <div class="preloader-section section-left"></div>
                                <div class="preloader-section section-right"></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
    <!-- end contact -->


@stop
@section('scripts')

@parent
     <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Enlace a jQuery y script personalizado -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <!-- Código para mostrar y ocultar el modal -->
    <script type="application/javascript">

        $(document).ready(function() {
            // Mostrar modal de procesamiento al inicio
            $('#divProcessingElement').show();

            // Realizar la solicitud GET con Axios
            const route = "{{ route('api.traccar.device.index') }}";
            axios.get(route, {
                headers: {
                    'Authorization': `Bearer {{$currentUser->getFirstApiKey()}}`,
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                // Verificar si la respuesta es exitosa (código de respuesta 200)
                if (response.status == 200) {
                    const data = response.data;
                    vehiculosData = data;
                    return data;
                } else {
                    // Cerrar Div de procesamiento en caso de error
                    $('#divProcessingElement').hide();
                    throw new Error('Hubo un problema al obtener la lista de vehículos desde el API.');
                }
            })
            .then(data => {
                // Ocultar el Div de procesamiento después de un tiempo
                setTimeout(function() {
                    $('#divProcessingElement').hide();
                    $('#successData').show(); // Mostrar el elemento de éxito
                }, 500);

                // Ocultar el elemento de éxito después de otro tiempo
                setTimeout(function() {
                    $('#successData').hide(); // Ocultar el elemento después de 3000 ms (3 segundos)
                    $('#div_select_type').css('display', 'block');
                }, 1000);
            })
            .catch(error => {
                // Cerrar Div de procesamiento en caso de error
                $('#divProcessingElement').hide();

                // Mostrar mensaje de error al usuario
                console.error('Error:', error);
                console.log('Error en la importación2');
            });
        });
    </script>

    <script type="application/javascript" >

        function insertParam() {
            var type_certificate = $("#type_certificate").val();
            var individualRadio = document.getElementById('box-certificate_group_1');

            // Filtrar los datos según el tipo de certificado seleccionado
            var dataWithEmptyType = [];
            var dataWithType = [];
            vehiculosData.data.forEach(data => {
                if (type_certificate == 0 && data.type === "") {
                    dataWithEmptyType.push(data);
                } else if (type_certificate == 1 && data.type !== "") {
                    dataWithType.push(data);
                }
            });

            // Contar la cantidad de registros
            count = (type_certificate == 0) ? dataWithEmptyType.length : dataWithType.length;
            countVehicle = document.getElementById('count_vehicle');
            countVehicle.value = count;

            if (type_certificate == 0) {
                individualRadio.style.display = 'block';
            }else{
                individualRadio.style.display = 'none';
            }

            // Llenar dinámicamente el contenido de la interfaz de usuario con los vehículos recibidos
            vehicleContainer = document.querySelector('.q-box');
            vehicleContainer.innerHTML = ''; // Limpiar el contenedor antes de agregar nuevos elementos

            var filteredData = (type_certificate == 0) ? dataWithEmptyType : dataWithType;

            filteredData.forEach(data => {
                const formData = {
                    id: data.id,
                    name: data.name,
                    imei: data.imei,
                    type: data.type,
                    brand: data.brand,
                    model: data.model,
                    s_motor: data.s_motor,
                    s_chassis: data.s_chassis
                };
                const vehicleJSON = JSON.stringify(formData);

                const vehicleElement = document.createElement('div');

                vehicleElement.className = 'q-box__question col-12 vehicle-' + data.name + 'id="vehicle-"'+data.name;
                vehicleElement.innerHTML = `
                    <input class="form-check-input question__input" name="vehicle[]" type="checkbox" value='${vehicleJSON}' id="vehicle-${data.id}">
                    <label class="form-check-label question__label" for="vehicle-${data.id}">${data.name}</label>
                `;
                vehicleContainer.appendChild(vehicleElement);
            }

            );

        }
    </script>

    <script>
        function send() {
            // Get the checkbox
            var checkBox = document.getElementById("send_type_email");
            // Get the output text
            var text = document.getElementById("email-box");

            // If the checkbox is checked, display the output text
            if (checkBox.checked == true){
                text.style.display = "block";
            } else {
                text.style.display = "none";
            }
        }
    </script>


<script>
    let step = document.getElementsByClassName('step');
    let iniBtn = document.getElementById('ini-btn');
    let prevBtn = document.getElementById('prev-btn');
    let nextBtn = document.getElementById('next-btn');
    let submitBtn = document.getElementById('submit-btn');
    let form = document.getElementsByTagName('form')[0];
    let preloader = document.getElementById('preloader-wrapper');
    let bodyElement = document.querySelector('body');
    let succcessDiv = document.getElementById('success');

    let current_step = 0;
    let stepCount = 3
    step[current_step].classList.add('d-block');

    if (current_step == 0) {
        prevBtn.classList.add('d-none');
        submitBtn.classList.add('d-none');
        nextBtn.classList.add('d-inline-block');
        iniBtn.classList.add('d-none');
    }
    const progress = (value) => {
        document.getElementsByClassName('progress-bar')[0].style.width = `${value}%`;
    }
    nextBtn.addEventListener('click', () => {
        current_step++;
        let previous_step = current_step - 1;
        if ((current_step > 0) && (current_step <= stepCount)) {
            prevBtn.classList.remove('d-none');
            prevBtn.classList.add('d-inline-block');
            step[current_step].classList.remove('d-none');
            step[current_step].classList.add('d-block');
            step[previous_step].classList.remove('d-block');
            step[previous_step].classList.add('d-none');
            if (current_step === stepCount) {
                submitBtn.classList.remove('d-none');
                submitBtn.classList.add('d-inline-block');
                nextBtn.classList.remove('d-inline-block');
                nextBtn.classList.add('d-none');
            }
        } else {
            if (current_step > stepCount) {

            }
        }
        if (current_step === 1 && countVehicle.value==='0') {
            prevBtn.classList.remove('d-inline-block');
            prevBtn.classList.add('d-none');
            nextBtn.classList.remove('d-inline-block');
            nextBtn.classList.add('d-none');
            iniBtn.classList.remove('d-none');
            iniBtn.classList.add('d-inline-block');

        }
        progress((100 / stepCount) * current_step);
    });


    prevBtn.addEventListener('click', () => {
        if (current_step > 0) {
            current_step--;
            let previous_step = current_step + 1;
            prevBtn.classList.add('d-none');
            prevBtn.classList.add('d-inline-block');
            step[current_step].classList.remove('d-none');
            step[current_step].classList.add('d-block')
            step[previous_step].classList.remove('d-block');
            step[previous_step].classList.add('d-none');
            if (current_step < stepCount) {
                submitBtn.classList.remove('d-inline-block');
                submitBtn.classList.add('d-none');
                nextBtn.classList.remove('d-none');
                nextBtn.classList.add('d-inline-block');
                prevBtn.classList.remove('d-none');
                prevBtn.classList.add('d-inline-block');
                iniBtn.classList.add('d-none');
                iniBtn.classList.remove('d-inline-block');
            }
        }
        if (current_step === 0) {
            prevBtn.classList.remove('d-inline-block');
            prevBtn.classList.add('d-none');
        }
        progress((100 / stepCount) * current_step);
    });


   /* submitBtn.addEventListener('click', () => {
        preloader.classList.add('d-block');

        const timer = ms => new Promise(res => setTimeout(res, ms));

        timer(3000)
            .then(() => {
                bodyElement.classList.add('loaded');
            }).then(() => {
            step[stepCount].classList.remove('d-block');
            step[stepCount].classList.add('d-none');
            prevBtn.classList.remove('d-inline-block');
            prevBtn.classList.add('d-none');
            submitBtn.classList.remove('d-inline-block');
            submitBtn.classList.add('d-none');
            succcessDiv.classList.remove('d-none');
            succcessDiv.classList.add('d-block');
        })

    });*/
</script>


<style>

    .hidden{
        display: none;
    }
    /* TITLE */

    #title-container {
        min-height: 460px;
        height: 100%;
        color: #fff;
        background-color: #83c1f1;
        text-align: center;
        padding: 105px 28px 28px 28px;
        box-sizing: border-box;
        position: relative;
        box-shadow: 10px 8px 21px 0px rgba(204, 204, 204, 0.75);
        -webkit-box-shadow: 10px 8px 21px 0px rgba(204, 204, 204, 0.75);
        -moz-box-shadow: 10px 8px 21px 0px rgba(204, 204, 204, 0.75);
    }

    #title-container h2 {
        font-size: 45px;
        font-weight: 800;
        color: #fff;
        padding: 0;
        margin-bottom: 0px;
    }

    #title-container h3 {
        font-size: 25px;
        font-weight: 600;
        color: #52a5e5;
        padding: 0;
    }

    #title-container p {
        font-size: 13px;
        padding: 0 25px;
        line-height: 20px;
    }

    .covid-image {
        width: 214px;
        margin-bottom: 15px;
    }

    /* FORMS */

    #qbox-container {
        background: url(../img/corona.png);
        background-repeat: repeat;
        position: relative;
        padding: 62px;
        min-height: 630px;
        box-shadow: 10px 8px 21px 0px rgba(204, 204, 204, 0.75);
        -webkit-box-shadow: 10px 8px 21px 0px rgba(204, 204, 204, 0.75);
        -moz-box-shadow: 10px 8px 21px 0px rgba(204, 204, 204, 0.75);
    }

    #steps-container {
        margin: auto;
        width: 500px;
        min-height: 420px;
        display: flex;
        vertical-align: middle;
        align-items: center;
    }

    .step {
        display: none;
    }

    .step h4 {
        margin: 0 0 26px 0;
        padding: 0;
        position: relative;
        font-weight: 500;
        font-size: 23px;
        font-size: 1.4375rem;
        line-height: 1.6;
    }

    .q-box__question {
        margin-bottom: 10px;
        margin-top: 10px;
    }

    button#prev-btn,
    button#next-btn,
    button#submit-btn {
        font-size: 17px;
        font-weight: bold;
        position: relative;
        width: 130px;
        height: 50px;
       // background: #DC3545;
        margin: 0 auto;
        margin-top: 40px;
        overflow: hidden;
        z-index: 1;
        cursor: pointer;
        transition: color .3s;
        text-align: center;
        color: #fff;
        border: 0;
        -webkit-border-bottom-right-radius: 5px;
        -webkit-border-bottom-left-radius: 5px;
        -moz-border-radius-bottomright: 5px;
        -moz-border-radius-bottomleft: 5px;
        border-bottom-right-radius: 5px;
        border-bottom-left-radius: 5px;
    }

    button#prev-btn:after,
    button#next-btn:after,
    button#submit-btn:after {
        position: absolute;
        top: 90%;
        left: 0;
        width: 100%;
        height: 100%;
        background: #0491ad;
        content: "";
        z-index: -2;
        transition: transform .3s;
    }

    button#prev-btn:hover::after,
    button#next-btn:hover::after,
    button#submit-btn:hover::after {
        transform: translateY(-80%);
        transition: transform .3s;
    }

    .progress {
        border-radius: 0px !important;
    }

    .q__question {
        position: relative;
    }

    .q__question:not(:last-child) {
        margin-bottom: 10px;
    }

    .question__input {
        position: absolute;
        left: -9999px;
    }

    .question__label {
        position: relative;
        display: block;
        line-height: 40px;
        border: 1px solid #ced4da;
        border-radius: 5px;
        background-color: #fff;
        padding: 5px 20px 5px 50px;
        cursor: pointer;
        transition: all 0.15s ease-in-out;
    }

    .question__label:hover {
        border-color: #DC3545;
    }

    .question__label:before,
    .question__label:after {
        position: absolute;
        content: "";
    }

    .question__label:before {
        top: 12px;
        left: 10px;
        width: 26px;
        height: 26px;
        border-radius: 50%;
        background-color: #fff;
        box-shadow: inset 0 0 0 1px #ced4da;
        -webkit-transition: all 0.15s ease-in-out;
        -moz-transition: all 0.15s ease-in-out;
        -o-transition: all 0.15s ease-in-out;
        transition: all 0.15s ease-in-out;
    }

    .question__input:checked + .question__label:before {
        background-color: #DC3545;
        box-shadow: 0 0 0 0;
    }

    .question__input:checked + .question__label:after {
        top: 22px;
        left: 18px;
        width: 10px;
        height: 5px;
        border-left: 2px solid #fff;
        border-bottom: 2px solid #fff;
        transform: rotate(-45deg);
    }

    .form-check-input:checked,
    .form-check-input:focus {
        background-color: #DC3545 !important;
        outline: none !important;
        border: none !important;
    }

    input:focus {
        outline: none;
    }

    #input-container {
        display: inline-block;
        box-shadow: none !important;
        margin-top: 36px !important;
    }

    label.form-check-label.radio-lb {
        margin-right: 15px;
    }

    #q-box__buttons {
        text-align: center;
    }

    input[type="text"],
    input[type="email"] {
        padding: 8px 14px;
    }

    input[type="text"]:focus,
    input[type="email"]:focus {
        border: 1px solid #DC3545;
        border-radius: 5px;
        outline: 0px !important;
        -webkit-appearance: none;
        box-shadow: none !important;
        -webkit-transition: all 0.15s ease-in-out;
        -moz-transition: all 0.15s ease-in-out;
        -o-transition: all 0.15s ease-in-out;
        transition: all 0.15s ease-in-out;
    }

    .form-check-input:checked[type=radio],
    .form-check-input:checked[type=radio]:hover,
    .form-check-input:checked[type=radio]:focus,
    .form-check-input:checked[type=radio]:active {
        border: none !important;
        -webkit-outline: 0px !important;
        box-shadow: none !important;
    }

    .form-check-input:focus,
    input[type="radio"]:hover {
        box-shadow: none;
        cursor: pointer !important;
    }

    #success {
        display: none;
    }

    #success h4 {
        color: #DC3545;
    }

    .back-link {
        font-weight: 700;
        color: #DC3545;
        text-decoration: none;
        font-size: 18px;
    }

    .back-link:hover {
        color: #82000a;
    }

    /* PRELOADER */

    #preloader-wrapper {
        width: 100%;
        height: 100%;
        z-index: 1000;
        display: none;
        position: fixed;
        top: 0;
        left: 0;
    }

    #preloader {
        background-image: url('../img/preloader.png');
        width: 120px;
        height: 119px;
        border-top-color: #fff;
        border-radius: 100%;
        display: block;
        position: relative;
        top: 50%;
        left: 50%;
        margin: -75px 0 0 -75px;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
        z-index: 1001;
    }

    @-webkit-keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    #preloader-wrapper .preloader-section {
        width: 51%;
        height: 100%;
        position: fixed;
        top: 0;
        background: #F7F9FF;
        z-index: 1000;
    }

    #preloader-wrapper .preloader-section.section-left {
        left: 0
    }

    #preloader-wrapper .preloader-section.section-right {
        right: 0;
    }

    .loaded #preloader-wrapper .preloader-section.section-left {
        transform: translateX(-100%);
        transition: all 0.7s 0.3s cubic-bezier(0.645, 0.045, 0.355, 1.000);
    }

    .loaded #preloader-wrapper .preloader-section.section-right {
        transform: translateX(100%);
        transition: all 0.7s 0.3s cubic-bezier(0.645, 0.045, 0.355, 1.000);
    }

    .loaded #preloader {
        opacity: 0;
        transition: all 0.3s ease-out;
    }

    .loaded #preloader-wrapper {
        visibility: hidden;
        transform: translateY(-100%);
        transition: all 0.3s 1s ease-out;
    }

    /* MEDIA QUERIES */

    @media (min-width: 990px) and (max-width: 1199px) {
        #title-container {
            padding: 80px 28px 28px 28px;
        }

        #steps-container {
            width: 85%;
        }
    }

    @media (max-width: 991px) {
        #title-container {
            padding: 30px;
            min-height: inherit;
        }
    }

    @media (max-width: 767px) {
        #qbox-container {
            padding: 30px;
        }

        #steps-container {
            width: 100%;
            min-height: 400px;
        }

        #title-container {
            padding-top: 50px;
        }
    }

    @media (max-width: 560px) {
        #qbox-container {
            padding: 40px;
        }

        #title-container {
            padding-top: 45px;
        }
    }
</style>
@stop
