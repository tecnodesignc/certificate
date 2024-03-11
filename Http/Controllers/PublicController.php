<?php

namespace Modules\Certificate\Http\Controllers;

use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Support\Str;
use Log;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Certificate\Emails\Send;
use Modules\Certificate\Repositories\DocumentRepository;
use Modules\Core\Http\Controllers\BasePublicController;
use Illuminate\Http\Request;
use Modules\Vehicle\Repositories\VehicleRepository;
use phpDocumentor\Reflection\DocBlock\Tags\Param;
use Route;


class PublicController extends BasePublicController
{

    /**
     * @var VehicleRepository
     */
    private VehicleRepository $vehicle;

    /**
     * @var DocumentRepository $docuement
     */

    private DocumentRepository $document;

    /**
     * @var Mailer
     */
    private Mailer $mail;

    public function __construct(VehicleRepository $vehicle, DocumentRepository $document,Mailer $mail)
    {
        parent::__construct();
        $this->vehicle = $vehicle;
        $this->document = $document;
        $this->mail = $mail;

    }

    public function index(Request $request)
    {
        $account = $request->input('account') ?? 1;
        $user = $this->auth->user();
        $params = ['filter' => ["accounts" => $user->accounts[0]->id ?? $account, 'status'=>true], 'take' => '400', 'include' => []];;
        $vehicles = $this->vehicle->getItemsBy(json_decode(json_encode($params)));

        return view('certificate::frontend.index', compact('vehicles'));

    }

    public function send(Request $request)
    {
        $params = $request->all();
        $user = $this->auth->user();
        $account = $user->accounts[0];
        $data = ['config'=>['account' => ['name' => $account->name, 'nit' => $account->nit,  'email' => $account->email??'N/A' ]],'key'=>md5(Str::random(25).microtime()), 'user_id'=>$user->id];

        if ($params['type_certificate']) {
            $data['template'] = "certificate::frontend.pdf.yellow_machinery";
        } else {
            $data['template'] = "certificate::frontend.pdf.vehicle";
        }
        if ($params['certificate_group']) {
            $data['config']['type'] = 1;
            $data['config']['board'] = implode(', ',$params['vehicle']);
            $doc= $this->document->create($data);
        } else {
            $data['config']['type'] = 0;
            foreach ($params['vehicle'] as $i=>$board) {
                $vehicle = $this->vehicle->whereByBoard($board);
                $data['config']['vehicle'] = $vehicle;
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
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view)->setPaper('letter');

        return $pdf->stream('certificate'.$id.'.pdf');
    }

    private function sendEmail($data, $email){
        $subject = 'Certificados Eje Satelital ';
        $view = 'certificate::frontend.emails.index';

        $this->mail->to([$email])->send(new Send($data, $subject, $view));

    }

}
