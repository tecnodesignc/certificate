<?php

namespace Modules\Certificate\Http\Controllers;

use Http;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Support\Str;
use Log;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Certificate\Emails\Send;
use Modules\Certificate\Repositories\DocumentRepository;
use Modules\Core\Http\Controllers\BasePublicController;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock\Tags\Param;
use Route;
use Dompdf\Dompdf;

class PublicController extends BasePublicController
{

    /**
     * @var DocumentRepository $docuement
     */

    private DocumentRepository $document;

    /**
     * @var Mailer
     */
    private Mailer $mail;

    public function __construct(DocumentRepository $document,Mailer $mail)
    {
        parent::__construct();
        $this->document = $document;
        $this->mail = $mail;
    }

    public function index(Request $request)
    {
        $account = $request->input('account') ?? 1;
        $user = $this->auth->user();
        $params = ['filter' => ["accounts" => $user->accounts[0]->id ?? $account, 'status'=>true], 'take' => '400', 'include' => []];;

        return view('certificate::frontend.index');

    }

    public function send(Request $request)
    {
        $params = $request->all();

        if(!isset($params['vehicle']))
        {
            return redirect()->back()->with('warning', 'No seleccionaste ningún registro al cuál generar certificado!');
        }

        $user = $this->auth->user();
        $data = [
            'config'=> [
                'account' => [
                'name' => $user->first_name." ".$user->last_name,
                'nit' => $user->nit,
                'email' => $user->email ?? 'N/A',
                "nameSender" => $request->nameSender,
                "idSender" => $request->idSender,
                "addressee" => $request->addressee ?? null
                ]
            ],
        'key'=>md5(Str::random(25).microtime()),
        'user_id'=>$user->id
        ];

        if ($params['type_certificate']) {
            $data['template'] = "certificate::frontend.pdf.yellow_machinery";
        } else {
            $data['template'] = "certificate::frontend.pdf.vehicle";
        }

        if ($params['certificate_group']) {
            $data['config']['type'] = 1;

            $placas=[];
            foreach ($params['vehicle'] as $i=>$board) {
                $placas[] = json_decode($board);
            }
            $data['config']['vehicle'] = $placas;
            $doc= $this->document->create($data);
        } else {
            $data['config']['type'] = 0;
            foreach ($params['vehicle'] as $i=>$board) {
                $data['config']['vehicle'] = json_decode($board);
                $doc[$i]=$this->document->create($data);
            }
        }
        $doc= collect(is_array($doc) ? $doc: [$doc]);
        if($params['send_type']==2 && isset($params['email']) && !empty($params['email']) ){
            $this->sendEmail($doc, $params['email']);
        }
        return redirect()->route('certificate.generate.show', ['id' => urlencode(json_encode($doc->pluck('id')))])
            ->withSuccess('Certificados generados correctamente');
    }

    public function show($id)
    {
        $documents=$this->document->whereByIds(json_decode($id));
        return view('certificate::frontend.show',compact('documents'));
    }
    public function view($key,$id)
    {
        $document=$this->document->whereBykey($id,$key);

        $view =  \View::make($document->template, compact('document'))->render();
        set_time_limit(6000);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHtml($view)->setPaper('letter');
        $fecha = date('Y-m-d');
        return $pdf->stream("certificate-$id-$fecha.pdf");
    }

    private function sendEmail($data, $email){
        $subject = 'Certificados Eje Satelital ';
        $view = 'certificate::frontend.emails.index';
        $this->mail->to([$email])->send(new Send($data, $subject, $view));
    }

}
